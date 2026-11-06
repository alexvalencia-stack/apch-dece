

<html>

<head>

<meta charset="UTF-8">

<title>FICHA DE OBSERVACIÓN</title>



<style>

    :root {

        --zoom-documento: 1;

    }



    @page {

        size: A4;

        margin: 0;

    }



    * {

        box-sizing: border-box;

    }



    body {

        margin: 0;

        padding: 0;

        background: #e5e5e5;

        font-family: "Times New Roman", Times, serif;

        color: #000;

    }



    /* ===== Barra de herramientas ===== */



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

        padding: 8px 15px;

        cursor: pointer;

        border: 1px solid #b8b8b8;

        border-radius: 6px;

        background: #f5f5f5;

        color: #222;

        transition: background 0.15s ease, border-color 0.15s ease;

    }



    .toolbar button:hover {

        background: #e9e9e9;

        border-color: #999;

    }



    .btn-volver {

        color: #222;

    }



    .btn-borrar {

        color: #a00000 !important;

        border-color: #d0a0a0 !important;

        background: #fff7f7 !important;

    }



    .btn-borrar:hover {

        background: #ffecec !important;

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



    /* ===== Control de zoom ===== */



    .zoom-control {

        display: flex;

        align-items: center;

        gap: 4px;

        margin-left: 5px;

        padding: 3px;

        border: 1px solid #d0d0d0;

        border-radius: 7px;

        background: #f7f7f7;

    }



    .zoom-control .btn-zoom {

        width: 34px;

        height: 32px;

        padding: 0;

        font-size: 20px;

        line-height: 1;

        border: 1px solid #c5c5c5;

        background: #fff;

    }



    .zoom-label {

        min-width: 52px;

        text-align: center;

        font-size: 13px;

        font-weight: bold;

        color: #333;

    }



    .btn-reset {

        height: 32px !important;

        padding: 0 10px !important;

        font-size: 13px !important;

    }



    /* ===== Estado de guardado ===== */



    .estado-guardado {

        display: flex;

        align-items: center;

        gap: 7px;

        margin-left: 4px;

        padding: 7px 10px;

        font-family: Arial, sans-serif;

        font-size: 13px;

        color: #555;

        white-space: nowrap;

    }



    .estado-punto {

        width: 8px;

        height: 8px;

        border-radius: 50%;

        background: #3b8f3b;

        display: inline-block;

    }



    /* ===== Contenedor del documento ===== */



    .documento {

        width: 100%;

        overflow-x: auto;

        overflow-y: visible;

        padding: 25px 20px 40px;

    }



    .page {

        width: 200mm;

        min-height: 297mm;

        padding: 7mm 8mm 5mm 8mm;

        margin: 0 auto 25px auto;

        background: #fff;

        position: relative;

        overflow: hidden;

        font-size: 11.6px;

        line-height: 13px;

        box-shadow: 0 2px 14px rgba(0, 0, 0, 0.18);

        zoom: var(--zoom-documento, 1);

        transform-origin: top center;

    }



    /* ===== Header ===== */



    .header {

        display: flex;

        align-items: center;

        margin-bottom: 6px;

    }



    .header img {

        width: 78px;

        height: auto;

        margin-right: 10px;

    }



    .header-logo img {

        width: 78px;

        position: relative;

        left: 170px;

    }



    .header-text {

        flex: 1;

        text-align: center;

    }



    .header-text .line1,

    .header-text .line2 {

        font-size: 18px;

        font-weight: bold;

        line-height: 1.05;

    }



    .header-text .line3 {

        font-size: 12.5px;

        line-height: 1.2;

    }

     .header-text .line4 {

        font-size: 12.5px;

        line-height: 1.2;

    }



    .header-rule {

        border-bottom: 3px solid #000;

        margin-bottom: 6px;

    }



    /* ===== Main table ===== */



    table.form {

        width: 100%;

        border-collapse: collapse;

        border: 1px solid #000;

        table-layout: fixed;

    }



    table.form td {

        border: 1px solid #000;

        padding: 2.1px 5px;

        vertical-align: top;

        font-size: 11.6px;

        line-height: 14px;

    }



    .peach {

        background: #FBE4D5;

    }



    .title-row td {

        text-align: center;

        font-size: 16px;

        font-weight: bold;

        padding: 3px 4px;

    }



    .section-row td {

        text-align: center;

        font-weight: bold;

        font-size: 12.5px;

        padding: 3px 4px;

    }



    .lbl {

        font-weight: bold;

    }



    .row-inline {

        display: flex;

        align-items: baseline;

    }



    .row-inline .lbl {

        white-space: nowrap;

        margin-right: 4px;

    }



    .center-lbl {

        text-align: center;

        font-weight: normal;

    }



    input[type="text"],

    input[type="date"] {

        flex: 1;

        width: 100%;

        border: none;

        font-family: "Times New Roman", Times, serif;

        font-size: 11.6px;

        background: transparent;

        padding: 0;

        margin: 0;

    }



    input[type="text"]:focus,

    input[type="date"]:focus {

        outline: none;

        background: #fafff0;

    }



    input[type="checkbox"] {

        appearance: none;

        -webkit-appearance: none;

        width: 28px;

        height: 16px;

        position: relative;

        vertical-align: middle;

        margin: 0;

        padding: 0;

        border: none;

        background: transparent;

        cursor: pointer;

    }



    input[type="checkbox"]::after {

        content: "( )";

        position: absolute;

        inset: 0;

        display: flex;

        align-items: center;

        justify-content: center;

        font-family: "Times New Roman", Times, serif;

        font-size: 14px;

        font-weight: normal;

        line-height: 16px;

        color: #000;

    }



    input[type="checkbox"]:checked::after {

        content: "(x)";

        font-weight: bold;

    }



    .qcell {

        background: #FBE4D5;

    }



    .chk-cell {

        text-align: center;

        vertical-align: middle;

    }



    .table-head td {

        font-weight: bold;

        text-align: center;

        background: #FBE4D5;

        padding: 1.5px 4px;

    }



    .opt-line {

        white-space: nowrap;

        line-height: 12px;

    }



    textarea.campo-multilinea {

        display: block;

        width: 100%;

        border: none;

        resize: none;

        overflow: hidden;

        field-sizing: content;

        font-family: "Times New Roman", Times, serif;

        font-size: 11px;

        line-height: 12px;

        background: transparent;

        padding: 0;

        margin: 0;

        white-space: pre-wrap;

        overflow-wrap: anywhere;

    }



    textarea.campo-multilinea:focus {

        outline: none;

        background: #fafff0;

    }



    .instr-italic {

        font-style: italic;

        font-size: 10.6px;

    }



    .confidential {

        font-style: italic;

        font-size: 10.6px;

        padding-top: 2px !important;

        padding-bottom: 2px !important;

    }



    /* ===== Citation / footer ===== */



    .citation {

        font-size: 10.2px;

        margin-top: 3px;

        margin-bottom: 0;

    }



    .signature-block {

        text-align: center;

        margin-top: 45px;

    }



    .signature-line {

        border-bottom: 1px solid #000;

        width: 220px;

        margin: 0 auto;

        height: 8px;

    }



    .signature-label {

        font-weight: bold;

        font-size: 11.6px;

        margin-top: 2px;

    }



    /* ===== Print rules ===== */



    @media print {
        table.form tr {
            break-inside: avoid;
        }



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

            width: 200mm;

            min-height: 297mm;

            margin: 0 auto;

            padding: 7mm 8mm 5mm 8mm;

            box-shadow: none;

            overflow: hidden;

            zoom: 1 !important;

            page-break-after: always;

            box-decoration-break: clone;

            -webkit-box-decoration-break: clone;

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



<div class="toolbar">

    @include('formularios.partials.selector-carpeta')

    <button

        type="button"

        class="btn-borrar"

        onclick="borrarTodo()">

        🗑 Borrar todo

    </button>



    <div class="zoom-control">



        <button

            type="button"

            class="btn-zoom"

            onclick="disminuirZoom()"

            title="Reducir tamaño">

            −

        </button>



        <span

            class="zoom-label"

            id="zoomLabel">

            100%

        </span>



        <button

            type="button"

            class="btn-zoom"

            onclick="aumentarZoom()"

            title="Aumentar tamaño">

            +

        </button>



        <button

            type="button"

            class="btn-reset"

            onclick="restablecerZoom()"

            title="Ajustar al tamaño de la pantalla">

            Ajustar

        </button>



    </div>



    <button

        type="button"

        class="btn-imprimir"

        onclick="guardarEImprimir()">

        🖨 Guardar e imprimir

    </button>

    <button
        type="button"
        class="btn-volver btn-ver-formularios"
        onclick="window.location.href='{{ route('formularios.mis-documentos', ['tipo' => 'ficha-observacion']) }}'"
    >
        📂 Mis formularios
    </button>



    <div

        class="estado-guardado"

        id="estadoGuardado">



        <span class="estado-punto"></span>



        <span id="textoEstado">

            Guardado

        </span>



    </div>



</div>





<div class="documento">



<div class="page">



    @include('formularios.partials.encabezado-institucional')





    <table class="form">



        <colgroup>

            <col style="width:25.005%">

            <col style="width:9.225%">

            <col style="width:2.769%">

            <col style="width:20.729%">

            <col style="width:8.298%">

            <col style="width:8.288%">

            <col style="width:17.970%">

            <col style="width:7.724%">

        </colgroup>



        <tbody>



        <tr class="title-row peach">

            <td colspan="8">FICHA DE OBSERVACIÓN</td>

        </tr>



        <tr class="section-row peach">

            <td colspan="8">DATOS INFORMATIVOS GENERALES</td>

        </tr>



        <tr>

            <td

                class="peach lbl"

                style="font-size:10.6px; padding-left:3px; padding-right:2px;">

                Nombre de el/la estudiante

            </td>



            <td colspan="7">

                <input

                    type="text"

                    name="est_nombre">

            </td>

        </tr>



        <tr>

            <td

                class="peach lbl"

                style="font-size:10.6px; padding-left:3px; padding-right:2px;">

                Duración de la observación

            </td>



            <td colspan="2">

                <input

                    type="text"

                    name="duracion_obs">

            </td>



            <td class="lbl">

                Fecha:

            </td>



            <td colspan="4">

                <input

                    type="date"

                    name="fecha_obs"

                    data-desde-hoy>

            </td>

        </tr>



        <tr>

            <td

                class="peach lbl"

                style="font-size:10.6px; padding-left:3px; padding-right:2px;">

                Observación áulica

            </td>



            <td colspan="2">

                <input

                    type="text"

                    name="obs_aulica">

            </td>



            <td

                colspan="3"

                class="lbl">

                Observación en otros espacios externos al aula

            </td>



            <td colspan="2">

                <input

                    type="text"

                    name="obs_externa">

            </td>

        </tr>



        <tr class="section-row peach">

            <td colspan="8">

                Preguntas para responder durante la observación

            </td>

        </tr>



        <tr class="table-head">

            <td colspan="4">Preguntas</td>

            <td>Si</td>

            <td>No</td>

            <td colspan="2">Comentario</td>

        </tr>



        <tr>

            <td colspan="4" class="qcell">

                ¿Se evidencian conductas de agresividad?

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q1_si">

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q1_no">

            </td>

            <td colspan="2">

                <textarea class="campo-multilinea" name="q1_com" rows="1"></textarea>

            </td>

        </tr>



        <tr>

            <td colspan="4" class="qcell">

                ¿Se evidencia llanto frágil o tendencia a llorar?

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q2_si">

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q2_no">

            </td>

            <td colspan="2">

                <textarea class="campo-multilinea" name="q2_com" rows="1"></textarea>

            </td>

        </tr>



        <tr>

            <td colspan="4" class="qcell">

                ¿Se evidencia falta de adecuación al grupo?

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q3_si">

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q3_no">

            </td>

            <td colspan="2">

                <textarea class="campo-multilinea" name="q3_com" rows="1"></textarea>

            </td>

        </tr>



        <tr>

            <td colspan="4" class="qcell">

                ¿Se evidencia desmotivación y o decaimiento?

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q4_si">

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q4_no">

            </td>

            <td colspan="2">

                <textarea class="campo-multilinea" name="q4_com" rows="1"></textarea>

            </td>

        </tr>



        <tr>

            <td colspan="4" class="qcell">

                ¿Se evidencian frecuentes cambios de actitud?

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q5_si">

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q5_no">

            </td>

            <td colspan="2">

                <textarea class="campo-multilinea" name="q5_com" rows="1"></textarea>

            </td>

        </tr>



        <tr>

            <td colspan="4" class="qcell">

                ¿Se evidencian dificultades de relacionamiento con sus compañeros/as de aula?

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q6_si">

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q6_no">

            </td>

            <td colspan="2">

                <textarea class="campo-multilinea" name="q6_com" rows="1"></textarea>

            </td>

        </tr>



        <tr>

            <td colspan="4" class="qcell">

                ¿Se identifican problemas para concentrarse probablemente por problemas emocionales?

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q7_si">

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q7_no">

            </td>

            <td colspan="2">

                <textarea class="campo-multilinea" name="q7_com" rows="1"></textarea>

            </td>

        </tr>



        <tr>

            <td colspan="4" class="qcell">

                ¿Se evidencia dificultad de gestionar sus emociones?

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q8_si">

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q8_no">

            </td>

            <td colspan="2">

                <textarea class="campo-multilinea" name="q8_com" rows="1"></textarea>

            </td>

        </tr>



        <tr>

            <td colspan="4" class="qcell">

                ¿Se evidencia somnolencia durante las clases?

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q9_si">

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q9_no">

            </td>

            <td colspan="2">

                <textarea class="campo-multilinea" name="q9_com" rows="1"></textarea>

            </td>

        </tr>



        <tr>

            <td colspan="4" class="qcell">

                ¿Se evidencian dificultades de relacionarse con su docente?

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q10_si">

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q10_no">

            </td>

            <td colspan="2">

                <textarea class="campo-multilinea" name="q10_com" rows="1"></textarea>

            </td>

        </tr>



        <tr>

            <td colspan="4" class="qcell">

                ¿Se evidencia dificultad de resolver conflictos?

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q11_si">

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q11_no">

            </td>

            <td colspan="2">

                <textarea class="campo-multilinea" name="q11_com" rows="1"></textarea>

            </td>

        </tr>



        <tr>

            <td colspan="4" class="qcell">

                ¿Se evidencia extrema sensibilidad?

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q12_si">

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q12_no">

            </td>

            <td colspan="2">

                <textarea class="campo-multilinea" name="q12_com" rows="1"></textarea>

            </td>

        </tr>



        <tr>

            <td colspan="4" class="qcell">

                ¿Se identifican conductas de riesgo?

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q13_si">

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q13_no">

            </td>

            <td colspan="2">

                <textarea class="campo-multilinea" name="q13_com" rows="1"></textarea>

            </td>

        </tr>



        <tr>

            <td colspan="4" class="qcell">

                ¿Se aísla y no comparte actividades con sus compañeros/as?

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q14_si">

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q14_no">

            </td>

            <td colspan="2">

                <textarea class="campo-multilinea" name="q14_com" rows="1"></textarea>

            </td>

        </tr>



        <tr>

            <td colspan="4" class="qcell">

                ¿Se evidencia falta de participación en las actividades?

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q15_si">

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q15_no">

            </td>

            <td colspan="2">

                <textarea class="campo-multilinea" name="q15_com" rows="1"></textarea>

            </td>

        </tr>



        <tr>

            <td colspan="4" class="qcell">

                ¿Se observaron otras conductas que requieran atención? ¿Cuál o cuáles?

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q16_si">

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q16_no">

            </td>

            <td colspan="2">

                <textarea class="campo-multilinea" name="q16_com" rows="1"></textarea>

            </td>

        </tr>



        <tr>

            <td colspan="4" class="qcell">

                ¿Se observaron alguna o algunas conductas con mayor frecuencia? ¿Cuál o cuáles?

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q17_si">

            </td>

            <td class="chk-cell">

                <input type="checkbox" name="q17_no">

            </td>

            <td colspan="2">

                <textarea class="campo-multilinea" name="q17_com" rows="1"></textarea>

            </td>

        </tr>



        <tr class="section-row peach">

            <td colspan="8">

                Preguntas para identificar los posibles tipos de atención requerida

            </td>

        </tr>



        <tr class="table-head">

            <td colspan="4">Preguntas</td>

            <td>Si</td>

            <td>No</td>

            <td colspan="2">

                Detalle del tipo de intervención requerida si la respuesta es SÍ

            </td>

        </tr>



        <tr>

            <td colspan="4" class="qcell">

                ¿A partir de la observación se identifica que él o la estudiante posiblemente requiere atención psicosocial de parte del Departamento de Consejería Estudiantil?

            </td>



            <td class="chk-cell">

                <input type="checkbox" name="q18_si">

            </td>



            <td class="chk-cell">

                <input type="checkbox" name="q18_no">

            </td>



            <td colspan="2">

                <textarea class="campo-multilinea" name="q18_det" rows="1"></textarea>

            </td>

        </tr>



        <tr>

            <td colspan="4" class="qcell">

                ¿A partir de la observación se identifica que él o la estudiante posiblemente requiere una atención distinta a la psicosocial?

                <br>

                <span class="instr-italic">

                    Por ejemplo: evaluación psicopedagógica; valoración de lenguaje, valoración médica

                </span>

            </td>



            <td class="chk-cell">

                <input type="checkbox" name="q19_si">

            </td>



            <td class="chk-cell">

                <input type="checkbox" name="q19_no">

            </td>



            <td colspan="2">

                <textarea class="campo-multilinea" name="q19_det" rows="1"></textarea>

            </td>

        </tr>



        <tr class="section-row peach">

            <td colspan="8">

                Preguntas que guían a identificar la necesidad de derivar estudiantes para la atención con otras instancias

            </td>

        </tr>



        <tr class="table-head">

            <td colspan="4">Preguntas</td>

            <td>Si</td>

            <td>No</td>

            <td colspan="2">

                Seleccione solo cuando la respuesta sea SÍ

            </td>

        </tr>



        <tr>

            <td colspan="4" class="qcell">

                ¿Se requiere derivar al estudiante a un departamento o unidad interna a la institución educativa?

            </td>



            <td class="chk-cell">

                <input type="checkbox" name="q20_si">

            </td>



            <td class="chk-cell">

                <input type="checkbox" name="q20_no">

            </td>



            <td colspan="2">



                <div class="opt-line">

                    Inspección

                    <input type="checkbox" name="opt_inspeccion">

                </div>



                <div class="opt-line">

                    Dpto. Inclusión

                    <input type="checkbox" name="opt_inclusion">

                </div>



                <div class="opt-line">

                    Dpto. médico

                    <input type="checkbox" name="opt_medico">

                </div>



                <div class="opt-line">

                    Otro

                    <input type="checkbox" name="opt_otro1">

                    ¿Cuál?

                    <textarea class="campo-multilinea" name="opt_otro1_txt" rows="1"></textarea>

                </div>



            </td>

        </tr>



        <tr>

            <td colspan="4" class="qcell">

                ¿Se requiere derivar al estudiante a una entidad u organización externa a la institución educativa?

            </td>



            <td class="chk-cell">

                <input type="checkbox" name="q21_si">

            </td>



            <td class="chk-cell">

                <input type="checkbox" name="q21_no">

            </td>



            <td colspan="2">



                <div class="opt-line">

                    Centro atención médica

                    <input type="checkbox" name="opt_centro_medica">

                </div>



                <div class="opt-line">

                    Centro atención psicológica

                    <input type="checkbox" name="opt_centro_psico">

                </div>



                <div class="opt-line">

                    UDAI

                    <input type="checkbox" name="opt_udai">



                    Otro

                    <input type="checkbox" name="opt_otro2">



                    ¿Cuál?

                    <textarea class="campo-multilinea" name="opt_otro2_txt" rows="1"></textarea>

                </div>



            </td>

        </tr>



        <tr>

            <td colspan="8">



                <div class="row-inline">



                    <span class="lbl">

                        Nombre de la o el profesional DECE que realiza la observación:

                    </span>



                    <input

                        type="text"

                        name="profesional_dece">



                </div>



            </td>

        </tr>



        <tr>

            <td colspan="8" class="confidential">

                * La información registrada en este documento es confidencial y de uso exclusivo del Departamento de Consejería Estudiantil

            </td>

        </tr>



        </tbody>

    </table>



    <p class="citation">

        Ministerio de Educación (2023).

        <em>Modelo de Gestión del Departamento de Consejería Estudiantil.</em>

        &nbsp; Quito: Ecuador.

    </p>



    <div class="signature-block">

        <div class="signature-line"></div>

        <div class="signature-label">Firma</div>

    </div>



</div>



</div>





<script>



const CLAVE_BORRADOR =

    'apch_ficha_observacion_borrador';





/* ===== Estado de guardado ===== */



function actualizarEstadoGuardado(texto) {



    const textoEstado =

        document.getElementById('textoEstado');



    if (textoEstado) {

        textoEstado.textContent = texto;

    }

}





/* ===== Obtener campos ===== */



function obtenerCampos() {



    return document.querySelectorAll(

        '.page input, .page textarea'

    );



}





/* ===== Guardado automático ===== */



function guardarBorrador() {



    const campos = obtenerCampos();

    const datos = {};



    campos.forEach(campo => {



        if (!campo.name) {

            return;

        }



        if (campo.type === 'checkbox') {



            datos[campo.name] = {

                tipo: 'checkbox',

                valor: campo.checked

            };



        } else {



            datos[campo.name] = {

                tipo: 'texto',

                valor: campo.value

            };



        }



    });



    localStorage.setItem(

        CLAVE_BORRADOR,

        JSON.stringify(datos)

    );



    actualizarEstadoGuardado('Guardado');



}





/* ===== Cargar borrador ===== */



function cargarBorrador() {

    if (window.formularioEnEdicion) {
        return;
    }



    const borrador =

        localStorage.getItem(CLAVE_BORRADOR);



    if (!borrador) {



        actualizarEstadoGuardado(

            'Sin datos guardados'

        );



        return;

    }



    try {



        const datos =

            JSON.parse(borrador);



        const campos =

            obtenerCampos();



        campos.forEach(campo => {



            if (

                !campo.name ||

                !datos[campo.name]

            ) {

                return;

            }



            if (campo.type === 'checkbox') {



                campo.checked =

                    datos[campo.name].valor;



            } else {



                campo.value =

                    datos[campo.name].valor || '';



            }



        });



        actualizarEstadoGuardado(

            'Borrador cargado'

        );



    } catch (error) {



        console.error(

            'Error al cargar el borrador:',

            error

        );



        actualizarEstadoGuardado(

            'Error al cargar'

        );



    }



}





/* ===== Borrar todo ===== */

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











/* ===== Volver ===== */



function volver() {



    window.history.back();



}





/* ===== Guardar e imprimir ===== */



function guardarEImprimir() {

    guardarBorrador();

    const campos = obtenerCampos();

    const datos = {};

    campos.forEach(campo => {

        if (!campo.name) {
            return;
        }

        if (campo.type === 'checkbox') {

            datos[campo.name] = {
                tipo: 'checkbox',
                valor: campo.checked
            };

        } else {

            datos[campo.name] = {
                tipo: 'texto',
                valor: campo.value
            };

        }

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
                    'FICHA DE OBSERVACIÓN',

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





/* ===== Zoom ===== */



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

        (anchoDisponible * 0.92) / anchoA4;



    zoomCalculado = Math.max(

        ZOOM_MINIMO,

        Math.min(

            ZOOM_MAXIMO,

            zoomCalculado

        )

    );



    zoomCalculado =

        Math.round(zoomCalculado * 10) / 10;



    zoomActual = zoomCalculado;



    aplicarZoom();



}





function aumentarZoom() {



    zoomActual += ZOOM_PASO;



    if (zoomActual > ZOOM_MAXIMO) {

        zoomActual = ZOOM_MAXIMO;

    }



    zoomActual =

        Math.round(zoomActual * 10) / 10;



    aplicarZoom();



}





function disminuirZoom() {



    zoomActual -= ZOOM_PASO;



    if (zoomActual < ZOOM_MINIMO) {

        zoomActual = ZOOM_MINIMO;

    }



    zoomActual =

        Math.round(zoomActual * 10) / 10;



    aplicarZoom();



}





function restablecerZoom() {



    calcularZoomAutomatico();



}





/* ===== Inicialización ===== */



document.addEventListener(

    'DOMContentLoaded',

    function () {



        cargarBorrador();

        ajustarCamposMultilinea();



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



        calcularZoomAutomatico();



    }

);





/* ===== Cajas de texto que crecen con su contenido ===== */

function ajustarCamposMultilinea() {

    if (CSS.supports('field-sizing', 'content')) {

        return;

    }

    document
        .querySelectorAll('textarea.campo-multilinea')
        .forEach(campo => {

            campo.style.height = 'auto';

            campo.style.height = campo.scrollHeight + 'px';

        });

}

document.addEventListener('input', function (evento) {

    if (evento.target.matches('textarea.campo-multilinea')) {

        ajustarCamposMultilinea();

    }

});

window.addEventListener('load', ajustarCamposMultilinea);

window.addEventListener('beforeprint', ajustarCamposMultilinea);



/* ===== Ajustar al cambiar tamaño ===== */



window.addEventListener(

    'resize',

    function () {



        calcularZoomAutomatico();



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
