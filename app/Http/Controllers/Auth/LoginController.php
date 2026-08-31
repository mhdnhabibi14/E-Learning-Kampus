<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('logout');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = ['email' => $request->validated('email'), 'password' => $request->validated('password'),]; /* * Attempt login. */
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate(); /* * Update last login. */
            $request->user()->update(['last_login_at' => now(),]); /* * Redirect berdasarkan role. */
            return match ($request->user()->role) {
                'admin' => redirect()->route('admin.dashboard'),
                'dosen' => redirect()->route('dosen.dashboard'),
                'mahasiswa' => redirect()->route('mahasiswa.dashboard'),
                default => redirect()->route('login')->withErrors(['email' => 'Role pengguna tidak valid.',]),
            };
        } /* * Login gagal. */
        return back()->withErrors(['email' => 'Email atau password yang Anda masukkan salah.',])->withInput($request->only('email'));
    }
}
