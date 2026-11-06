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

    $this->coordinador = User::create([
        'name' => 'Jessica Carrasco',
        'username' => 'coordinador',
        'password' => 'Clave-Actual-2026',
        'role' => 'coordinador',
        'status' => true,
    ]);
});

dataset('contrasenas debiles', [
    'sin mayúscula' => 'clave-segura-2026',
    'sin minúscula' => 'CLAVE-SEGURA-2026',
    'sin carácter especial' => 'ClaveSegura2026',
    'menos de 8 caracteres' => 'Ab-1xyz',
]);

it('rejects a weak password when creating a user', function (string $clave) {
    $this->actingAs($this->coordinador)
        ->post(route('usuarios.store'), [
            'name' => 'Nuevo Analista',
            'username' => 'nuevo',
            'password' => $clave,
            'role' => 'analista',
        ])
        ->assertSessionHasErrors('password');

    expect(User::where('username', 'nuevo')->exists())->toBeFalse();
})->with('contrasenas debiles');

it('accepts a password with upper case, lower case and a special character when creating a user', function () {
    $this->actingAs($this->coordinador)
        ->post(route('usuarios.store'), [
            'name' => 'Nuevo Analista',
            'username' => 'nuevo',
            'password' => 'Clave-Nueva-2026',
            'role' => 'analista',
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('usuarios.index'));

    expect(User::where('username', 'nuevo')->exists())->toBeTrue();
});

it('rejects a weak new password when changing it', function (string $clave) {
    $this->actingAs($this->coordinador)
        ->put(route('password.update'), [
            'current_password' => 'Clave-Actual-2026',
            'password' => $clave,
            'password_confirmation' => $clave,
        ])
        ->assertSessionHasErrors('password');

    expect(Hash::check('Clave-Actual-2026', $this->coordinador->fresh()->password))->toBeTrue();
})->with('contrasenas debiles');

it('explains in Spanish what a valid password needs', function () {
    $this->actingAs($this->coordinador)
        ->put(route('password.update'), [
            'current_password' => 'Clave-Actual-2026',
            'password' => 'clavesimple',
            'password_confirmation' => 'clavesimple',
        ])
        ->assertSessionHasErrors('password');

    expect(session('errors')->first('password'))
        ->toContain('mayúscula')
        ->toContain('minúscula')
        ->toContain('carácter especial');
});
