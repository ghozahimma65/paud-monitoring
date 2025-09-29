<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\User;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::with('user')->get();
        return view('admin.guru.index', compact('guru'));
    }

    public function create()
    {
        $users = User::all(); // misalnya guru punya relasi ke user
        return view('admin.guru.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
        'nama'   => 'required|string|max:255',
        'bidang' => 'required|string|max:255',
        'alamat' => 'nullable|string',
        'no_hp'  => 'nullable|string',
]);


        Guru::create($request->all());
        return redirect()->route('guru.index')->with('success', 'Guru berhasil ditambahkan');
    }

    public function show($id)
    {
        $guru = Guru::with('user')->findOrFail($id);
        return view('admin.guru.show', compact('guru'));
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        $users = User::all();
        return view('admin.guru.edit', compact('guru', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'bidang'  => 'required|string|max:255',
        ]);

        $guru = Guru::findOrFail($id);
        $guru->update($request->all());

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui');
    }

    public function destroy($id)
    {
        Guru::destroy($id);
        return redirect()->route('guru.index')->with('success', 'Guru berhasil dihapus');
    }
}
