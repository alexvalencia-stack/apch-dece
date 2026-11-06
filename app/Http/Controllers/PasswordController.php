<?php

namespace App\Http\Controllers;

use App\Rules\ContrasenaSegura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function edit()
    {
        return view('password.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', new ContrasenaSegura],
        ], [
            'current_password.required' => 'La contraseña actual es obligatoria.',
            'current_password.current_password' => 'La contraseña actual no es correcta.',
            'password.required' => 'La nueva contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas nuevas no coinciden.',
        ]);

        $user = $request->user();

        $user->password = Hash::make($request->password);
        $user->save();

        Auth::logoutOtherDevices($request->password);
        $request->session()->regenerate();

        return back()->with('success', 'Tu contraseña ha sido cambiada correctamente.');
    }
}
