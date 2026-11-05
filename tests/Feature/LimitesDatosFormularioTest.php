<?php

use App\Models\Formulario;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('username');
        $table->string('password');
        $table->string('role');
        $table->boolean('status')->default(true);
        $table->timestamps();
    });

    Schema::create('formularios', function (Blueprint $table) {
        $table->id();
        $table->string('nombre_formulario');
        $table->unsignedBigInteger('usuario_id');
        $table->string('pdf_path')->nullable();
        $table->string('datos_path')->nullable();
        $table->unsignedTinyInteger('ediciones')->default(0);
        $table->timestamps();
    });

    $this->usuario = User::create([
        'name' => 'Ana Analista',
        'username' => 'ana',
        'password' => 'password',
        'role' => 'analista',
        'status' => true,
    ]);
});

it('rejects form data larger than the allowed size when saving a document', function () {
    Storage::fake('local');
    Storage::disk('local')->makeDirectory('Ana Analista/Curso 8vo');

    $this->actingAs($this->usuario)
        ->postJson(route('formularios.guardar-documento'), [
            'nombre_formulario' => 'ENTREVISTA DOCENTES',
            'carpeta' => 'Curso 8vo',
            'datos' => ['observaciones' => str_repeat('a', 3 * 1024 * 1024)],
        ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('datos');

    expect(Formulario::count())->toBe(0);
});

it('rejects form data larger than the allowed size when updating a document', function () {
    Storage::fake('local');

    $formulario = Formulario::create([
        'nombre_formulario' => 'ENTREVISTA DOCENTES',
        'usuario_id' => $this->usuario->id,
        'datos_path' => 'Ana Analista/Curso 8vo/ENTREVISTA DOCENTES/entrevista-docentes-1.json',
    ]);

    $this->actingAs($this->usuario)
        ->putJson(route('formularios.actualizar', $formulario), [
            'datos' => ['observaciones' => str_repeat('a', 3 * 1024 * 1024)],
        ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('datos');

    expect($formulario->fresh()->ediciones)->toBe(0);
});

it('no longer exposes a route that registers forms without data', function () {
    $this->actingAs($this->usuario)
        ->post('/formularios/registrar', ['nombre_formulario' => 'LO QUE SEA'])
        ->assertNotFound();

    expect(Formulario::count())->toBe(0);
});
