<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Universitas;
use App\Models\Prodi;


class RegisterController extends Controller
{
    public function index()
    {
        $universitas = Universitas::all();
        $prodis = Prodi::all();
        return view("user.register", compact('universitas', 'prodis'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');

        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'universitas' => 'required',
            'prodi' => 'required',
        ]);

        //mengecek email di database
        $isEmailExist = User::where('email', $request->email)->exists();

        if ($isEmailExist) {
            return back()
                ->withErrors([
                    'email' => 'This email already exists'
                ])
                ->withInput();
        }

        $data['password'] = Hash::make($request->password);

        $user = User::create($data);

        // Menetapkan peran "User" ke pengguna yang baru didaftarkan
        $user->assignRole('User');

        // Mengaitkan pengguna dengan Prodi yang dipilih
        $user->universitas_id = $request->universitas;
        $user->prodis_id = $request->prodi;
        $user->save();

        // dd(session()->all());
        return redirect()->route('user.login');
    }
}
