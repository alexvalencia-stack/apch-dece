<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::all();

        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8',
            'role' => 'required|in:coordinador,analista',
        ]);

        User::create($datos);

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    public function desactivar(User $usuario)
    {
        $usuario->status = false;
        $usuario->save();

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario desactivado correctamente.');
    }

    public function reactivar(User $usuario)
    {
        $usuario->status = true;
        $usuario->save();

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario reactivado correctamente.');
    }
}
