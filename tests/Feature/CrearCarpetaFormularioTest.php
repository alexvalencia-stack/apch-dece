<?php

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

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

it('creates a named folder in private storage', function () {
    Storage::fake('local');

    $usuario = User::create([
        'name' => 'Usuario selector',
        'username' => 'usuario-selector',
        'password' => 'password',
        'role' => 'analista',
        'status' => true,
    ]);

    $this->actingAs($usuario)
        ->post(route('formularios.carpetas.store'), [
            'nombre' => 'Ciclo Escolar',
        ])
        ->assertRedirect(route('formularios.index'))
        ->assertSessionHas('success', 'La carpeta se creó correctamente.');

    expect(Storage::disk('local')->directoryExists('Usuario selector/Ciclo Escolar'))->toBeTrue();
});

it('shows the folder creation option on the forms page', function () {
    $usuario = User::create([
        'name' => 'Analista de prueba',
        'username' => 'analista-prueba',
        'password' => 'password',
        'role' => 'analista',
        'status' => true,
    ]);

    $this->actingAs($usuario)
        ->get(route('formularios.index'))
        ->assertOk()
        ->assertSee('Crear carpeta')
        ->assertSee('storage/app/private');
});

it('offers only folders created by the signed-in user in a form toolbar', function () {
    $usuario = User::create([
        'name' => 'Usuario selector',
        'username' => 'usuario-selector',
        'password' => 'password',
        'role' => 'analista',
        'status' => true,
    ]);
    $otroUsuario = User::create([
        'name' => 'Otro analista',
        'username' => 'otro-analista',
        'password' => 'password',
        'role' => 'analista',
        'status' => true,
    ]);
    Storage::disk('local')->deleteDirectory('Otro analista');
    Storage::disk('local')->deleteDirectory('Usuario selector');
    Storage::disk('local')->deleteDirectory('usuarios/'.$usuario->id);
    Storage::disk('local')->makeDirectory('Usuario selector/Carpeta propia');
    Storage::disk('local')->makeDirectory('Otro analista/Documentos privados');

    $this->actingAs($usuario)
        ->get(route('formularios.entrevista-estudiantes'))
        ->assertOk()
        ->assertSee('value="Carpeta propia"', false)
        ->assertSee('Carpeta propia')
        ->assertDontSee('value="Mis documentos"', false)
        ->assertDontSee('Documentos privados')
        ->assertDontSee('Almacenamiento interno')
        ->assertSee('name="carpeta" required', false);
});

it('requires authentication to create a folder', function () {
    $this->post(route('formularios.carpetas.store'), [
        'nombre' => 'Carpeta privada',
    ])->assertRedirect(route('login'));
});

it('prevents an inactive user from creating a folder', function () {
    Storage::fake('local');

    $usuario = User::create([
        'name' => 'Usuario desactivado',
        'username' => 'usuario-desactivado',
        'password' => 'password',
        'role' => 'analista',
        'status' => false,
    ]);

    $this->actingAs($usuario)
        ->post(route('formularios.carpetas.store'), [
            'nombre' => 'Carpeta privada',
        ])
        ->assertRedirect(route('login'));

    expect(Storage::disk('local')->directories())->toBe([]);
});

it('rejects folder names that could escape private storage', function () {
    Storage::fake('local');

    $usuario = User::create([
        'name' => 'Analista de prueba',
        'username' => 'analista-prueba',
        'password' => 'password',
        'role' => 'analista',
        'status' => true,
    ]);

    $this->actingAs($usuario)
        ->from(route('formularios.index'))
        ->post(route('formularios.carpetas.store'), [
            'nombre' => '../fuera',
        ])
        ->assertRedirect(route('formularios.index'))
        ->assertSessionHasErrors('nombre');

    expect(Storage::disk('local')->directories())->toBe([]);
});

it('does not overwrite an existing folder', function () {
    Storage::fake('local');

    $usuario = User::create([
        'name' => 'Analista de prueba',
        'username' => 'analista-prueba',
        'password' => 'password',
        'role' => 'analista',
        'status' => true,
    ]);
    Storage::disk('local')->makeDirectory('Analista de prueba/Carpeta existente');

    $this->actingAs($usuario)
        ->from(route('formularios.index'))
        ->post(route('formularios.carpetas.store'), [
            'nombre' => 'Carpeta existente',
        ])
        ->assertRedirect(route('formularios.index'))
        ->assertSessionHasErrors('nombre');

    expect(Storage::disk('local')->directoryExists('Analista de prueba/Carpeta existente'))->toBeTrue();
});
