<?php

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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

    $this->usuario = User::create([
        'name' => 'Ana Analista',
        'username' => 'ana',
        'password' => 'password',
        'role' => 'analista',
        'status' => true,
    ]);
});

function paginaDeFicha(string $ruta): string
{
    return test()->actingAs(test()->usuario)->get(route($ruta))->assertOk()->getContent();
}

describe('ficha de derivación', function () {
    it('shows the institution name and address as fixed text instead of fields to fill', function () {
        $html = paginaDeFicha('formularios.ficha-derivacion');

        expect($html)
            ->toContain('Unidad Educativa Ángel Polibio Chaves')
            ->toContain('Avda. El Maestro - Barrio 13 de Abril - 032989035')
            ->not->toContain('name="inst_nombre"')
            ->not->toContain('name="inst_direccion"');
    });

    it('uses a calendar that blocks past dates for the derivation and signature dates', function () {
        $html = paginaDeFicha('formularios.ficha-derivacion');

        foreach (['fecha_derivacion', 'fecha_elaborada', 'fecha_recibida'] as $campo) {
            expect($html)->toMatch('/<input[^>]*type="date"[^>]*name="'.$campo.'"[^>]*data-desde-hoy|<input[^>]*name="'.$campo.'"[^>]*type="date"[^>]*data-desde-hoy/s');
        }

        expect($html)->toContain('data-desde-hoy');
    });

    it('lets the professional and the authority type their names above the signature caption', function () {
        $html = paginaDeFicha('formularios.ficha-derivacion');

        expect($html)
            ->toMatch('/<input[^>]*class="firma-nombre"[^>]*name="nombre_profesional_dece"/s')
            ->toMatch('/<input[^>]*class="firma-nombre"[^>]*name="nombre_autoridad_institucional"/s');
    });

    it('prints the personal data labels in bold', function () {
        $html = paginaDeFicha('formularios.ficha-derivacion');

        foreach (['Edad', 'Fecha de nacimiento', 'Grado/Curso', 'Género', 'Nº documento identidad', 'Discapacidad'] as $etiqueta) {
            expect($html)->toContain('<strong>'.$etiqueta.'</strong>');
        }
    });

    it('does not leave a stray ">" after the health center citation fields', function () {
        $html = paginaDeFicha('formularios.ficha-derivacion');

        expect($html)
            ->toContain('name="ext_salud_pub_txt"')
            ->toContain('name="ext_salud_priv_txt"')
            ->not->toMatch('/placeholder="Citar en este espacio[^"]*">\s*>/');
    });

    it('keeps the parentheses of a checkbox on one line even in a very narrow cell', function () {
        $html = paginaDeFicha('formularios.ficha-derivacion');

        expect($html)->toMatch('/input\[type="checkbox"\]::after\s*\{[^}]*white-space:\s*nowrap/s');
    });

    it('centers the checkbox inside its narrow table cell', function () {
        $html = paginaDeFicha('formularios.ficha-derivacion');

        expect($html)->toMatch('/\.chk-cell\s*\{[^}]*padding-left:\s*0[^}]*padding-right:\s*0/s');
    });
});

describe('ficha de observación', function () {
    it('keeps the parentheses of a checkbox on one line', function () {
        expect(paginaDeFicha('formularios.ficha-observacion'))
            ->toMatch('/input\[type="checkbox"\]::after\s*\{[^}]*white-space:\s*nowrap/s');
    });

    it('starts the "¿Cuál?" boxes disabled, with a hint for when they are enabled', function () {
        $html = paginaDeFicha('formularios.ficha-observacion');

        foreach (['opt_otro1_txt', 'opt_otro2_txt'] as $campo) {
            expect($html)
                ->toMatch('/<textarea[^>]*class="[^"]*campo-otro[^"]*"[^>]*name="'.$campo.'"[^>]*disabled/s')
                ->toMatch('/<textarea[^>]*name="'.$campo.'"[^>]*placeholder="Escriba cuál/s');
        }
    });

    it('enables the "¿Cuál?" box only while "Otro" is checked and highlights it', function () {
        $html = paginaDeFicha('formularios.ficha-observacion');

        expect($html)
            ->toContain('function sincronizarCamposOtro')
            ->toMatch('/textarea\.campo-otro:disabled\s*\{/')
            ->toMatch('/textarea\.campo-otro-activo[^{]*\{[^}]*background:/s');
    });

    it('hides the hint while the "¿Cuál?" box is disabled, even though it forces a black text fill', function () {
        expect(paginaDeFicha('formularios.ficha-observacion'))
            ->toMatch('/textarea\.campo-otro:disabled::placeholder\s*\{[^}]*-webkit-text-fill-color:\s*transparent/s');
    });

    it('does not print the highlight or the hint of the "¿Cuál?" boxes', function () {
        expect(paginaDeFicha('formularios.ficha-observacion'))
            ->toMatch('/textarea\.campo-otro::placeholder\s*\{[^}]*-webkit-text-fill-color:\s*transparent\s*!important/s')
            ->toMatch('/@media print\s*\{[^@]*textarea\.campo-otro[^}]*background:\s*transparent/s')
            ->toMatch('/textarea\.campo-otro::placeholder\s*\{[^}]*color:\s*transparent/s');
    });

    it('prints nothing for a date field that was left empty', function () {
        foreach (['formularios.ficha-derivacion', 'formularios.ficha-observacion'] as $ruta) {
            expect(paginaDeFicha($ruta))
                ->toContain('function marcarFechasVacias')
                ->toMatch('/@media print\s*\{[^@]*input\[type="date"\]\.sin-fecha::-webkit-datetime-edit\s*\{[^}]*visibility:\s*hidden/s');
        }
    });

    it('hides the calendar icon when printing the date fields', function () {
        foreach (['formularios.ficha-derivacion', 'formularios.ficha-observacion'] as $ruta) {
            expect(paginaDeFicha($ruta))->toMatch('/@media print\s*\{[^}]*input\[type="date"\]::-webkit-calendar-picker-indicator\s*\{[^}]*display:\s*none/s');
        }
    });

    it('uses a calendar that blocks past dates for the observation date', function () {
        $html = paginaDeFicha('formularios.ficha-observacion');

        expect($html)->toMatch('/<input[^>]*type="date"[^>]*name="fecha_obs"[^>]*data-desde-hoy|<input[^>]*name="fecha_obs"[^>]*type="date"[^>]*data-desde-hoy/s');
    });
});

describe('entrevista a representantes', function () {
    it('has no parentheses around the checkboxes', function () {
        $html = paginaDeFicha('formularios.entrevista-representantes');

        expect(preg_match_all('/\(\s*<input[^>]*type="checkbox"[^>]*>\s*\)/', $html))->toBe(0)
            ->and(preg_match_all('/<input[^>]*type="checkbox"/', $html))->toBeGreaterThan(80);
    });

    it('draws the checkboxes as small squares that show an X when marked', function () {
        $html = paginaDeFicha('formularios.entrevista-representantes');

        expect($html)
            ->not->toContain('content: "( )"')
            ->not->toContain('content: "(x)"')
            ->toMatch('/input\[type="checkbox"\]:checked::after\s*\{[^}]*content:\s*"X"/s')
            ->toMatch('/input\[type="checkbox"\]\s*\{[^}]*border:\s*1px solid/s');
    });
});

describe('consentimiento informado', function () {
    it('has no parentheses around the authorization options', function () {
        $html = paginaDeFicha('formularios.consentimiento-informado');

        expect(preg_match_all('/\(\s*<input[^>]*type="radio"[^>]*>\s*\)/', $html))->toBe(0)
            ->and($html)->toContain('value="AUTORIZO"')
            ->toContain('value="NO AUTORIZO"');
    });

    it('draws the authorization options as small squares that show an X when marked', function () {
        $html = paginaDeFicha('formularios.consentimiento-informado');

        expect($html)
            ->toMatch('/input\[type="radio"\]:checked::after\s*\{[^}]*content:\s*"X"/s')
            ->toMatch('/input\[type="radio"\]\s*\{[^}]*border:\s*1px solid/s');
    });
});

describe('entrevista a estudiantes', function () {
    it('lets every literal heading flow inline with a hanging indent, like literal A', function () {
        $html = paginaDeFicha('formularios.entrevista-estudiantes');

        expect($html)
            ->not->toMatch('/\.section\s*\{[^}]*display:\s*flex/s')
            ->toMatch('/\.section\s*\{[^}]*padding-left:\s*15px[^}]*text-indent:\s*-15px/s')
            ->toContain('Adaptación en el contexto educativo.-');
    });
});

describe('plan de atención psicosocial', function () {
    it('does not add an empty box above the follow-up title', function () {
        $html = paginaDeFicha('formularios.plan-atencion-psicosocial');

        expect($html)
            ->not->toContain('page2-blank-header')
            ->toContain('SEGUIMIENTO DE LA ATENCIÓN PSICOSOCIAL');
    });
});

describe('encabezado institucional', function () {
    dataset('fichas con encabezado', [
        'derivación' => 'formularios.ficha-derivacion',
        'observación' => 'formularios.ficha-observacion',
        'representantes' => 'formularios.entrevista-representantes',
        'docentes' => 'formularios.entrevista-docentes',
        'consentimiento' => 'formularios.consentimiento-informado',
        'alerta DECE' => 'formularios.ficha-alerta-dece',
        'estudiantes' => 'formularios.entrevista-estudiantes',
        'plan de atención' => 'formularios.plan-atencion-psicosocial',
    ]);

    it('anchors the school shield to the left edge of the centered text block', function (string $ruta) {
        $html = paginaDeFicha($ruta);

        expect($html)
            ->toMatch('/<div class="dece-header-text">\s*<img[^>]*logo-apch\.png/')
            ->toMatch('/\.dece-header-text img\s*\{[^}]*position:\s*absolute[^}]*right:\s*100%/s')
            ->not->toContain('.dece-header-logo');
    })->with('fichas con encabezado');
});
