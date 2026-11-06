<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    private const MAXIMO_INTENTOS_FALLIDOS = 5;

    private const MINUTOS_DE_BLOQUEO = 15;

    public function login(Request $request)
    {
        $credenciales = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $claveLimite = $this->claveLimite($request);

        if (RateLimiter::tooManyAttempts($claveLimite, self::MAXIMO_INTENTOS_FALLIDOS)) {
            $minutos = (int) ceil(RateLimiter::availableIn($claveLimite) / 60);

            throw ValidationException::withMessages([
                'username' => "El acceso está bloqueado por demasiados intentos fallidos. Intente nuevamente en {$minutos} minuto(s).",
            ])->status(429);
        }

        $credenciales['status'] = true;

        if (Auth::attempt($credenciales)) {
            RateLimiter::clear($claveLimite);
            $request->session()->regenerate();

            if (Auth::user()->role === 'coordinador') {
                return redirect()->route('dashboard');
            }

            return redirect()->route('secretario.dashboard');
        }

        RateLimiter::hit($claveLimite, self::MINUTOS_DE_BLOQUEO * 60);

        return back()
            ->withErrors([
                'username' => 'El usuario o la contraseña son incorrectos.',
            ])
            ->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function claveLimite(Request $request): string
    {
        return 'login|'.Str::lower((string) $request->input('username')).'|'.$request->ip();
    }
}
