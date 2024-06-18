<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\PasswordResetToken;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function index() {
        return view("user.login");
    }

    public function auth(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            return redirect()->route('home');
        }

        return redirect()->route('user.login')
        ->withInput($request->only('email'))
        ->withErrors(['credentials' => 'Invalid credentials']);
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function forgot_password() {
        return view('user.auth.forgot-password');
    }

    public function forgot_password_act(Request $request)
     {
        $customMessage = [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.exists' => 'Email tidak terdaftar di database',
        ];

        $request->validate([
            'email' =>'required|email|exists:users,email',
        ], $customMessage);

        $existingToken = PasswordResetToken::where('email', $request->email)->first();

        $token = Str::random(60);

        if($existingToken) {
            $existingToken->update([
                'token' => $token,
                'created_at' => now(),
            ]);
        }else {
            PasswordResetToken::create(
                [
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => now(),
                ]
            );
        }

        if ($request->email) {
            Mail::to($request->email)->send(new ResetPasswordMail($token));
        }

        return redirect()->route('forgot-password')->with('success', 'true');
    }

    public function validasi_forgot_password(Request $request, $token) {

        $getToken = PasswordResetToken::where('token', $token)->first();

        if(!$getToken) {
            return redirect()->route('forgot-password')->with('error', 'Token tidak valid');
        }
        return view('user.auth.validasi-token', compact('token'));
    }

    public function validasi_forgot_password_act(Request $request) {
        $customMessage = [
            'password.required' => 'Password tidak boleh kosong',
            'email.min' => 'Password minimal 6 karakter',
        ];

        $request->validate([
            'password' =>'required|min:6',
        ], $customMessage);

        // dd($request->all());

       $token = PasswordResetToken::where('token', $request->token)->first();

       if(!$token) {
        return redirect()->route('user.login')->with('error','Token tidak valid');
       }

       $user = User::where('email', $token->email)->first();

       if(!$user) {
        return redirect()->route('user.login')->with('error','Email tidak terdaftar di database');
       }

       $user->update([
        'password' => Hash::make($request->password)
       ]);

       $token->delete();

        return redirect()->route('user.login')->with('success', 'Password Berhasil direset');
    }
}
