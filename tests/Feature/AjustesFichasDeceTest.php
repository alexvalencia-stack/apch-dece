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

    it('only lets the user write next to an option once its checkbox is marked', function () {
        $html = paginaDeFicha('formularios.ficha-derivacion');

        $campos = [
            'interna_men_otro_txt' => 'chk_men_otro',
            'interna_inst_otro_txt' => 'chk_inst_otro',
            'ext_policia_txt' => 'chk_policia',
            'ext_salud_pub_txt' => 'chk_salud_pub',
            'ext_salud_priv_txt' => 'chk_salud_priv',
            'ext_mies_txt' => 'chk_mies',
            'ext_mujer_txt' => 'chk_mujer',
            'ext_otro_txt2' => 'chk_ext_otro',
        ];

        foreach ($campos as $campo => $casilla) {
            expect($html)
                ->toMatch('/<input[^>]*name="'.$campo.'"[^>]*data-casilla="'.$casilla.'"[^>]*disabled|<input[^>]*data-casilla="'.$casilla.'"[^>]*name="'.$campo.'"[^>]*disabled/s')
                ->toContain('name="'.$casilla.'"');
        }
    });

    it('has a single box for the external "Otro (indique)" option, the one on the right', function () {
        $html = paginaDeFicha('formularios.ficha-derivacion');

        expect($html)
            ->not->toContain('name="ext_otro_txt"')
            ->toMatch('/<input[^>]*name="ext_otro_txt2"[^>]*data-casilla="chk_ext_otro"/s')
            ->and(substr_count($html, 'data-casilla="chk_ext_otro"'))->toBe(1);
    });

    it('highlights the fields while their checkbox is marked and drops the highlight when printing', function () {
        $html = paginaDeFicha('formularios.ficha-derivacion');

        expect($html)
            ->toContain('function sincronizarCamposConCasilla')
            ->toMatch('/\[data-casilla\]:disabled\s*\{/')
            ->toMatch('/\[data-casilla\]\.campo-activo[^{]*\{[^}]*background:/s')
            ->toMatch('/@media print\s*\{[^@]*\[data-casilla\][^}]*background:\s*transparent/s');
    });

    it('separates the text typed after "Otro (indique)" from its label', function () {
        expect(paginaDeFicha('formularios.ficha-derivacion'))
            ->toMatch('/\.row-inline\s*>\s*input\[data-casilla\]\s*\{[^}]*margin-left:\s*4px/s');
    });

    it('keeps printing the citation hint of the health center fields in the PDF', function () {
        $script = file_get_contents(base_path('scripts/generar-pdf.cjs'));

        expect($script)
            ->toContain('.campo-otro[placeholder]')
            ->not->toContain("querySelectorAll('[placeholder]')");
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

    it('shows the department line, with its accent, on every form', function (string $ruta) {
        expect(paginaDeFicha($ruta))
            ->toContain('DEPARTAMENTO DE CONSEJERÍA ESTUDIANTIL')
            ->not->toContain('DEPARTAMENTO DE CONSEJERIA ESTUDIANTIL');
    })->with('fichas con encabezado');

    it('keeps the school shield close to the institution name', function (string $ruta) {
        preg_match('/\.dece-header-text img\s*\{[^}]*margin-right:\s*(\d+)px/s', paginaDeFicha($ruta), $coincidencia);

        expect($coincidencia)->not->toBeEmpty()
            ->and((int) $coincidencia[1])->toBeLessThanOrEqual(16)
            ->and((int) $coincidencia[1])->toBeGreaterThanOrEqual(8);
    })->with('fichas con encabezado');

    it('uses the typography of the original DECE header', function (string $ruta) {
        $html = paginaDeFicha($ruta);

        expect($html)
            ->toMatch('/\.dece-header-line1\s*\{[^}]*font-size:\s*18\.67px[^}]*font-weight:\s*normal/s')
            ->toMatch('/\.dece-header-line2\s*\{[^}]*font-size:\s*21\.33px[^}]*font-weight:\s*normal/s')
            ->toMatch('/\.dece-header-line3\s*\{[^}]*font-size:\s*14\.67px/s')
            ->toMatch('/\.dece-header-line4\s*\{[^}]*font-size:\s*10\.67px[^}]*font-weight:\s*bold/s');
    })->with('fichas con encabezado');

    it('draws the small shield and the shorter thick rule of the original header', function (string $ruta) {
        $html = paginaDeFicha($ruta);

        expect($html)
            ->toMatch('/\.dece-header-text img\s*\{[^}]*width:\s*55px/s')
            ->toMatch('/\.dece-header::after\s*\{[^}]*width:\s*148mm[^}]*border-bottom:\s*5px solid #000/s');
    })->with('fichas con encabezado');

    it('ships the sharp school shield taken from the original DECE documents', function () {
        [$ancho, $alto] = getimagesize(public_path('images/escudo-dece.png'));

        expect($ancho)->toBeGreaterThanOrEqual(200)
            ->and($alto)->toBeGreaterThanOrEqual(220);
    });

    it('anchors the school shield to the left edge of the centered text block', function (string $ruta) {
        $html = paginaDeFicha($ruta);

        expect($html)
            ->toMatch('/<div class="dece-header-text">\s*<img[^>]*escudo-dece\.png/')
            ->toMatch('/\.dece-header-text img\s*\{[^}]*position:\s*absolute[^}]*right:\s*100%/s')
            ->not->toContain('.dece-header-logo');
    })->with('fichas con encabezado');
});

describe('fechas de todas las fichas', function () {
    dataset('todas las fichas', [
        'derivación' => 'formularios.ficha-derivacion',
        'observación' => 'formularios.ficha-observacion',
        'representantes' => 'formularios.entrevista-representantes',
        'docentes' => 'formularios.entrevista-docentes',
        'consentimiento' => 'formularios.consentimiento-informado',
        'alerta DECE' => 'formularios.ficha-alerta-dece',
        'estudiantes' => 'formularios.entrevista-estudiantes',
        'plan de atención' => 'formularios.plan-atencion-psicosocial',
    ]);

    it('blocks past dates in every calendar field', function (string $ruta) {
        $html = paginaDeFicha($ruta);

        preg_match_all('/<input\b[^>]*type="date"[^>]*>/s', $html, $calendarios);

        foreach ($calendarios[0] as $calendario) {
            expect($calendario)->toContain('data-desde-hoy');
        }

        expect($html)->toContain('function marcarFechasVacias');
    })->with('todas las fichas');

    it('hides the calendar icon and the empty-date text when printing', function (string $ruta) {
        expect(paginaDeFicha($ruta))
            ->toMatch('/@media print\s*\{[^@]*input\[type="date"\]::-webkit-calendar-picker-indicator\s*\{[^}]*display:\s*none/s')
            ->toMatch('/input\[type="date"\]\.sin-fecha::-webkit-datetime-edit\s*\{[^}]*visibility:\s*hidden/s');
    })->with('todas las fichas');

    it('replaces the three loose day / month / year boxes of the footer with one calendar', function (string $ruta) {
        $html = paginaDeFicha($ruta);

        expect($html)
            ->not->toMatch('/<input[^>]*maxlength="4"/s')
            ->and(preg_match_all('/<input\b[^>]*type="date"[^>]*data-desde-hoy[^>]*>/s', $html))->toBe(1);
    })->with([
        'docentes' => 'formularios.entrevista-docentes',
        'representantes' => 'formularios.entrevista-representantes',
        'estudiantes' => 'formularios.entrevista-estudiantes',
    ]);

    it('names the footer date of the student interview so it is saved with the form', function () {
        expect(paginaDeFicha('formularios.entrevista-estudiantes'))
            ->toMatch('/<input\b[^>]*name="fecha"[^>]*type="date"|<input\b[^>]*type="date"[^>]*name="fecha"/s')
            ->not->toContain('name="fecha_dia"');
    });

    it('does not restrict the birth date, which is in the past by nature', function () {
        expect(paginaDeFicha('formularios.ficha-derivacion'))
            ->toMatch('/<input\b[^>]*name="est_fecha_nac"[^>]*>/s')
            ->not->toMatch('/<input\b[^>]*name="est_fecha_nac"[^>]*data-desde-hoy/s');
    });
});

describe('ortografía respecto a los originales del DECE', function () {
    it('spells "biberón" correctly in the representatives interview', function () {
        expect(paginaDeFicha('formularios.entrevista-representantes'))
            ->toContain('biberón')
            ->not->toContain('bibarón');
    });
});
