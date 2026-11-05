<?php

use App\Models\Formulario;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
});

function crearFormularioConArchivos(User $autor, string $nombreFormulario, string $carpeta): Formulario
{
    $formulario = Formulario::create([
        'nombre_formulario' => $nombreFormulario,
        'usuario_id' => $autor->id,
    ]);

    $base = $autor->name.'/'.$carpeta.'/'.$nombreFormulario.'/'.Str::slug($nombreFormulario).'-'.$formulario->id;

    Storage::disk('local')->put($base.'.json', '{}');
    Storage::disk('local')->put($base.'.pdf', "%PDF-1.4\n");

    $formulario->update([
        'datos_path' => $base.'.json',
        'pdf_path' => $base.'.pdf',
    ]);

    return $formulario;
}

it('deletes only the files of the removed record when others share its folder', function () {
    Storage::fake('local');

    $coordinador = User::create([
        'name' => 'Jessica Carrasco',
        'username' => 'coordinador-prueba',
        'password' => 'password',
        'role' => 'coordinador',
        'status' => true,
    ]);
    $analista = User::create([
        'name' => 'Ana Analista',
        'username' => 'analista-prueba',
        'password' => 'password',
        'role' => 'analista',
        'status' => true,
    ]);

    $eliminado = crearFormularioConArchivos($analista, 'ENTREVISTA DOCENTES', 'Curso 8vo');
    $conservado = crearFormularioConArchivos($analista, 'ENTREVISTA DOCENTES', 'Curso 8vo');

    $this->actingAs($coordinador)
        ->delete(route('formularios.eliminar', $eliminado))
        ->assertRedirect(route('formularios.registros'));

    expect(Storage::disk('local')->exists($eliminado->datos_path))->toBeFalse()
        ->and(Storage::disk('local')->exists($eliminado->pdf_path))->toBeFalse()
        ->and(Storage::disk('local')->exists($conservado->datos_path))->toBeTrue()
        ->and(Storage::disk('local')->exists($conservado->pdf_path))->toBeTrue()
        ->and(Formulario::find($conservado->id))->not->toBeNull();
});

it('removes the form folder once its last record is deleted', function () {
    Storage::fake('local');

    $coordinador = User::create([
        'name' => 'Jessica Carrasco',
        'username' => 'coordinador-prueba',
        'password' => 'password',
        'role' => 'coordinador',
        'status' => true,
    ]);

    $formulario = crearFormularioConArchivos($coordinador, 'ENTREVISTA DOCENTES', 'Curso 8vo');

    $this->actingAs($coordinador)
        ->delete(route('formularios.eliminar', $formulario))
        ->assertRedirect(route('formularios.registros'));

    expect(Storage::disk('local')->directoryExists('Jessica Carrasco/Curso 8vo/ENTREVISTA DOCENTES'))->toBeFalse()
        ->and(Storage::disk('local')->directoryExists('Jessica Carrasco/Curso 8vo'))->toBeTrue();
});
