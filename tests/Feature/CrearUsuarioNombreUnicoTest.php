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
});

it('rejects a new user whose name is already used, since the name names the storage folder', function () {
    $coordinador = User::create([
        'name' => 'Jessica Carrasco',
        'username' => 'coordinador',
        'password' => 'password',
        'role' => 'coordinador',
        'status' => true,
    ]);
    User::create([
        'name' => 'Juan Pérez',
        'username' => 'juan',
        'password' => 'password',
        'role' => 'analista',
        'status' => true,
    ]);

    $this->actingAs($coordinador)
        ->post(route('usuarios.store'), [
            'name' => 'Juan Pérez',
            'username' => 'juan2',
            'password' => 'password-segura',
            'role' => 'analista',
        ])
        ->assertSessionHasErrors('name');

    expect(User::where('username', 'juan2')->exists())->toBeFalse();
});
