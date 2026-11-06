<?php

use App\Models\Formulario;
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
});

it('stores the submitted form data and creates its PDF after responding', function () {
    Storage::fake('local');

    $usuario = User::create([
        'name' => 'Jessica Carrasco',
        'username' => 'coordinador-prueba',
        'password' => 'password',
        'role' => 'coordinador',
        'status' => true,
    ]);
    Storage::disk('local')->makeDirectory('Jessica Carrasco/Documentos DECE');

    Process::fake(function (PendingProcess $process) {
        $comando = $process->command;

        expect($comando)->toBeArray();

        $html = file_get_contents($comando[2]);

        expect($html)
            ->toContain('datos-formulario-pdf')
            ->toContain('data:image/png;base64,')
            ->not->toContain('images/escudo-dece.png')
            ->toContain('Estudiante Ejemplo');

        file_put_contents($comando[3], "%PDF-1.4\nPDF de prueba\n");

        return Process::result('PDF generado');
    });

    $respuesta = $this->actingAs($usuario)->postJson(route('formularios.guardar-documento'), [
        'nombre_formulario' => 'FICHA DE NOTIFICACIÓN DE ALERTA DECE',
        'carpeta' => 'Documentos DECE',
        'datos' => [
            'estudiante_nombre' => [
                'tipo' => 'texto',
                'valor' => 'Estudiante Ejemplo',
            ],
        ],
    ]);

    $respuesta->assertOk()
        ->assertJsonPath('success', true);

    $formulario = Formulario::query()->sole();

    Storage::disk('local')->assertExists([
        $formulario->datos_path,
        $formulario->pdf_path,
    ]);
    Storage::disk('local')->assertMissing('formularios/'.$formulario->id.'/formulario.html');

    expect($formulario->datos_path)
        ->toBe('Jessica Carrasco/Documentos DECE/FICHA DE NOTIFICACIÓN DE ALERTA DECE/ficha-de-notificacion-de-alerta-dece-'.$formulario->id.'.json');
    expect($formulario->pdf_path)
        ->toBe('Jessica Carrasco/Documentos DECE/FICHA DE NOTIFICACIÓN DE ALERTA DECE/ficha-de-notificacion-de-alerta-dece-'.$formulario->id.'.pdf');
    expect(json_decode(Storage::disk('local')->get($formulario->datos_path), true))
        ->toBe([
            'estudiante_nombre' => [
                'tipo' => 'texto',
                'valor' => 'Estudiante Ejemplo',
            ],
        ]);

    Process::assertRan(fn (PendingProcess $process): bool => is_array($process->command) && $process->command[0] === 'node'
    );
});

it('stores JSON and PDF directly in the selected personal folder under the form name', function () {
    Storage::fake('local');

    $usuario = User::create([
        'name' => 'Analista de prueba',
        'username' => 'analista-prueba',
        'password' => 'password',
        'role' => 'analista',
        'status' => true,
    ]);
    $rutaCarpeta = 'Analista de prueba/Informes';
    Storage::disk('local')->makeDirectory($rutaCarpeta);

    Process::fake(function (PendingProcess $process) {
        $comando = $process->command;
        file_put_contents($comando[3], "%PDF-1.4\nPDF de prueba\n");

        return Process::result('PDF generado');
    });

    $respuesta = $this->actingAs($usuario)->postJson(route('formularios.guardar-documento'), [
        'nombre_formulario' => 'FICHA DE NOTIFICACIÓN DE ALERTA DECE',
        'carpeta' => 'Informes',
        'datos' => [
            'estudiante_nombre' => [
                'tipo' => 'texto',
                'valor' => 'Estudiante Ejemplo',
            ],
        ],
    ]);

    $respuesta->assertOk()
        ->assertJsonPath('success', true);

    $formulario = Formulario::query()->sole();
    $nombreArchivo = 'ficha-de-notificacion-de-alerta-dece-'.$formulario->id;
    $rutaFormulario = $rutaCarpeta.'/FICHA DE NOTIFICACIÓN DE ALERTA DECE';
    $rutaJson = $rutaFormulario.'/'.$nombreArchivo.'.json';
    $rutaPdf = $rutaFormulario.'/'.$nombreArchivo.'.pdf';

    expect($formulario->datos_path)->toBe($rutaJson)
        ->and($formulario->pdf_path)->toBe($rutaPdf)
        ->and(json_decode(Storage::disk('local')->get($rutaJson), true))
        ->toBe([
            'estudiante_nombre' => [
                'tipo' => 'texto',
                'valor' => 'Estudiante Ejemplo',
            ],
        ]);

    expect(Storage::disk('local')->get($rutaPdf))->toContain('PDF de prueba');
    Storage::disk('local')->assertMissing('formularios/'.$formulario->id.'/datos.json');
    Storage::disk('local')->assertMissing('formularios/'.$formulario->id.'/documento.pdf');
    expect(Storage::disk('local')->directoryExists('formularios/'.$formulario->id))->toBeFalse();
});

it('does not allow saving a form into another users folder', function () {
    Storage::fake('local');

    $usuario = User::create([
        'name' => 'Analista de prueba',
        'username' => 'analista-prueba',
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
    Storage::disk('local')->makeDirectory('Otro analista/Privada');

    $this->actingAs($usuario)
        ->postJson(route('formularios.guardar-documento'), [
            'nombre_formulario' => 'FICHA DE NOTIFICACIÓN DE ALERTA DECE',
            'carpeta' => 'Privada',
            'datos' => ['campo' => 'dato'],
        ])
        ->assertUnprocessable()
        ->assertJsonPath('success', false);

    expect(Formulario::query()->count())->toBe(0);
});

it('requires a folder before saving a form', function () {
    Storage::fake('local');

    $usuario = User::create([
        'name' => 'Analista de prueba',
        'username' => 'analista-prueba',
        'password' => 'password',
        'role' => 'analista',
        'status' => true,
    ]);

    $this->actingAs($usuario)
        ->postJson(route('formularios.guardar-documento'), [
            'nombre_formulario' => 'FICHA DE NOTIFICACIÓN DE ALERTA DECE',
            'datos' => ['campo' => 'dato'],
        ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('carpeta');

    expect(Formulario::query()->count())->toBe(0);
});

it('returns a successful save and preserves form data when PDF generation fails', function () {
    Storage::fake('local');

    $usuario = User::create([
        'name' => 'Coordinador de prueba',
        'username' => 'coordinador-prueba',
        'password' => 'password',
        'role' => 'coordinador',
        'status' => true,
    ]);
    Storage::disk('local')->makeDirectory('Coordinador de prueba/Pruebas');

    Process::fake(fn () => Process::result('', 'Falló Puppeteer', 1));

    $respuesta = $this->actingAs($usuario)->postJson(route('formularios.guardar-documento'), [
        'nombre_formulario' => 'FICHA DE NOTIFICACIÓN DE ALERTA DECE',
        'carpeta' => 'Pruebas',
        'datos' => [
            'estudiante_nombre' => [
                'tipo' => 'texto',
                'valor' => 'Estudiante Ejemplo',
            ],
        ],
    ]);

    $respuesta->assertOk()
        ->assertJsonPath('success', true);

    $formulario = Formulario::query()->sole();

    expect($formulario->datos_path)->toBe(
        'Coordinador de prueba/Pruebas/FICHA DE NOTIFICACIÓN DE ALERTA DECE/ficha-de-notificacion-de-alerta-dece-'.$formulario->id.'.json'
    )
        ->and($formulario->pdf_path)->toBeNull();

    Storage::disk('local')->assertExists($formulario->datos_path);
    Storage::disk('local')->assertMissing($formulario->pdf_path ?? 'formularios/'.$formulario->id.'/documento.pdf');

    expect(json_decode(Storage::disk('local')->get($formulario->datos_path), true))
        ->toBe([
            'estudiante_nombre' => [
                'tipo' => 'texto',
                'valor' => 'Estudiante Ejemplo',
            ],
        ]);
});

it('keeps the saved form when the renderer exits without creating a PDF', function () {
    Storage::fake('local');

    $usuario = User::create([
        'name' => 'Coordinador de prueba',
        'username' => 'coordinador-prueba',
        'password' => 'password',
        'role' => 'coordinador',
        'status' => true,
    ]);
    Storage::disk('local')->makeDirectory('Coordinador de prueba/Pruebas');

    Process::fake(fn () => Process::result());

    $respuesta = $this->actingAs($usuario)->postJson(route('formularios.guardar-documento'), [
        'nombre_formulario' => 'FICHA DE NOTIFICACIÓN DE ALERTA DECE',
        'carpeta' => 'Pruebas',
        'datos' => [
            'estudiante_nombre' => [
                'tipo' => 'texto',
                'valor' => 'Estudiante Ejemplo',
            ],
        ],
    ]);

    $respuesta->assertOk()
        ->assertJsonPath('success', true);

    $formulario = Formulario::query()->sole();

    Storage::disk('local')->assertExists($formulario->datos_path);
    Storage::disk('local')->assertMissing($formulario->pdf_path ?? 'formularios/'.$formulario->id.'/documento.pdf');
});

it('lists only the current user forms matching the selected form type', function () {
    $usuario = User::create([
        'name' => 'Analista de prueba',
        'username' => 'analista-prueba',
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

    $formularioPropio = Formulario::create([
        'nombre_formulario' => 'FICHA DE NOTIFICACIÓN DE ALERTA DECE',
        'usuario_id' => $usuario->id,
        'datos_path' => 'Analista de prueba/Archivo anual/FICHA DE NOTIFICACIÓN DE ALERTA DECE/ficha-de-notificacion-de-alerta-dece-1.json',
        'ediciones' => 0,
    ]);
    $formularioDeOtroUsuario = Formulario::create([
        'nombre_formulario' => 'FICHA DE NOTIFICACIÓN DE ALERTA DECE',
        'usuario_id' => $otroUsuario->id,
        'ediciones' => 0,
    ]);
    $otroTipoPropio = Formulario::create([
        'nombre_formulario' => 'FICHA DE OBSERVACIÓN',
        'usuario_id' => $usuario->id,
        'ediciones' => 0,
    ]);

    $respuesta = $this->actingAs($usuario)->get(route('formularios.mis-documentos', [
        'tipo' => 'ficha-alerta-dece',
    ]));

    $respuesta->assertOk()
        ->assertSee('Mis Formularios: FICHA DE NOTIFICACIÓN DE ALERTA DECE')
        ->assertDontSee('Logo APCH')
        ->assertDontSee('APCH · DECE')
        ->assertSee('FICHA DE NOTIFICACIÓN DE ALERTA DECE')
        ->assertSee('class="record-id">#'.$formularioPropio->id.'</td>', false)
        ->assertSee('<th scope="col">Identificador</th>', false)
        ->assertSee('<td class="record-identifier">Archivo anual</td>', false)
        ->assertDontSee('class="record-id">#'.$formularioDeOtroUsuario->id.'</td>', false)
        ->assertDontSee('class="record-id">#'.$otroTipoPropio->id.'</td>', false);
});

it('shows each form folder in the coordinator registration table', function () {
    $coordinador = User::create([
        'name' => 'Coordinador',
        'username' => 'coordinador',
        'password' => 'password',
        'role' => 'coordinador',
        'status' => true,
    ]);
    $usuario = User::create([
        'name' => 'Analista de prueba',
        'username' => 'analista-prueba',
        'password' => 'password',
        'role' => 'analista',
        'status' => true,
    ]);
    $formulario = Formulario::create([
        'nombre_formulario' => 'FICHA DE OBSERVACIÓN',
        'usuario_id' => $usuario->id,
        'datos_path' => 'Analista de prueba/Carpeta propia/FICHA DE OBSERVACIÓN/ficha-observacion-1.json',
        'ediciones' => 0,
    ]);

    $this->actingAs($coordinador)
        ->get(route('formularios.registros'))
        ->assertOk()
        ->assertSee('Identificador')
        ->assertSee('class="folder-identifier"', false)
        ->assertSee('Carpeta propia')
        ->assertSee('#'.$formulario->id);
});

it('returns not found for an unsupported form type in the personal list', function () {
    $usuario = User::create([
        'name' => 'Analista de prueba',
        'username' => 'analista-prueba',
        'password' => 'password',
        'role' => 'analista',
        'status' => true,
    ]);

    $this->actingAs($usuario)
        ->get(route('formularios.mis-documentos', ['tipo' => 'tipo-desconocido']))
        ->assertNotFound();
});

it('opens a personal list for every supported form type', function (string $tipo, string $nombreFormulario) {
    $usuario = User::create([
        'name' => 'Analista de prueba',
        'username' => 'analista-prueba',
        'password' => 'password',
        'role' => 'analista',
        'status' => true,
    ]);

    $this->actingAs($usuario)
        ->get(route('formularios.mis-documentos', ['tipo' => $tipo]))
        ->assertOk()
        ->assertSee($nombreFormulario);
})->with([
    'entrevista estudiantes' => ['entrevista-estudiantes', 'ENTREVISTA ESTUDIANTES'],
    'ficha de observación' => ['ficha-observacion', 'FICHA DE OBSERVACIÓN'],
    'ficha de derivación' => ['ficha-derivacion', 'FICHA DE DERIVACIÓN'],
    'entrevista representantes' => ['entrevista-representantes', 'ENTREVISTA REPRESENTANTES'],
    'entrevista docentes' => ['entrevista-docentes', 'ENTREVISTA DOCENTES'],
    'consentimiento informado' => ['consentimiento-informado', 'CONSENTIMIENTO INFORMADO'],
    'ficha alerta dece' => ['ficha-alerta-dece', 'FICHA DE NOTIFICACIÓN DE ALERTA DECE'],
    'plan de atención psicosocial' => ['plan-atencion-psicosocial', 'PLAN DE ATENCIÓN PSICOSOCIAL Y SEGUIMIENTO'],
]);

it('renders the shared institutional header and toolbar on all form templates', function (string $rutaFormulario) {
    $usuario = User::create([
        'name' => 'Analista de prueba',
        'username' => 'analista-prueba',
        'password' => 'password',
        'role' => 'analista',
        'status' => true,
    ]);

    $contenido = $this->actingAs($usuario)
        ->get(route($rutaFormulario))
        ->assertOk()
        ->getContent();

    expect($contenido)
        ->toContain('class="dece-header"')
        ->toContain('src="'.asset('images/escudo-dece.png').'"')
        ->toContain('UNIDAD EDUCATIVA')
        ->toContain('&ldquo;ANGEL POLIBIO CHAVES&rdquo;')
        ->toContain('San Miguel - Provincia Bolívar - Ecuador')
        ->toContain('.toolbar::after')
        ->toContain('border-left: 5px solid #a31616')
        ->toContain('border-radius: 16px')
        ->toContain('🗑 Borrar todo')
        ->toContain('🖨 Guardar e imprimir')
        ->toContain('📂 Mis formularios')
        ->not->toContain('↩ Volver');

    expect(substr_count($contenido, 'class="dece-header"'))
        ->toBe($rutaFormulario === 'formularios.plan-atencion-psicosocial' ? 2 : 1);
})->with([
    'entrevista estudiantes' => ['formularios.entrevista-estudiantes'],
    'ficha observacion' => ['formularios.ficha-observacion'],
    'ficha derivacion' => ['formularios.ficha-derivacion'],
    'entrevista representantes' => ['formularios.entrevista-representantes'],
    'entrevista docentes' => ['formularios.entrevista-docentes'],
    'consentimiento informado' => ['formularios.consentimiento-informado'],
    'alerta dece' => ['formularios.ficha-alerta-dece'],
    'plan de atencion' => ['formularios.plan-atencion-psicosocial'],
]);

it('keeps four initial action rows and eight follow-up rows with printable page margins', function () {
    $usuario = User::create([
        'name' => 'Analista de prueba',
        'username' => 'analista-prueba',
        'password' => 'password',
        'role' => 'analista',
        'status' => true,
    ]);

    $contenido = $this->actingAs($usuario)
        ->get(route('formularios.plan-atencion-psicosocial'))
        ->assertOk()
        ->getContent();

    expect($contenido)
        ->toContain('margin: 10mm 8mm')
        ->toContain('padding-top: 32.8mm')
        ->toContain('min-height: 0;')
        ->toContain('page-break-after: always');

    expect(substr_count($contenido, 'class="actions-row dynamic-action-row"'))
        ->toBe(4);

    expect(substr_count($contenido, 'class="follow-row dynamic-follow-row"'))
        ->toBe(8);
});

it('allows the derivation history field to grow and flow across printed pages', function () {
    $usuario = User::create([
        'name' => 'Analista de prueba',
        'username' => 'analista-prueba',
        'password' => 'password',
        'role' => 'analista',
        'status' => true,
    ]);

    $contenido = $this->actingAs($usuario)
        ->get(route('formularios.ficha-derivacion'))
        ->assertOk()
        ->getContent();

    expect($contenido)
        ->toContain('<tr class="historia-row">')
        ->toContain('class="textarea-historia"')
        ->toContain('max-height: none')
        ->toContain('campo.style.height = \'auto\'')
        ->toContain('Math.max(55, campo.scrollHeight)')
        ->toContain('window.addEventListener(\'beforeprint\', function ()')
        ->toContain('prepararHistoriaParaImpresion();')
        ->toContain('.historia-row')
        ->toContain('table.form tr.historia-row')
        ->toContain('break-inside: auto');
});

it('resets the history field after clearing and gives printed pages clean margins', function () {
    $usuario = User::create([
        'name' => 'Analista de prueba',
        'username' => 'analista-prueba',
        'password' => 'password',
        'role' => 'analista',
        'status' => true,
    ]);

    $contenido = $this->actingAs($usuario)
        ->get(route('formularios.ficha-derivacion'))
        ->assertOk()
        ->getContent();

    preg_match('/function confirmarBorrarTodo\(\)\s*\{(.*?)\n\}/s', $contenido, $confirmacionBorrado);

    expect($confirmacionBorrado[1] ?? '')
        ->toContain('ajustarAlturaHistoria();')
        ->toContain('guardarBorrador();');

    expect($contenido)
        ->toContain('margin: 10mm 8mm')
        ->toContain('width: auto')
        ->toContain('min-height: 0')
        ->toContain('class="textarea-historia-impresion"')
        ->toContain('table.form tr.historia-row')
        ->toContain('window.prepararHistoriaParaImpresion = prepararHistoriaParaImpresion;');
});

it('requires authentication to view personal form lists', function () {
    $this->get(route('formularios.mis-documentos', ['tipo' => 'ficha-alerta-dece']))
        ->assertRedirect(route('login'));
});

it('opens the original template with saved data for editing each supported form', function (string $nombreFormulario, string $vista) {
    Storage::fake('local');

    $usuario = User::create([
        'name' => 'Analista de prueba',
        'username' => 'analista-prueba',
        'password' => 'password',
        'role' => 'analista',
        'status' => true,
    ]);

    $formulario = Formulario::create([
        'nombre_formulario' => $nombreFormulario,
        'usuario_id' => $usuario->id,
        'datos_path' => 'formularios/1/datos.json',
        'ediciones' => 0,
    ]);

    Storage::disk('local')->put($formulario->datos_path, json_encode([
        'campo_prueba' => 'Dato original',
    ]));

    $this->actingAs($usuario)
        ->get(route('formularios.editar', $formulario))
        ->assertOk()
        ->assertViewIs('formularios.'.$vista)
        ->assertSee('Dato original');
})->with([
    'entrevista estudiantes' => ['ENTREVISTA ESTUDIANTES', 'entrevista-estudiantes'],
    'ficha observacion' => ['FICHA DE OBSERVACIÓN', 'ficha-observacion'],
    'ficha derivacion' => ['FICHA DE DERIVACIÓN', 'ficha-derivacion'],
    'entrevista representantes' => ['ENTREVISTA REPRESENTANTES', 'entrevista-representantes'],
    'entrevista docentes' => ['ENTREVISTA DOCENTES', 'entrevista-docentes'],
    'consentimiento informado' => ['CONSENTIMIENTO INFORMADO', 'consentimiento-informado'],
    'alerta dece' => ['FICHA DE NOTIFICACIÓN DE ALERTA DECE', 'ficha-alerta-dece'],
    'plan de atencion' => ['PLAN DE ATENCIÓN PSICOSOCIAL Y SEGUIMIENTO', 'plan-atencion-psicosocial'],
]);

it('allows one owner edit, updates the original JSON and regenerates its PDF', function () {
    Storage::fake('local');

    $usuario = User::create([
        'name' => 'Analista de prueba',
        'username' => 'analista-prueba',
        'password' => 'password',
        'role' => 'analista',
        'status' => true,
    ]);

    $formulario = Formulario::create([
        'nombre_formulario' => 'ENTREVISTA DOCENTES',
        'usuario_id' => $usuario->id,
        'datos_path' => 'formularios/1/datos.json',
        'pdf_path' => 'formularios/1/documento.pdf',
        'ediciones' => 0,
    ]);

    Storage::disk('local')->put($formulario->datos_path, json_encode([
        ['index' => 0, 'value' => 'Dato original'],
    ]));
    Storage::disk('local')->put($formulario->pdf_path, "%PDF-1.4\nPDF anterior\n");

    Process::fake(function (PendingProcess $process) {
        $comando = $process->command;
        $html = file_get_contents($comando[2]);

        expect($html)
            ->toContain('datos-formulario-pdf')
            ->toContain('Dato actualizado');

        file_put_contents($comando[3], "%PDF-1.4\nPDF actualizado\n");

        return Process::result('PDF actualizado');
    });

    $rutaActualizacion = route('formularios.actualizar', $formulario);
    $respuesta = $this->actingAs($usuario)->putJson($rutaActualizacion, [
        'datos' => [
            ['index' => 0, 'value' => 'Dato actualizado'],
        ],
    ]);

    $respuesta->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('formulario_id', $formulario->id);

    $formulario->refresh();

    expect($formulario->ediciones)->toBe(1)
        ->and($formulario->pdf_path)->toBe('formularios/1/documento.pdf')
        ->and(json_decode(Storage::disk('local')->get($formulario->datos_path), true))
        ->toBe([
            ['index' => 0, 'value' => 'Dato actualizado'],
        ]);

    Storage::disk('local')->assertExists($formulario->pdf_path);
    expect(Storage::disk('local')->get($formulario->pdf_path))
        ->toContain('PDF actualizado');

    $this->actingAs($usuario)->putJson($rutaActualizacion, [
        'datos' => [
            ['index' => 0, 'value' => 'Intento de segunda edición'],
        ],
    ])->assertForbidden();

    expect(json_decode(Storage::disk('local')->get($formulario->datos_path), true))
        ->toBe([
            ['index' => 0, 'value' => 'Dato actualizado'],
        ]);
});

it('edits the JSON and PDF in the selected folder without creating internal copies', function () {
    Storage::fake('local');

    $usuario = User::create([
        'name' => 'Analista de prueba',
        'username' => 'analista-prueba',
        'password' => 'password',
        'role' => 'analista',
        'status' => true,
    ]);

    $formulario = Formulario::create([
        'nombre_formulario' => 'ENTREVISTA DOCENTES',
        'usuario_id' => $usuario->id,
        'ediciones' => 0,
    ]);
    $rutaFormulario = 'Analista de prueba/Informes/ENTREVISTA DOCENTES';
    $nombreArchivo = 'entrevista-docentes-'.$formulario->id;
    $formulario->update([
        'datos_path' => $rutaFormulario.'/'.$nombreArchivo.'.json',
        'pdf_path' => $rutaFormulario.'/'.$nombreArchivo.'.pdf',
    ]);
    $formulario->refresh();

    Storage::disk('local')->put($formulario->datos_path, json_encode([
        ['index' => 0, 'value' => 'Dato original'],
    ]));
    Storage::disk('local')->put($formulario->pdf_path, "%PDF-1.4\nPDF anterior\n");

    Process::fake(function (PendingProcess $process) {
        $comando = $process->command;
        expect(file_get_contents($comando[2]))->toContain('Dato actualizado');
        file_put_contents($comando[3], "%PDF-1.4\nPDF actualizado\n");

        return Process::result('PDF actualizado');
    });

    $this->actingAs($usuario)
        ->putJson(route('formularios.actualizar', $formulario), [
            'datos' => [
                ['index' => 0, 'value' => 'Dato actualizado'],
            ],
        ])
        ->assertOk()
        ->assertJsonPath('success', true);

    $formulario->refresh();
    expect($formulario->ediciones)->toBe(1)
        ->and(json_decode(Storage::disk('local')->get($formulario->datos_path), true))
        ->toBe([
            ['index' => 0, 'value' => 'Dato actualizado'],
        ])
        ->and(Storage::disk('local')->get($formulario->pdf_path))
        ->toContain('PDF actualizado');

    Storage::disk('local')->assertMissing('formularios/'.$formulario->id.'/datos.json');
    Storage::disk('local')->assertMissing('formularios/'.$formulario->id.'/documento.pdf');
});

it('does not allow another user to view or edit a saved form', function () {
    Storage::fake('local');

    $propietario = User::create([
        'name' => 'Propietario',
        'username' => 'propietario',
        'password' => 'password',
        'role' => 'analista',
        'status' => true,
    ]);
    $otroUsuario = User::create([
        'name' => 'Otro usuario',
        'username' => 'otro-usuario',
        'password' => 'password',
        'role' => 'analista',
        'status' => true,
    ]);

    $formulario = Formulario::create([
        'nombre_formulario' => 'FICHA DE NOTIFICACIÓN DE ALERTA DECE',
        'usuario_id' => $propietario->id,
        'datos_path' => 'formularios/1/datos.json',
        'pdf_path' => 'formularios/1/documento.pdf',
        'ediciones' => 0,
    ]);

    Storage::disk('local')->put($formulario->datos_path, json_encode(['dato' => 'original']));
    Storage::disk('local')->put($formulario->pdf_path, "%PDF-1.4\nPDF\n");

    $this->actingAs($otroUsuario)
        ->get(route('formularios.pdf', $formulario))
        ->assertNotFound();

    $this->actingAs($otroUsuario)
        ->get(route('formularios.editar', $formulario))
        ->assertNotFound();

    $this->actingAs($otroUsuario)
        ->putJson(route('formularios.actualizar', $formulario), [
            'datos' => ['dato' => 'alterado'],
        ])
        ->assertNotFound();
});

it('serves the owner PDF inline and returns not found while it is unavailable', function () {
    Storage::fake('local');

    $usuario = User::create([
        'name' => 'Analista de prueba',
        'username' => 'analista-prueba',
        'password' => 'password',
        'role' => 'analista',
        'status' => true,
    ]);

    $formulario = Formulario::create([
        'nombre_formulario' => 'FICHA DE OBSERVACIÓN',
        'usuario_id' => $usuario->id,
        'pdf_path' => 'formularios/1/documento.pdf',
        'ediciones' => 0,
    ]);
    Storage::disk('local')->put($formulario->pdf_path, "%PDF-1.4\nPDF\n");

    $this->actingAs($usuario)
        ->get(route('formularios.pdf', $formulario))
        ->assertOk()
        ->assertHeader('content-type', 'application/pdf')
        ->assertHeader('content-disposition', 'inline; filename="formulario-'.$formulario->id.'.pdf"');

    $formulario->update(['pdf_path' => null]);

    $this->actingAs($usuario)
        ->get(route('formularios.pdf', $formulario))
        ->assertNotFound();
});

it('shows PDF and edit actions only when each record is eligible', function () {
    $usuario = User::create([
        'name' => 'Analista de prueba',
        'username' => 'analista-prueba',
        'password' => 'password',
        'role' => 'analista',
        'status' => true,
    ]);

    $disponible = Formulario::create([
        'nombre_formulario' => 'FICHA DE NOTIFICACIÓN DE ALERTA DECE',
        'usuario_id' => $usuario->id,
        'pdf_path' => 'formularios/1/documento.pdf',
        'ediciones' => 0,
    ]);
    $editado = Formulario::create([
        'nombre_formulario' => 'FICHA DE NOTIFICACIÓN DE ALERTA DECE',
        'usuario_id' => $usuario->id,
        'ediciones' => 1,
    ]);

    $this->actingAs($usuario)
        ->get(route('formularios.mis-documentos', ['tipo' => 'ficha-alerta-dece']))
        ->assertOk()
        ->assertSee(route('formularios.pdf', $disponible))
        ->assertSee(route('formularios.editar', $disponible))
        ->assertSee('<th scope="col">ID</th>', false)
        ->assertSee('<th scope="col">Nombre formulario</th>', false)
        ->assertSee('<th scope="col">Fecha</th>', false)
        ->assertSee('<th scope="col">Hora</th>', false)
        ->assertSee('<th scope="col">Estado</th>', false)
        ->assertSee('<th scope="col">Acciones</th>', false)
        ->assertSee('Guardado')
        ->assertSee('Editado')
        ->assertSee('PDF pendiente')
        ->assertSee('Edición utilizada')
        ->assertSee('#'.$disponible->id)
        ->assertSee('#'.$editado->id);
});

it('removes the associated files and form folder when a coordinator deletes a record', function () {
    Storage::fake('local');

    $usuario = User::create([
        'name' => 'Jessica Carrasco',
        'username' => 'jessica',
        'password' => 'password',
        'role' => 'coordinador',
        'status' => true,
    ]);

    $rutaFormulario = 'Jessica Carrasco/Documentos DECE/FICHA DE NOTIFICACIÓN DE ALERTA DECE';
    $datosPath = $rutaFormulario.'/ficha-de-notificacion-de-alerta-dece-1.json';
    $pdfPath = $rutaFormulario.'/ficha-de-notificacion-de-alerta-dece-1.pdf';

    Storage::disk('local')->makeDirectory($rutaFormulario);
    Storage::disk('local')->put($datosPath, json_encode(['campo' => 'valor'], JSON_PRETTY_PRINT));
    Storage::disk('local')->put($pdfPath, '%PDF-1.4\nPDF de prueba\n');

    $formulario = Formulario::create([
        'nombre_formulario' => 'FICHA DE NOTIFICACIÓN DE ALERTA DECE',
        'usuario_id' => $usuario->id,
        'datos_path' => $datosPath,
        'pdf_path' => $pdfPath,
        'ediciones' => 0,
    ]);

    $this->actingAs($usuario)
        ->delete(route('formularios.eliminar', $formulario))
        ->assertRedirect(route('formularios.registros'))
        ->assertSessionHas('success');

    $this->assertDatabaseMissing('formularios', ['id' => $formulario->id]);
    Storage::disk('local')->assertMissing($datosPath);
    Storage::disk('local')->assertMissing($pdfPath);
    Storage::disk('local')->assertMissing($rutaFormulario);
});

it('removes files and subfolders from old records in the cleanup command', function () {
    Storage::fake('local');

    $usuario = User::create([
        'name' => 'Analista de prueba',
        'username' => 'analista-prueba',
        'password' => 'password',
        'role' => 'analista',
        'status' => true,
    ]);

    $rutaFormulario = 'Analista de prueba/Historial/FICHA DE OBSERVACIÓN';
    $datosPath = $rutaFormulario.'/ficha-observacion-1.json';
    $pdfPath = $rutaFormulario.'/ficha-observacion-1.pdf';

    Storage::disk('local')->makeDirectory($rutaFormulario);
    Storage::disk('local')->put($datosPath, json_encode(['dato' => 'viejo']));
    Storage::disk('local')->put($pdfPath, '%PDF-1.4\nViejo\n');

    $formulario = Formulario::create([
        'nombre_formulario' => 'FICHA DE OBSERVACIÓN',
        'usuario_id' => $usuario->id,
        'datos_path' => $datosPath,
        'pdf_path' => $pdfPath,
        'ediciones' => 0,
    ]);
    $formulario->forceFill(['created_at' => now()->subYears(3)])->saveQuietly();

    $this->artisan('formularios:eliminar-antiguos')
        ->assertSuccessful();

    $this->assertDatabaseMissing('formularios', ['id' => $formulario->id]);
    Storage::disk('local')->assertMissing($datosPath);
    Storage::disk('local')->assertMissing($pdfPath);
    Storage::disk('local')->assertMissing($rutaFormulario);
});

it('places the requested representative interview section at the end of the first page', function () {
    $usuario = User::create([
        'name' => 'Analista de prueba',
        'username' => 'analista-prueba',
        'password' => 'password',
        'role' => 'analista',
        'status' => true,
    ]);

    $contenido = $this->actingAs($usuario)
        ->get(route('formularios.entrevista-representantes'))
        ->assertOk()
        ->getContent();

    $inicioSegundaPagina = strpos($contenido, '<!-- ==================== PÁGINA 2 ==================== -->');

    expect($inicioSegundaPagina)->not->toBeFalse();

    $contenidoPrimeraPagina = substr($contenido, 0, $inicioSegundaPagina);

    expect($contenidoPrimeraPagina)
        ->toContain('¿Qué reglas usan en casa para mantener la disciplina?')
        ->toContain('OTROS ASPECTOS')
        ->toContain('¿Cuáles son los pasatiempos o actividades que más le gusta hacer a su representado/a en el tiempo libre?')
        ->toContain('¿Qué aspectos usted destacaría de su representado/a? (habilidades, valores, saberes, etc.)');
});
