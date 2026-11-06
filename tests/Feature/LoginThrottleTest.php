<?php

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
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

    User::create([
        'name' => 'Ana Analista',
        'username' => 'ana',
        'password' => 'password-correcta',
        'role' => 'analista',
        'status' => true,
    ]);
});

function intentarLogin(string $usuario, string $clave)
{
    return test()->post(route('login.authenticate'), [
        'username' => $usuario,
        'password' => $clave,
    ]);
}

it('blocks the account after five failed attempts, even with the right password', function () {
    foreach (range(1, 5) as $intento) {
        intentarLogin('ana', 'incorrecta-'.$intento)->assertSessionHasErrors('username');
    }

    $respuesta = intentarLogin('ana', 'password-correcta');

    $respuesta->assertSessionHasErrors('username');
    expect(session('errors')->first('username'))->toContain('bloqueado');
    $this->assertGuest();
});

it('does not count successful logins towards the limit', function () {
    foreach (range(1, 7) as $vez) {
        intentarLogin('ana', 'password-correcta')->assertRedirect(route('secretario.dashboard'));
        $this->post(route('logout'));
    }

    $this->assertGuest();
});

it('clears the failed attempts after a successful login', function () {
    foreach (range(1, 4) as $intento) {
        intentarLogin('ana', 'incorrecta-'.$intento);
    }

    intentarLogin('ana', 'password-correcta')->assertRedirect(route('secretario.dashboard'));
    $this->post(route('logout'));

    foreach (range(1, 4) as $intento) {
        intentarLogin('ana', 'incorrecta-'.$intento);
    }

    intentarLogin('ana', 'password-correcta')->assertRedirect(route('secretario.dashboard'));
});

it('lifts the block after fifteen minutes', function () {
    foreach (range(1, 5) as $intento) {
        intentarLogin('ana', 'incorrecta-'.$intento);
    }

    intentarLogin('ana', 'password-correcta')->assertSessionHasErrors('username');

    $this->travel(16)->minutes();

    intentarLogin('ana', 'password-correcta')->assertRedirect(route('secretario.dashboard'));
});

it('does not block a different username from the same address', function () {
    foreach (range(1, 5) as $intento) {
        intentarLogin('ana', 'incorrecta-'.$intento);
    }

    User::create([
        'name' => 'Beto Analista',
        'username' => 'beto',
        'password' => 'password-correcta',
        'role' => 'analista',
        'status' => true,
    ]);

    intentarLogin('beto', 'password-correcta')->assertRedirect(route('secretario.dashboard'));
    $this->assertAuthenticated();
});
