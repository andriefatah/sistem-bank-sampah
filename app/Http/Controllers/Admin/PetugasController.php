<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = Petugas::paginate(10);
        return view('pages.admin.petugas.index', compact('petugas'));
    }

    public function create()
    {
        return view('pages.admin.petugas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:petugas',
            'username' => 'required|string|unique:petugas',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,petugas'
        ]);

        Petugas::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.petugas.index')->with('success', 'Petugas berhasil ditambahkan.');
    }

    // public function show(Petugas $petugas)
    // {
    //     return view('admin.petugas.show', compact('petugas'));
    // }

    public function edit(string $id)
    {
        $petugas = Petugas::findOrFail($id);

        return view('pages.admin.petugas.edit', compact('petugas'));
    }

    public function update(Request $request, $id)
    {
        $petugas = Petugas::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:petugas,email,' . $petugas->id,
            'username' => 'required|string|unique:petugas,username,' . $petugas->id,
            'role' => 'required|in:admin,petugas'
        ]);

        $petugas->update($request->only(['nama', 'email', 'username', 'role']));

        return redirect()->route('admin.petugas.index')->with('success', 'Petugas berhasil diperbarui.');
    }

    public function destroy(Petugas $petugas)
    {
        $petugas->delete();
        return redirect()->route('admin.petugas.index')->with('success', 'Petugas berhasil dihapus.');
    }
}
