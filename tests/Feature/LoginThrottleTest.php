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

it('blocks further login attempts after too many failures for the same username', function () {
    foreach (range(1, 5) as $intento) {
        $this->post(route('login.authenticate'), [
            'username' => 'ana',
            'password' => 'incorrecta-'.$intento,
        ])->assertSessionHasErrors('username');
    }

    $this->post(route('login.authenticate'), [
        'username' => 'ana',
        'password' => 'password-correcta',
    ])->assertTooManyRequests();

    $this->assertGuest();
});

it('does not block a different username from the same address', function () {
    foreach (range(1, 5) as $intento) {
        $this->post(route('login.authenticate'), [
            'username' => 'ana',
            'password' => 'incorrecta-'.$intento,
        ]);
    }

    User::create([
        'name' => 'Beto Analista',
        'username' => 'beto',
        'password' => 'password-correcta',
        'role' => 'analista',
        'status' => true,
    ]);

    $this->post(route('login.authenticate'), [
        'username' => 'beto',
        'password' => 'password-correcta',
    ])->assertRedirect(route('secretario.dashboard'));

    $this->assertAuthenticated();
});
