<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Guru;
use App\Models\WaliMurid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
    public function index()
    {
        $users = User::whereIn('role', ['guru', 'wali_murid'])->get();
        return view('admin.akun.index', compact('users'));
    }

    public function create()
    {
        $gurus = Guru::whereNull('user_id')->get(['id', 'nama_guru']);
        $waliMurids = WaliMurid::whereNull('user_id')->get(['id', 'nama_wali']);
    
        return view('admin.akun.create', compact('gurus', 'waliMurids'));
    }

    public function store(Request $request)
    {

     
        $request->validate([
            'role' => 'required|in:guru,wali_murid',
            'user_guru_id' => 'required',
            'user_wali_id' => 'required',
        ]);

        if ($request->role == 'guru') {
            $data = Guru::findOrFail($request->user_guru_id);
            $name = $data->nama_guru;
            $email = $data->email ?? strtolower(str_replace(' ', '', $data->nama_guru)) . '@paud.local';
            $data = WaliMurid::findOrFail($request->user_wali_id);
            $name = $data->nama_wali;
            $email = $data->email ?? strtolower(str_replace(' ', '', $data->nama_wali)) . '@paud.local';
        }
        
    
        if (User::where('email', $email)->exists()) {
            return back()->with('error', 'Email sudah digunakan untuk akun lain.');
        }
    
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make('123456'),
            'role' => $request->role,
        ]);
    
        $data->update(['user_id' => $user->id]);

    
        return redirect()->route('akun.index')->with('success', 'Akun berhasil dibuat!');
    }

    public function destroy(User $akun)
    {
        $akun->delete();
        return redirect()->route('akun.index')->with('success', 'Akun berhasil dihapus.');
    }
    
    public function edit(User $akun)
    {
        return view('admin.akun.edit', compact('akun'));
    }
    
    public function update(Request $request, User $akun)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $akun->id,
            'role' => 'required|in:admin,guru,wali_murid',
        ]);
    
        $akun->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);
    
        return redirect()->route('akun.index')->with('success', 'Akun berhasil diperbarui.');
    }
    
    public function resetPassword(User $akun)
    {
        $akun->update([
            'password' => Hash::make('123456'),
        ]);
    
        return redirect()->route('akun.index')->with('success', 'Password berhasil direset ke default (123456).');
    }
}
