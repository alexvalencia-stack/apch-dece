<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsuariosPruebaSeeder extends Seeder
{
    /**
     * Usuarios solo para desarrollo local; DatabaseSeeder los crea únicamente en el entorno local.
     *
     * @var array<int, array{name: string, username: string, password: string, role: string}>
     */
    public const USUARIOS = [
        [
            'name' => 'Coordinador de Prueba',
            'username' => 'coordinador.prueba',
            'password' => 'Dece-Coord-2026',
            'role' => 'coordinador',
        ],
        [
            'name' => 'Analista de Prueba',
            'username' => 'analista.prueba',
            'password' => 'Dece-Analista-2026',
            'role' => 'analista',
        ],
    ];

    public function run(): void
    {
        foreach (self::USUARIOS as $usuario) {
            User::updateOrCreate(
                ['username' => $usuario['username']],
                $usuario + ['status' => true]
            );
        }
    }
}
