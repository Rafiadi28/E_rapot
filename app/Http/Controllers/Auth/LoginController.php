<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->isSuperadmin()) {
            return redirect()->route('superadmin.dashboard');
        } elseif ($user->isWakaKurikulum()) {
            return redirect()->route('wakakurikulum.dashboard');
        } elseif ($user->isGuruMapel()) {
            return redirect()->route('gurumapel.dashboard');
        } elseif ($user->isWalikelas()) {
            return redirect()->route('walikelas.dashboard');
        }

        return redirect('/home');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->withInput($request->only('email', 'remember'))
            ->with('error', 'Email atau password yang Anda masukkan salah.');
    }

    // Tambahkan method ini untuk menentukan field login
    public function username()
    {
        return 'email';
    }
}
