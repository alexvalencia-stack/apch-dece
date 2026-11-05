<?php

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\UsuariosPruebaSeeder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

beforeEach(function () {
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('username')->unique();
        $table->string('password');
        $table->string('role');
        $table->boolean('status')->default(true);
        $table->timestamps();
    });
});

it('creates one active coordinador and one active analista that can sign in', function () {
    $this->seed(UsuariosPruebaSeeder::class);

    foreach (UsuariosPruebaSeeder::USUARIOS as $usuario) {
        expect(Auth::attempt([
            'username' => $usuario['username'],
            'password' => $usuario['password'],
            'status' => true,
        ]))->toBeTrue()
            ->and(Auth::user()->role)->toBe($usuario['role']);

        Auth::logout();
    }

    expect(collect(UsuariosPruebaSeeder::USUARIOS)->pluck('role')->sort()->values()->all())
        ->toBe(['analista', 'coordinador']);
});

it('does not duplicate the test users when seeded twice', function () {
    $this->seed(UsuariosPruebaSeeder::class);
    $this->seed(UsuariosPruebaSeeder::class);

    expect(User::count())->toBe(count(UsuariosPruebaSeeder::USUARIOS));
});

it('seeds the test users from the main seeder only in the local environment', function () {
    $this->seed(DatabaseSeeder::class);

    expect(User::count())->toBe(0);

    app()->detectEnvironment(fn (): string => 'local');
    $this->seed(DatabaseSeeder::class);

    expect(User::count())->toBe(count(UsuariosPruebaSeeder::USUARIOS));
});
