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

    Storage::fake('local');
    Process::fake();

    $this->usuario = User::create([
        'name' => 'Jessica Carrasco',
        'username' => 'coordinador-prueba',
        'password' => 'password',
        'role' => 'coordinador',
        'status' => true,
    ]);
    Storage::disk('local')->makeDirectory('Jessica Carrasco/Documentos DECE');
});

function guardarFichaAlerta($prueba): void
{
    $prueba->actingAs($prueba->usuario)->postJson(route('formularios.guardar-documento'), [
        'nombre_formulario' => 'FICHA DE NOTIFICACIÓN DE ALERTA DECE',
        'carpeta' => 'Documentos DECE',
        'datos' => ['estudiante_nombre' => ['tipo' => 'texto', 'valor' => 'Estudiante Ejemplo']],
    ])->assertOk();
}

it('passes the configured Chrome path and the no-sandbox setting to the PDF script', function () {
    config(['services.pdf.chrome_path' => '/usr/bin/google-chrome', 'services.pdf.sandbox' => false]);

    guardarFichaAlerta($this);

    Process::assertRan(fn (PendingProcess $process): bool => ($process->environment['CHROME_PATH'] ?? null) === '/usr/bin/google-chrome'
        && ($process->environment['PDF_SANDBOX'] ?? null) === '0');
});

it('lets the PDF script run Chrome with its sandbox when configured', function () {
    config(['services.pdf.chrome_path' => '/opt/chrome/chrome', 'services.pdf.sandbox' => true]);

    guardarFichaAlerta($this);

    Process::assertRan(fn (PendingProcess $process): bool => ($process->environment['CHROME_PATH'] ?? null) === '/opt/chrome/chrome'
        && ($process->environment['PDF_SANDBOX'] ?? null) === '1');
});
