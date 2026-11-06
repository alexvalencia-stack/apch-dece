<?php

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Process\PendingProcess;
use Illuminate\Support\Facades\Process;
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

    Schema::create('formularios', function (Blueprint $table) {
        $table->id();
        $table->string('nombre_formulario');
        $table->unsignedBigInteger('usuario_id');
        $table->string('pdf_path')->nullable();
        $table->string('datos_path')->nullable();
        $table->unsignedTinyInteger('ediciones')->default(0);
        $table->timestamps();
    });

    Storage::fake('local');

    $this->usuario = User::create([
        'name' => 'Ana Analista',
        'username' => 'ana',
        'password' => 'password',
        'role' => 'analista',
        'status' => true,
    ]);
});

dataset('nombres con caracteres no permitidos', [
    'con números' => 'Curso 8vo',
    'solo números' => '2026',
    'con guion' => 'Ciclo-Escolar',
    'con guion bajo' => 'Ciclo_Escolar',
    'con paréntesis' => 'Ciclo (copia)',
    'con punto' => 'Ciclo.Escolar',
    'con espacios dobles' => 'Ciclo  Escolar',
]);

it('rejects a folder name that has anything other than letters and spaces', function (string $nombre) {
    $this->actingAs($this->usuario)
        ->post(route('formularios.carpetas.store'), ['nombre' => $nombre])
        ->assertSessionHasErrors('nombre');

    expect(Storage::disk('local')->directories('Ana Analista'))->toBe([]);
})->with('nombres con caracteres no permitidos');

it('accepts folder names with letters, accents, ñ and single spaces', function (string $nombre) {
    $this->actingAs($this->usuario)
        ->post(route('formularios.carpetas.store'), ['nombre' => $nombre])
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('formularios.index'));

    expect(Storage::disk('local')->directoryExists('Ana Analista/'.$nombre))->toBeTrue();
})->with(['Octavo A', 'Ñandú Pérez', 'Documentos DECE']);

it('still saves documents in an older folder whose name already had digits', function () {
    Storage::disk('local')->makeDirectory('Ana Analista/Curso 8vo');
    Process::fake(function (PendingProcess $process) {
        file_put_contents($process->command[3], "%PDF-1.4\n");

        return Process::result('ok');
    });

    $this->actingAs($this->usuario)
        ->postJson(route('formularios.guardar-documento'), [
            'nombre_formulario' => 'FICHA DE NOTIFICACIÓN DE ALERTA DECE',
            'carpeta' => 'Curso 8vo',
            'datos' => ['estudiante_nombre' => ['tipo' => 'texto', 'valor' => 'Estudiante Ejemplo']],
        ])
        ->assertOk()
        ->assertJsonPath('success', true);
});
