<?php

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
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

it('requires an active authenticated user to access password routes', function () {
    $this->get(route('password.edit'))
        ->assertRedirect(route('login'));

    $this->put(route('password.update'), [
        'current_password' => 'password',
        'password' => 'Nueva-Clave-2026',
        'password_confirmation' => 'Nueva-Clave-2026',
    ])->assertRedirect(route('login'));
});

it('prevents an inactive user from accessing password routes', function () {
    $user = User::create([
        'name' => 'Usuario desactivado',
        'username' => 'usuario-desactivado',
        'password' => 'old-password',
        'role' => 'analista',
        'status' => false,
    ]);

    $this->actingAs($user)
        ->get(route('password.edit'))
        ->assertRedirect(route('login'));

    $this->actingAs($user)
        ->put(route('password.update'), [
            'current_password' => 'old-password',
            'password' => 'Nueva-Clave-2026',
            'password_confirmation' => 'Nueva-Clave-2026',
        ])
        ->assertRedirect(route('login'));
});

it('changes the password and keeps the current session authenticated', function () {
    $user = User::create([
        'name' => 'Analista de prueba',
        'username' => 'analista-prueba',
        'password' => 'old-password',
        'role' => 'analista',
        'status' => true,
    ]);

    $response = $this->actingAs($user)
        ->from(route('password.edit'))
        ->put(route('password.update'), [
            'current_password' => 'old-password',
            'password' => 'Nueva-Clave-2026',
            'password_confirmation' => 'Nueva-Clave-2026',
        ]);

    $response->assertRedirect(route('password.edit'))
        ->assertSessionHas('success');

    expect(Hash::check('Nueva-Clave-2026', $user->fresh()->password))
        ->toBeTrue()
        ->and(session()->has('password_hash_web'))
        ->toBeTrue();

    $this->get(route('formularios.index'))
        ->assertOk();
});

it('rejects a session with the pre-change password hash', function () {
    $user = User::create([
        'name' => 'Analista de prueba',
        'username' => 'analista-prueba',
        'password' => 'old-password',
        'role' => 'analista',
        'status' => true,
    ]);

    $hashAnterior = $user->getAuthPassword();

    $this->actingAs($user)
        ->from(route('password.edit'))
        ->put(route('password.update'), [
            'current_password' => 'old-password',
            'password' => 'Nueva-Clave-2026',
            'password_confirmation' => 'Nueva-Clave-2026',
        ])
        ->assertRedirect(route('password.edit'));

    $this->withSession([
        'password_hash_web' => $hashAnterior,
    ])->get(route('formularios.index'))
        ->assertRedirect(route('login'));
});
