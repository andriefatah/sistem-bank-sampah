<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Transaksi;
use App\Models\Nasabah;
use App\Models\Sampah;
use App\Models\Saldo;
use App\Models\DetailTransaksi;
use App\Models\TokenWhatsApp;
use Barryvdh\DomPDF\Facade as PDF;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller
{

    public function index()
    {
        $transaksis = Transaksi::with(['nasabah', 'detailTransaksi.sampah'])->paginate(10);

        foreach ($transaksis as $transaksi) {
            $transaksi->total_berat = $transaksi->detailTransaksi->sum('berat_kg');
            $transaksi->total_transaksi = $transaksi->detailTransaksi->sum('harga_total');
        }

        return view('pages.admin.transaksi.index', compact('transaksis'));
    }

    public function generateUniqueTransactionCode()
    {
        // Format: BS-YYYYMMDD-SET-001
        $today = now()->format('Ymd');
        $prefix = "BSR-{$today}-SET-";

        // Cari kode transaksi terakhir hari ini
        $lastTransaction = Transaksi::where('kode_transaksi', 'like', $prefix . '%')
            ->orderBy('kode_transaksi', 'desc')
            ->first();

        if (!$lastTransaction) {
            // Jika belum ada transaksi hari ini, mulai dari 001
            return $prefix . '001';
        }

        // Ekstrak nomor urut terakhir
        $lastNumber = substr($lastTransaction->kode_transaksi, -3);
        $newNumber = str_pad((int)$lastNumber + 1, 3, '0', STR_PAD_LEFT);

        return $prefix . $newNumber;
    }


    public function create()
    {
        $kodeTransaksi = $this->generateUniqueTransactionCode();
        $nasabahList = Nasabah::all();
        $stokSampah = Sampah::all();
        return view('pages.admin.transaksi.create', compact('nasabahList', 'stokSampah', 'kodeTransaksi'));
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'kode_transaksi' => 'required|string|unique:transaksi,kode_transaksi',
            'nasabah_id' => 'required|exists:nasabah,id',
            'tanggal_transaksi' => 'required|date',
            'detail_transaksi' => 'required|array|min:1',
            'detail_transaksi.*.sampah_id' => 'required|exists:sampah,id',
            'detail_transaksi.*.berat_kg' => 'required|numeric|min:0',
            'detail_transaksi.*.harga_per_kg' => 'required|numeric|min:0',
        ]);

        // Ambil ID petugas dari sesi pengguna yang sedang login
        $petugas_id = auth()->user()->id;

        // Simpan transaksi utama
        $transaksi = Transaksi::create([
            'kode_transaksi' => $request->kode_transaksi,
            'nasabah_id' => $request->nasabah_id,
            'petugas_id' => $petugas_id,
            'tanggal_transaksi' => $request->tanggal_transaksi,
        ]);

        $totalTransaksi = 0; // Untuk menghitung total nilai transaksi

        // Iterasi detail transaksi
        foreach ($request->detail_transaksi as $detail) {
            $hargaTotal = $detail['berat_kg'] * $detail['harga_per_kg'];
            $totalTransaksi += $hargaTotal;

            // Simpan detail transaksi
            DetailTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'sampah_id' => $detail['sampah_id'],
                'berat_kg' => $detail['berat_kg'],
                'harga_per_kg' => $detail['harga_per_kg'],
                'harga_total' => $hargaTotal,
            ]);
        }

        // Perbarui saldo nasabah
        $saldo = Saldo::where('nasabah_id', $request->nasabah_id)->first();
        if ($saldo) {
            $saldo->increment('saldo', $totalTransaksi);
        } else {
            Saldo::create([
                'nasabah_id' => $request->nasabah_id,
                'saldo' => $totalTransaksi,
            ]);
        }

        // Redirect ke halaman cetak nota transaksi
        return redirect()->route('admin.transaksi.print', ['transaksi' => $transaksi->id])
            ->with([
                'success' => 'Transaksi berhasil disimpan',
                'transaksi_id' => $transaksi->id,
            ]);
    }
    public function print($id)
    {
        $transaksi = Transaksi::with(['nasabah', 'petugas', 'detailTransaksi.sampah'])->findOrFail($id);

        $total_transaksi = $transaksi->detailTransaksi->sum(function ($detail) {
            return $detail->berat_kg * $detail->harga_per_kg;
        });

        $data = [
            'tanggal_transaksi' => \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('Y-m-d'),
            'nasabah' => $transaksi->nasabah,
            'petugas' => $transaksi->petugas,
            'details' => $transaksi->detailTransaksi,
            'total_transaksi' => $total_transaksi
        ];

        return view('pages.admin.transaksi.print', $data);
    }

    public function show($id)
    {
        $transaksi = Transaksi::with(['nasabah', 'detailTransaksi.sampah'])
            ->findOrFail($id);

        $detailTransaksi = $transaksi->detailTransaksi;

        return view('pages.admin.transaksi.show', compact('transaksi', 'detailTransaksi'));
    }

    public function destroy($id)
    {
        // Cari transaksi beserta detailnya
        $transaksi = Transaksi::with('detailTransaksi.sampah')->findOrFail($id);

        // Lakukan penghapusan dalam satu proses
        $transaksi->load('detailTransaksi.sampah'); // Pastikan data relasi dimuat

        // Gunakan Eloquent untuk pengembalian stok
        foreach ($transaksi->detailTransaksi as $detail) {
            $detail->sampah->increment('stok_kg', $detail->berat_kg);
        }

        // Hapus detail transaksi dan transaksi utama
        $transaksi->detailTransaksi()->delete(); // Hapus semua detail transaksi
        $transaksi->delete(); // Hapus transaksi utama

        Alert::success('Hore!', 'Transaksi berhasil dihapus!')->autoclose(3000);

        return redirect()->route('admin.transaksi.index');
    }
}
