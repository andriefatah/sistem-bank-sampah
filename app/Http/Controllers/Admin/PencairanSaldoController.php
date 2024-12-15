<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PencairanSaldo;
use App\Models\Saldo;

class PencairanSaldoController extends Controller
{
    public function index()
    {
        $pencairanSaldo = PencairanSaldo::with(['nasabah', 'metode'])
            ->where('status', 'pending')
            ->orderBy('tanggal_pengajuan', 'desc')
            ->paginate(10);

        return view('pages.admin.pencairan_saldo.index', compact('pencairanSaldo'));
    }

    /**
     * Proses persetujuan permintaan pencairan saldo.
     */
    public function setujui(Request $request, $id)
    {
        $request->validate([
            'jumlah_pencairan' => 'required|numeric|min:0',
        ]);

        $pencairan = PencairanSaldo::findOrFail($id);

        // Pastikan statusnya masih pending
        if ($pencairan->status !== 'pending') {
            return redirect()->back()->withErrors(['msg' => 'Permintaan sudah diproses sebelumnya.']);
        }

        // Cek saldo nasabah
        $saldo = Saldo::where('nasabah_id', $pencairan->nasabah_id)->first();

        if (!$saldo || $saldo->saldo < $pencairan->jumlah_pencairan) {
            return redirect()->back()->withErrors(['msg' => 'Saldo tidak mencukupi untuk pencairan.']);
        }

        // Proses pengurangan saldo
        $saldo->saldo -= $pencairan->jumlah_pencairan;
        $saldo->save();

        // Update status pencairan saldo
        $pencairan->status = 'disetujui';
        $pencairan->tanggal_proses = now();
        $pencairan->updated_at = now();
        $pencairan->save();

        return redirect()->route('pages.admin.pencairan_saldo.index')->with('success', 'Permintaan pencairan saldo telah disetujui.');
    }

    /**
     * Proses penolakan permintaan pencairan saldo.
     */
    public function tolak(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required|string|max:255',
        ]);

        // Ambil data pencairan saldo berdasarkan ID
        $pencairan = PencairanSaldo::findOrFail($id);

        // Pastikan status masih 'pending'
        if ($pencairan->status !== 'pending') {
            return redirect()->back()->withErrors(['msg' => 'Permintaan sudah diproses sebelumnya.']);
        }

        // Update status pencairan menjadi 'ditolak'
        $pencairan->status = 'ditolak';
        $pencairan->keterangan = $request->keterangan;
        $pencairan->tanggal_proses = now();
        $pencairan->save();

        return redirect()->route('tarik-saldo.index')->with('error', 'Pengajuan pencairan saldo ditolak.');
    }
}
