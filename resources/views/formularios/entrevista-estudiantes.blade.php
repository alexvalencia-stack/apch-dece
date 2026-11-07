
<html>
<head>
<meta charset="UTF-8">
<title>ENTREVISTA PARA ESTUDIANTES</title>

<style>
    @page {
        size: A4;
        margin: 0;
    }

    * {
        box-sizing: border-box;
    }

    :root {
        --zoom-documento: 1;
    }

    body {
        margin: 0;
        padding: 0;
        background: #e5e5e5;
        font-family: "Times New Roman", Times, serif;
        color: #000;
    }

    /* ===== BARRA DE HERRAMIENTAS ===== */

    .toolbar {
        position: sticky;
        top: 0;
        z-index: 1000;

        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        gap: 8px;

        padding: 12px 15px;

        background: #ffffff;
        border-bottom: 1px solid #d0d0d0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);

        font-family: Arial, sans-serif;
    }

    .toolbar button {
        font-family: Arial, sans-serif;
        font-size: 14px;
        font-weight: 500;
        padding: 9px 16px;
        cursor: pointer;

        border: 1px solid #c7c7c7;
        border-radius: 6px;
        background: #f5f5f5;

        transition: background 0.15s ease,
                    border-color 0.15s ease,
                    transform 0.1s ease;
    }

    .toolbar button:hover {
        background: #e9e9e9;
        border-color: #999;
    }

    .toolbar button:active {
        transform: scale(0.97);
    }

    .btn-volver {
        color: #222;
    }

    .btn-borrar {
        color: #a00000;
    }

    .btn-imprimir {
        color: #fff !important;
        background: #b00000 !important;
        border-color: #900000 !important;
        font-weight: bold !important;
    }

    .btn-imprimir:hover {
        background: #900000 !important;
    }

    /* ===== CONTROL DE ZOOM ===== */

    .zoom-control {
        display: flex;
        align-items: center;
        gap: 5px;

        padding: 3px 5px;

        border: 1px solid #d0d0d0;
        border-radius: 7px;
        background: #fafafa;
    }

    .zoom-control .btn-zoom {
        width: 34px;
        height: 32px;

        padding: 0;

        font-size: 20px;
        line-height: 1;
    }

    .zoom-label {
        min-width: 52px;

        text-align: center;

        font-family: Arial, sans-serif;
        font-size: 13px;
        font-weight: bold;
        color: #444;
    }

    .zoom-control .btn-reset {
        padding: 7px 10px;
        font-size: 12px;
    }

    /* ===== ESTADO DE GUARDADO ===== */

    .estado-guardado {
        display: flex;
        align-items: center;
        gap: 6px;

        margin-left: 5px;

        font-family: Arial, sans-serif;
        font-size: 12px;
        color: #555;
    }

    .estado-punto {
        width: 8px;
        height: 8px;

        border-radius: 50%;
        background: #3b8f3b;
    }

    /* ===== CONTENEDOR DEL DOCUMENTO ===== */

    .documento {
        width: 100%;
        overflow-x: auto;
        overflow-y: visible;

        padding: 25px 20px 40px;
    }

    /* ===== HOJA A4 ===== */

    .page {
        width: 210mm;
        height: 297mm;

        padding: 8mm 8mm 7mm 11mm;

        margin: 0 auto 25px auto;

        background: #fff;
        position: relative;
        overflow: hidden;

        font-size: 10px;
        line-height: 12px;

        box-shadow: 0 2px 14px rgba(0, 0, 0, 0.18);

        zoom: var(--zoom-documento, 1);
        transform-origin: top center;
    }

    /* ===== HEADER ===== */

    .header {
        display: flex;
        align-items: center;
        margin-bottom: 3px;
    }

    .header-logo img {
        width: 78px;
        position: relative;
        left: 190px;
    }

    .header img {
        width: 60px;
        height: auto;
        margin-right: 8px;
    }

    .header-text {
        flex: 1;
        text-align: center;
    }

    .header-text .line1,
    .header-text .line2 {
        font-size: 14px;
        font-weight: bold;
        line-height: 1.15;
    }

    .header-text .line3 {
        font-size: 10px;
        line-height: 1.25;
    }

    .header-text .line4 {
        font-size: 10px;
        font-weight: bold;
        margin-top: 2px;
    }

    .header-rule {
        border-bottom: 3px solid #000;
        margin-bottom: 6px;
    }

    /* ===== TITULO ===== */

    .doc-title {
        text-align: center;
        margin: 4px 0 5px 0;
    }

    .doc-title .t1 {
        font-style: italic;
        font-weight: bold;
        font-size: 13px;
    }

    .doc-title .t2 {
        font-weight: bold;
        font-size: 10px;
        margin-top: 2px;
    }

    /* ===== INFORMACION ESTUDIANTE ===== */

    table.infobox {
        width: 100%;
        border-collapse: collapse;
        border: 1.5px solid #000;
        margin: 5px 0 6px 0;
    }

    table.infobox td {
        border-bottom: 1px solid #000;
        padding: 3px 5px;
        font-size: 10px;
    }

    table.infobox tr:last-child td {
        border-bottom: none;
    }

    table.infobox .row-inline {
        display: flex;
        align-items: baseline;
    }

    table.infobox input[type="text"] {
        flex: 1;
        border: none;
        font-family: "Times New Roman", Times, serif;
        font-size: 10px;
        margin-left: 4px;
        background: transparent;
    }

    table.infobox input[type="text"]:focus {
        outline: none;
        background: #fafff0;
    }

    /* ===== OPCIONES DE SELECCION ===== */

    .plainline {
        margin: 4px 0;
        line-height: 12px;
    }

    .option-group {
        display: inline-flex;
        align-items: center;
        gap: 3px;
    }

    input[type="radio"] {
        width: 11px;
        height: 11px;
        margin: 0 3px 0 2px;
        vertical-align: middle;
    }

    /* ===== SECCIONES ===== */

    .section {
        margin: 6px 0 3px 0;
        padding-left: 15px;
        text-indent: -15px;
        line-height: 12px;
    }
    .section .letter {
        display: inline-block;
        font-weight: bold;
        font-style: italic;
        width: 15px;
        text-indent: 0;
    }

    .section .sec-title {
        font-weight: bold;
        font-style: italic;
        margin-right: 4px;
    }

    .section .sec-desc {
        font-size: 9.5px;
    }

    /* ===== PREGUNTAS ===== */

    p.qline {
        margin: 3px 0 0 0;
        display: flex;
        flex-wrap: wrap;
        align-items: baseline;
        line-height: 12px;
    }

    p.qline .qtext {
        margin-right: 4px;
    }

    /* ===== CAMPOS ===== */

    .fillfield {
        flex: 1;
        min-width: 50px;
        border: none;
        border-bottom: none;
        font-family: "Times New Roman", Times, serif;
        font-size: 10px;
        background: transparent;
        padding: 0 2px;
    }

    .fillfield:focus {
        outline: none;
        background: #fafff0;
    }

    .fullline {
        display: block;
        width: 100%;
        border: none;
        border-bottom: none;
        font-family: "Times New Roman", Times, serif;
        font-size: 10px;
        background: transparent;
        margin: 2px 0 2px 0;
        padding: 0 2px;

        height: 15px;
    }

    .fullline:focus {
        outline: none;
        background: #fafff0;
    }

    /* ===== CITA ===== */

    .citation {
        font-size: 8.5px;
        margin-top: 6px;
        margin-bottom: 3px;
        line-height: 10px;
    }

    /* ===== PROFESIONAL Y FECHA ===== */

    .reporta-line {
        display: flex;
        align-items: baseline;
        font-style: italic;
        font-size: 10px;
        margin-top: 4px;
    }

    .reporta-line .lbl {
        white-space: nowrap;
        margin-right: 4px;
    }

    .reporta-line input.fillfield {
        flex: 2;
    }

    .fecha-group {
        white-space: nowrap;
        margin-left: 14px;
        display: flex;
        align-items: baseline;
    }

    .fecha-group input {
        width: 22px;
        border: none;
        border-bottom: none;
        font-family: "Times New Roman", Times, serif;
        font-size: 10px;
        text-align: center;
        background: transparent;
        margin: 0 2px;
    }

    .fecha-group input[type="date"] {
        width: 96px;
    }

    .fecha-group input:focus {
        outline: none;
        background: #fafff0;
    }
    .radio-x {
    display: inline-flex;
    align-items: center;
    vertical-align: middle;
    margin-left: 4px;
    cursor: pointer;
}
.radio-x input {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}
.radio-box {
    width: 14px;
    height: 14px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #000;
    border-radius: 0;
    background: #fff;
    font-size: 13px;
    font-weight: 700;
    line-height: 1;
}
.radio-x input:checked + .radio-box::after {
    content: "x";
    color: #000;
}

    /* ===== IMPRESION ===== */

    @media print {

        body {
            background: #fff;
        }

        .toolbar {
            display: none !important;
        }

        .documento {
            width: auto;
            overflow: visible;
            padding: 0;
        }

        .page {
            margin: 0;
            box-shadow: none;

            width: 210mm;
            height: 297mm;

            overflow: hidden;

            zoom: 1 !important;

            page-break-after: always;
        }

        .page:last-child {
            page-break-after: auto;
        }
    }
    .modal-borrar {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.45);
    align-items: center;
    justify-content: center;
    z-index: 99999;
}

.modal-borrar.mostrar {
    display: flex;
}

.modal-borrar-contenido {
    width: min(420px, calc(100% - 40px));
    background: #ffffff;
    border-radius: 14px;
    padding: 28px;
    text-align: center;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
    animation: aparecerModalBorrar 0.2s ease-out;
}

.modal-borrar-icono {
    width: 48px;
    height: 48px;
    margin: 0 auto 16px;
    border-radius: 50%;
    background: #fef2f2;
    color: #b91c1c;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    font-weight: 700;
}

.modal-borrar-contenido h3 {
    margin: 0 0 10px;
    color: #1f2937;
    font-size: 20px;
}

.modal-borrar-contenido p {
    margin: 0;
    color: #6b7280;
    font-size: 14px;
    line-height: 1.6;
}

.modal-borrar-botones {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin-top: 24px;
}

.modal-btn-cancelar,
.modal-btn-confirmar {
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
}

.modal-btn-cancelar {
    background: #f3f4f6;
    color: #374151;
}

.modal-btn-confirmar {
    background: #b91c1c;
    color: #ffffff;
}

.modal-btn-cancelar:hover {
    background: #e5e7eb;
}

.modal-btn-confirmar:hover {
    background: #991b1b;
}

@keyframes aparecerModalBorrar {

    from {
        opacity: 0;
        transform: scale(0.95);
    }

    to {
        opacity: 1;
        transform: scale(1);
    }

}
@include('formularios.partials.encabezado-institucional-estilos')

.page,
.page * {
    font-family: "Times New Roman", Times, serif !important;
}

@include('formularios.partials.toolbar-moderno')
</style>
</head>

<body>

<!-- =====================================================
     BARRA DE HERRAMIENTAS
     ===================================================== -->

<div class="toolbar">

    @include('formularios.partials.selector-carpeta')

    <button
        type="button"
        class="btn-borrar"
        onclick="borrarTodo()"
    >
        🗑 Borrar todo
    </button>

    <div class="zoom-control">

        <button
            type="button"
            class="btn-zoom"
            onclick="disminuirZoom()"
            title="Reducir tamaño"
        >
            −
        </button>

        <span
            class="zoom-label"
            id="zoomLabel"
        >
            100%
        </span>

        <button
            type="button"
            class="btn-zoom"
            onclick="aumentarZoom()"
            title="Aumentar tamaño"
        >
            +
        </button>

        <button
            type="button"
            class="btn-reset"
            onclick="restablecerZoom()"
            title="Ajustar al tamaño de la pantalla"
        >
            Ajustar
        </button>

    </div>

    <button
        type="button"
        class="btn-imprimir"
        onclick="guardarEImprimir()"
    >
        🖨 Guardar e imprimir
    </button>
    <button
        type="button"
        class="btn-volver btn-ver-formularios"
        onclick="window.location.href='{{ route('formularios.mis-documentos', ['tipo' => 'entrevista-estudiantes']) }}'"
    >
        📂 Mis formularios
    </button>

    <div
        class="estado-guardado"
        id="estadoGuardado"
    >
        <span class="estado-punto"></span>
        <span id="textoEstado">Guardado</span>
    </div>

</div>


<!-- =====================================================
     DOCUMENTO
     ===================================================== -->

<div class="documento">

<div class="page">

    <!-- ===== HEADER ===== -->

    @include('formularios.partials.encabezado-institucional')


    <!-- ===== TITULO ===== -->

    <div class="doc-title">
        <div class="t1">ENTREVISTA PARA ESTUDIANTES</div>
        <div class="t2">AÑO LECTIVO 2026-2027</div>
    </div>


    <!-- ===== INFORMACION ===== -->

    <table class="infobox">

        <tr>
            <td>
                <div class="row-inline">
                    Apellidos y nombres de el/la estudiante:
                    <input type="text" name="apellidos_nombres">
                </div>
            </td>
        </tr>

        <tr>
            <td>
                <div class="row-inline">
                    Año/paralelo:
                    <input type="text" name="anio_paralelo">
                </div>
            </td>
        </tr>

    </table>


    <!-- ===== OPCIONES ===== -->

    <p class="plainline">
    Identificación de la problemática:&nbsp;
    Iniciativa del representante
<label class="radio-x">
    <input
        type="radio"
        name="identificacion_problematica"
        value="iniciativa_representante"
    >
    <span class="radio-box"></span>
</label>

&nbsp;&nbsp;&nbsp;&nbsp;

Alerta de otro miembro de la comunidad educativa
<label class="radio-x">
    <input
        type="radio"
        name="identificacion_problematica"
        value="alerta_comunidad"
    >
    <span class="radio-box"></span>
</label>
</p>


<p class="plainline">
    Consentimiento informado del representante
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Si
<label class="radio-x">
    <input
        type="radio"
        name="consentimiento_representante"
        value="si"
    >
    <span class="radio-box"></span>
</label>

&nbsp;&nbsp;

No
<label class="radio-x">
    <input
        type="radio"
        name="consentimiento_representante"
        value="no"
    >
    <span class="radio-box"></span>
</label>
</p>

    <!-- ==================== A ==================== -->

    <div class="section">

        <span class="letter">A.</span>

        <span class="sec-title">
            Motivo.-
        </span>

        <span class="sec-desc">
            Preguntas relacionadas a identificar la perspectiva del estudiante sobre la alerta o el requerimiento de atención psicosocial.
        </span>

    </div>


    <p class="qline">
        <span class="qtext">
            ¿Conoce el motivo de haberte convocado al Departamento de Consejería Estudiantil? o ¿Cuál es el motivo por el cual acuden al Departamento de Consejería Estudiantil?
        </span>

        <input
            type="text"
            class="fillfield"
            name="q1a"
        >
    </p>

    <input
        type="text"
        class="fullline"
        name="q1b"
    >


    <p class="qline">
        <span class="qtext">
            ¿Cuáles cree que son las causas de esas dificultades?
        </span>

        <input
            type="text"
            class="fillfield"
            name="q2a"
        >
    </p>

    <input
        type="text"
        class="fullline"
        name="q2b"
    >


    <p class="qline">
        <span class="qtext">
            ¿Cómo se siente con lo que está sucediendo?
        </span>

        <input
            type="text"
            class="fillfield"
            name="q3a"
        >
    </p>

    <input
        type="text"
        class="fullline"
        name="q3b"
    >


    <p class="qline">
        <span class="qtext">
            ¿Ha tratado de solucionar el problema? ¿Cómo?
        </span>

        <input
            type="text"
            class="fillfield"
            name="q4a"
        >
    </p>

    <input
        type="text"
        class="fullline"
        name="q4b"
    >


    <!-- ==================== B ==================== -->

    <div class="section">

        <span class="letter">B.</span>

        <span class="sec-title">
            Adaptación en el contexto educativo.-
        </span>

        <span class="sec-desc">
            Preguntas para conocer cómo está adaptado él o la estudiante en su institución educativa y el tipo de relaciones que mantiene con los miembros de la comunidad educativa.
        </span>

    </div>


    <p class="qline">
        <span class="qtext">
            ¿Cómo se siente en la institución educativa?
        </span>

        <input
            type="text"
            class="fillfield"
            name="q5a"
        >
    </p>

    <input
        type="text"
        class="fullline"
        name="q5b"
    >


    <p class="qline">
        <span class="qtext">
            ¿Cómo se siente con sus compañeros/as de aula?
        </span>

        <input
            type="text"
            class="fillfield"
            name="q6a"
        >
    </p>

    <input
        type="text"
        class="fullline"
        name="q6b"
    >


    <p class="qline">
        <span class="qtext">
            ¿Hay alguna/s materia/s que le generen preocupación? .Que le preocupa?
        </span>

        <input
            type="text"
            class="fillfield"
            name="q7a"
        >
    </p>

    <input
        type="text"
        class="fullline"
        name="q7b"
    >


    <p class="qline">
        <span class="qtext">
            ¿De qué manera recibe apoyo de su docente tutor/a? (siente confianza para plantear preguntas; siente apertura para expresar su opinión; sientes que le escucha)
        </span>

        <input
            type="text"
            class="fillfield"
            name="q8a"
        >
    </p>

    <input
        type="text"
        class="fullline"
        name="q8b"
    >


    <p class="qline">
        <span class="qtext">
            ¿De qué manera recibe apoyo de otros/as docentes? (siente confianza para plantear preguntas; siente apertura para expresar su opinión; sientes que le escucha)
        </span>

        <input
            type="text"
            class="fillfield"
            name="q9a"
        >
    </p>

    <input
        type="text"
        class="fullline"
        name="q9b"
    >


    <p class="qline">
        <span class="qtext">
            ¿De qué manera recibe apoyo de las autoridades de su institución?
        </span>

        <input
            type="text"
            class="fillfield"
            name="q10a"
        >
    </p>


    <p class="qline">
        <span class="qtext">
            ¿Qué cosas le gusta hacer en el recreo?
        </span>

        <input
            type="text"
            class="fillfield"
            name="q11a"
        >
    </p>

    <input
        type="text"
        class="fullline"
        name="q11b"
    >


    <p class="qline">
        <span class="qtext">
            ¿Qué opina sobre la amistad? ¿Cuantos amigos/as tiene? ¿Qué hacen cuando están juntos/as? ¿Quiénes son sus amigos/as?
        </span>

        <input
            type="text"
            class="fillfield"
            name="q12a"
        >
    </p>

    <input
        type="text"
        class="fullline"
        name="q12b"
    >


    <p class="qline">
        <span class="qtext">
            ¿Hay alguna situación que suceda al interior y/o exterior de la institución educativa que le preocupa?
        </span>

        <input
            type="text"
            class="fillfield"
            name="q13a"
        >
    </p>

    <input
        type="text"
        class="fullline"
        name="q13b"
    >


    <!-- ==================== C ==================== -->

    <div class="section">

        <span class="letter">C.</span>

        <span class="sec-title">
            Relaciones familiares.-
        </span>

        <span class="sec-desc">
            Permite conocer cómo está organizada la familia y el tipo de relaciones que se han construido entre los miembros que la conforman.
        </span>

    </div>


    <p class="qline">
        <span class="qtext">
            ¿Cómo se siente en su hogar?
        </span>

        <input
            type="text"
            class="fillfield"
            name="q14a"
        >
    </p>

    <input
        type="text"
        class="fullline"
        name="q14b"
    >


    <p class="qline">
        <span class="qtext">
            ¿Quiénes conforman su hogar?
        </span>

        <input
            type="text"
            class="fillfield"
            name="q15a"
        >
    </p>


    <p class="qline">
        <span class="qtext">
            ¿Qué hace en su tiempo libre en la casa?
        </span>

        <input
            type="text"
            class="fillfield"
            name="q16a"
        >
    </p>


    <p class="qline">
        <span class="qtext">
            ¿Cuánto tiempo comparten en familia? (entre semana, fines de semana, feriados, vacaciones)
        </span>

        <input
            type="text"
            class="fillfield"
            name="q17a"
        >
    </p>


    <p class="qline">
        <span class="qtext">
            ¿Cómo se relaciona con los integrantes de su familia?
        </span>

        <input
            type="text"
            class="fillfield"
            name="q18a"
        >
    </p>


    <p class="qline">
        <span class="qtext">
            ¿Qué reglas usan en su hogar para mantener un orden?
        </span>

        <input
            type="text"
            class="fillfield"
            name="q19a"
        >
    </p>


    <!-- ==================== D ==================== -->

    <div class="section">

        <span class="letter">D.</span>

        <span class="sec-title">
            Otros aspectos.-
        </span>

    </div>


    <p class="qline">
        <span class="qtext">
            ¿Asiste a un curso o actividad antes/ después de clases o los fines de semana?
        </span>

        <input
            type="text"
            class="fillfield"
            name="q20a"
        >
    </p>

    <input
        type="text"
        class="fullline"
        name="q20b"
    >


    <p class="qline">
        <span class="qtext">
            ¿Qué logros ha alcanzado en su vida? o ¿Qué es lo que más disfruta hacer?
        </span>

        <input
            type="text"
            class="fillfield"
            name="q21a"
        >
    </p>

    <input
        type="text"
        class="fullline"
        name="q21b"
    >


    <p class="qline">
        <span class="qtext">
            ¿Cuál es el mayor reto que tiene en este momento?
        </span>

        <input
            type="text"
            class="fillfield"
            name="q22a"
        >
    </p>

    <input
        type="text"
        class="fullline"
        name="q22b"
    >


    <!-- ==================== E ==================== -->

    <div class="section">

        <span class="letter">E.</span>

        <span class="sec-title">
            Comentarios adicionales u observaciones
        </span>

    </div>

    <input
        type="text"
        class="fullline"
        name="comentarios1"
    >

    <input
        type="text"
        class="fullline"
        name="comentarios2"
    >


    <!-- ===== CITA ===== -->

    <p class="citation">
        Ministerio de Educación (2023).
        <em>Modelo de Gestión del Departamento de Consejería Estudiantil.</em>
        &nbsp; Quito: Ecuador.
    </p>


    <!-- ===== PROFESIONAL ===== -->

    <p class="reporta-line">

        <span class="lbl">
            Profesional que reporta:
        </span>

        <input
            type="text"
            class="fillfield"
            name="profesional_reporta"
        >

        <span class="fecha-group">

            Fecha:

            <input type="date" name="fecha" data-desde-hoy>

        </span>

    </p>

</div>

</div>


<script>

    /* =====================================================
       CLAVE DEL BORRADOR
       ===================================================== */

    const CLAVE_BORRADOR =
        'apch_entrevista_estudiante_borrador';


    /* =====================================================
       OBTENER TODOS LOS CAMPOS
       ===================================================== */

    function obtenerCampos() {

        return document.querySelectorAll(
            '.page input'
        );

    }


    /* =====================================================
       ACTUALIZAR ESTADO DE GUARDADO
       ===================================================== */

    function actualizarEstadoGuardado(texto) {

        const textoEstado =
            document.getElementById('textoEstado');

        if (textoEstado) {

            textoEstado.textContent = texto;

        }

    }


    /* =====================================================
       GUARDAR BORRADOR AUTOMATICAMENTE
       ===================================================== */

    function guardarBorrador() {

        const campos =
            obtenerCampos();

        const datos = [];

        campos.forEach((campo, index) => {

            datos.push({

                index: index,

                type: campo.type,

                value:
                    campo.type === 'radio'
                        ? campo.checked
                        : campo.value

            });

        });


        localStorage.setItem(

            CLAVE_BORRADOR,

            JSON.stringify(datos)

        );


        actualizarEstadoGuardado(
            'Guardado'
        );

    }


    /* =====================================================
       CARGAR BORRADOR
       ===================================================== */

    function cargarBorrador() {

        if (window.formularioEnEdicion) {
            return;
        }

        const borrador =
            localStorage.getItem(
                CLAVE_BORRADOR
            );


        if (!borrador) {

            return;

        }


        try {

            const datos =
                JSON.parse(borrador);


            const campos =
                obtenerCampos();


            datos.forEach(dato => {

                if (!campos[dato.index]) {

                    return;

                }


                if (
                    campos[dato.index].type ===
                    'radio'
                ) {

                    campos[dato.index].checked =
                        dato.value;

                } else {

                    campos[dato.index].value =
                        dato.value;

                }

            });

        } catch (error) {

            console.error(
                'No se pudo cargar el borrador:',
                error
            );

        }

    }


    /* =====================================================
       BORRAR TODO
       ===================================================== */
    function borrarTodo() {

    const modal = document.getElementById('modalBorrarTodo');

    if (modal) {
        modal.classList.add('mostrar');
    }
}

function cerrarModalBorrarTodo() {

    const modal = document.getElementById('modalBorrarTodo');

    if (modal) {
        modal.classList.remove('mostrar');
    }
}

function confirmarBorrarTodo() {

    const campos = obtenerCampos();

    campos.forEach((campo) => {

        if (campo.type === 'radio' || campo.type === 'checkbox') {

            campo.checked = false;

        } else {

            campo.value = '';

        }

    });

    cerrarModalBorrarTodo();
}






    /* =====================================================
       VOLVER
       ===================================================== */

    function volver() {

        window.history.back();

    }


    /* =====================================================
       ZOOM
       ===================================================== */

    const ZOOM_MINIMO = 0.80;
    const ZOOM_MAXIMO = 1.70;
    const ZOOM_PASO = 0.10;

    let zoomActual = 1;


    function aplicarZoom() {

        document.documentElement.style.setProperty(
            '--zoom-documento',
            zoomActual
        );


        const zoomLabel =
            document.getElementById('zoomLabel');


        if (zoomLabel) {

            zoomLabel.textContent =
                Math.round(zoomActual * 100) + '%';

        }

    }


    function calcularZoomAutomatico() {

        const anchoDisponible =
            window.innerWidth - 80;


        const anchoA4 = 793.7;


        let zoomCalculado =
            (anchoDisponible * 0.92) /
            anchoA4;


        zoomCalculado =
            Math.max(
                ZOOM_MINIMO,
                Math.min(
                    ZOOM_MAXIMO,
                    zoomCalculado
                )
            );


        zoomCalculado =
            Math.round(
                zoomCalculado * 10
            ) / 10;


        zoomActual =
            zoomCalculado;


        aplicarZoom();

    }


    function aumentarZoom() {

        zoomActual += ZOOM_PASO;


        if (
            zoomActual >
            ZOOM_MAXIMO
        ) {

            zoomActual =
                ZOOM_MAXIMO;

        }


        zoomActual =
            Math.round(
                zoomActual * 10
            ) / 10;


        aplicarZoom();

    }


    function disminuirZoom() {

        zoomActual -= ZOOM_PASO;


        if (
            zoomActual <
            ZOOM_MINIMO
        ) {

            zoomActual =
                ZOOM_MINIMO;

        }


        zoomActual =
            Math.round(
                zoomActual * 10
            ) / 10;


        aplicarZoom();

    }


    function restablecerZoom() {

        calcularZoomAutomatico();

    }


    /* =====================================================
       GUARDAR E IMPRIMIR
       ===================================================== */

    function guardarEImprimir() {

    guardarBorrador();

    const campos = obtenerCampos();

    const datos = [];

    campos.forEach((campo, index) => {

        datos.push({

            index: index,

            type: campo.type,

            value:
                campo.type === 'radio'
                    ? campo.checked
                    : campo.value

        });

    });

    const solicitud = fetch(
        window.formularioEnEdicion
            ? '{{ url('/formularios') }}/' + window.formularioEnEdicion.id + '/editar'
            : '{{ route('formularios.guardar-documento') }}',
        {
            method: window.formularioEnEdicion ? 'PUT' : 'POST',

            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },

            body: JSON.stringify({

                nombre_formulario:
                    'ENTREVISTA ESTUDIANTES',

                carpeta: document.getElementById('carpetaDestino')?.value || null,
                datos: datos

            })
        }
    );
    window.print();

    solicitud
    .then(async respuesta => {

        const resultado =
            await respuesta.json();

        if (!respuesta.ok || !resultado.success) {

            console.error(
                'Error al guardar:',
                resultado
            );

            if (resultado.datos_guardados) {
                alert(resultado.message);

                return;
            }

            alert(
                'No se pudo guardar el formulario en el servidor.'
            );

            return;
        }

        console.log(
            'Formulario guardado correctamente:',
            resultado.formulario_id
        );

    })
    .catch(error => {

        console.error(
            'Error de conexión:',
            error
        );

        alert(
            'No se pudo guardar el formulario en el servidor.'
        );

    });

}


    /* =====================================================
       INICIAR
       ===================================================== */

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            cargarBorrador();

            calcularZoomAutomatico();


            const campos =
                obtenerCampos();


            campos.forEach(campo => {

                campo.addEventListener(
                    'input',
                    guardarBorrador
                );


                campo.addEventListener(
                    'change',
                    guardarBorrador
                );

            });


            window.addEventListener(
                'resize',
                function () {

                    calcularZoomAutomatico();

                }
            );

        }
    );

</script>
<div id="modalBorrarTodo" class="modal-borrar">

    <div class="modal-borrar-contenido">

        <div class="modal-borrar-icono">
            !
        </div>

        <h3>¿Borrar información?</h3>

        <p>
            ¿Está seguro de que desea borrar toda la información
            ingresada en el formulario?
        </p>

        <div class="modal-borrar-botones">

            <button
                type="button"
                class="modal-btn-cancelar"
                onclick="cerrarModalBorrarTodo()"
            >
                Cancelar
            </button>

            <button
                type="button"
                class="modal-btn-confirmar"
                onclick="confirmarBorrarTodo()"
            >
                Borrar todo
            </button>

        </div>

    </div>

</div>
@include('formularios.partials.modo-edicion')
@include('formularios.partials.fechas-desde-hoy')
</body>
</html>
