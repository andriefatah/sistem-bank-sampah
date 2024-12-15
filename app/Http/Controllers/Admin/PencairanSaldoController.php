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
            ->orderBy('tanggal_pengajuan', 'desc')
            ->paginate(10);

        return view('pages.admin.pencairan_saldo.index', compact('pencairanSaldo'));
    }

    public function terima(Request $request, $id)
    {
        echo 'Halo';
        $pencairan = PencairanSaldo::findOrFail($id);

        if ($pencairan->status !== 'pending') {
            return redirect()->back()->withErrors(['msg' => 'Permintaan sudah diproses sebelumnya.']);
        }

        $saldo = Saldo::where('nasabah_id', $pencairan->nasabah_id)->first();

        if (!$saldo || $saldo->saldo < $pencairan->jumlah_pencairan) {
            return redirect()->back()->withErrors(['msg' => 'Saldo tidak mencukupi untuk pencairan.']);
        }

        $saldo->saldo -= $pencairan->jumlah_pencairan;
        $saldo->save();

        $pencairan->status = 'diproses';
        $pencairan->tanggal_proses = now();
        $pencairan->save();

        return redirect()->route('admin.tarik-saldo.index')->with('success', 'Permintaan pencairan saldo telah diterima.');
    }

    public function tolak(Request $request, $id)
    {
        // echo 'asasa';
        $request->validate(['keterangan' => 'required|string|max:255']);

        $pencairan = PencairanSaldo::findOrFail($id);

        if ($pencairan->status !== 'pending') {
            return redirect()->back()->withErrors(['msg' => 'Permintaan sudah diproses sebelumnya.']);
        }

        $pencairan->status = 'ditolak';
        $pencairan->keterangan = $request->keterangan;
        $pencairan->tanggal_proses = now();
        $pencairan->save();

        return redirect()->route('admin.tarik-saldo.index')->with('error', 'Pengajuan pencairan saldo ditolak.');
    }

    public function selesai(Request $request, $id)
    {
        $pencairan = PencairanSaldo::findOrFail($id);

        if ($pencairan->status !== 'diproses') {
            return redirect()->back()->withErrors(['msg' => 'Permintaan sudah selesai sebelumnya atau belum diproses.']);
        }

        $pencairan->status = 'selesai';
        $pencairan->save();

        return redirect()->route('admin.tarik-saldo.index')->with('success', 'Permintaan pencairan saldo telah selesai.');
    }
}
