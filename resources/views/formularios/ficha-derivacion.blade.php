


<html>

<head>

<meta charset="UTF-8">

<title>FICHA DE DERIVACIÓN</title>



<style>

    :root {

        --zoom-documento: 1;

    }



    @page {

        size: A4;

        margin: 10mm 8mm;

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

        transition: *background* 0.15s ease, border-color 0.15s ease;

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

        height: auto;

        padding: 7mm 10mm 4mm 12mm;

        margin: 0 auto 25px auto;

        background: #fff;

        position: relative;

        overflow: visible;

        font-size: 12.5px;

        line-height: 14px;

        box-shadow: 0 2px 14px rgba(0, 0, 0, 0.18);

        zoom: var(--zoom-documento, 1);

        transform-origin: top center;

    }



    /* ===== Header ===== */

    .header {

        display: flex;

        align-items: center;

        margin-bottom: 3px;

    }



    .header-logo img {

        width: 78px;

        position: relative;

        left: 170px;

    }



    .header img {

        width: 82px;

        height: auto;

        margin-right: 10px;

    }



    .header-text {

        flex: 1;

        text-align: center;

    }



    .header-text .line1,

    .header-text .line2 {

        font-size: 19px;

        font-weight: bold;

        line-height: 1.05;

    }



    .header-text .line3 {

        font-size: 13px;

        line-height: 1.2;

    }
    .header-text .line4 {

        font-size: 10px;

        line-height: 1.2;

    }



    .header-rule {

        border-bottom: 3px solid #000;

        margin-bottom: 4px;

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
        font-family: "Times New Roman", Times, serif;

        padding: 1.8px 6px;

        vertical-align: top;

        font-size: 12.5px;

        overflow: visible;

    }



    .title-row td {

        text-align: center;

        font-size: 17px;

        font-weight: bold;

        padding: 3px 4px;

    }



    .section-row td {

        text-align: center;

        font-weight: bold;

        font-size: 13.5px;

        padding: 2px 4px;

    }



    .spacer-row td {

        height: 8px;

        padding: 0;

    }



    .lbl {

        font-weight: bold;

    }



    .row-inline {

        display: flex;

        align-items: baseline;

        white-space: nowrap;

    }



    .row-inline .lbl {

        white-space: nowrap;

        margin-right: 3px;

    }



    input[type="text"],
    input[type="date"] {

        flex: 1;

        width: 100%;

        border: none;

        font-family: "Times New Roman", Times, serif;

        font-size: 12.5px;

        background: transparent;

        padding: 0;

        margin: 0;

    }



    input[type="text"]:focus,
    input[type="date"]:focus {

        outline: none;

        background: #fafff0;

    }



    input[type="text"]::placeholder {

        font-style: italic;

        color: #333;

        opacity: 1;

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
        white-space: nowrap;
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



    .chk-cell {
        padding-left: 0;
        padding-right: 0;
    }
    .chk-cell input[type="checkbox"] {
        display: block;
        width: 100%;
    }
    .dato-fijo {
        font-family: "Times New Roman", Times, serif;
        font-size: 12.5px;
        font-weight: normal;
    }
    input.firma-nombre {
        display: block;
        flex: none;
        width: calc(100% - 20px);
        height: 18px;
        margin: 0 10px;
        text-align: center;
    }
    .chk-cell {

        text-align: center;

        vertical-align: middle;

    }



    textarea {

        width: 100%;

        border: none;

        resize: none;

        overflow: hidden;

        font-family: "Times New Roman", Times, serif;

        font-size: 12.5px;

        line-height: 14px;

        background: transparent;

        padding: 0;

        display: block;

        box-sizing: border-box;

        white-space: pre-wrap;

        overflow-wrap: anywhere;

    }



    /* Historia de la situación actual: el cuadro mantiene su ancho y
       crece verticalmente según el contenido, sin barra de desplazamiento. */

    .textarea-historia {

        height: 55px;

        min-height: 55px;

        max-height: none;

        overflow: hidden !important;

        resize: none;

    }

    .textarea-historia-impresion {

        display: none;

    }



    textarea:focus {

        outline: none;

        background: #fafff0;

    }



    .instr {

        font-style: italic;

    }



    .sig-cell {

        text-align: center;

        vertical-align: bottom;

        padding: 1px 4px;

        height: 100%;

    }



    .sig-cell .sig-top-label {

        font-weight: bold;

        text-align: left;

    }



    .sig-line {

        border-top: 1px solid #000;

        margin: 0 10px;

    }



    .sig-caption {

        font-size: 12px;

        margin: 1px 0 3px 0;

    }



    .sello-cell {

        text-align: center;

        vertical-align: bottom;

        padding-bottom: 2px;

    }



    /* ===== Citation / footer ===== */

    .citation {

        font-size: 11px;

        margin-top: 3px;

        margin-bottom: 0;

    }



    .historia-cell {

        height: auto !important;

        min-height: 84px;

        overflow: visible !important;

        vertical-align: top;

    }



    .historia-cell .textarea-historia {

        height: 55px;

    }

    .historia-row {

        break-inside: avoid;

        page-break-inside: avoid;

    }


    /* El contenido puede aumentar la altura del documento; nunca se crea
       un scroll interno para ocultar texto escrito por el usuario. */

    .documento,
    .page,
    table.form,
    table.form tbody,
    table.form tr,
    table.form td {

        overflow: visible;

    }



    /* ===== Continuación de contenido en varias hojas ===== */

    table.form {
        break-inside: auto;
        page-break-inside: auto;
    }

    table.form tr {

        break-inside: avoid;

        page-break-inside: avoid;

    }

    table.form td {

        break-inside: auto;
        page-break-inside: auto;
    }



    /* ===== Print rules ===== */

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

            width: auto;

            min-height: 0;

            height: auto;

            margin: 0;

            padding: 0 5mm;

            box-shadow: none;

            overflow: visible;

            zoom: 1 !important;

            page-break-after: auto;

            break-after: auto;

        }

        table.form tr.historia-row {

            break-inside: auto;

            page-break-inside: auto;

        }

        .textarea-historia {

            display: none !important;

        }

        .textarea-historia-impresion {

            display: block;

            min-height: 55px;

            white-space: pre-wrap;

            overflow-wrap: anywhere;

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

.page,
.page * {
    font-family: "Times New Roman", Times, serif !important;
}

@include('formularios.partials.encabezado-institucional-estilos')
@include('formularios.partials.toolbar-moderno')
</style>

</head>



<body>



<div class="toolbar">

    @include('formularios.partials.selector-carpeta')

    <button type="button" class="btn-borrar" onclick="borrarTodo()">

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



        <span class="zoom-label" id="zoomLabel">

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
        onclick="window.location.href='{{ route('formularios.mis-documentos', ['tipo' => 'ficha-derivacion']) }}'"
    >
        📂 Mis formularios
    </button>



    <div class="estado-guardado" id="estadoGuardado">

        <span class="estado-punto"></span>

        <span id="textoEstado">Guardado</span>

    </div>



</div>



<div class="documento">



<div class="page">



    @include('formularios.partials.encabezado-institucional')



    <table class="form">

        <colgroup>

            <col style="width:6.562%">

            <col style="width:6.718%">

            <col style="width:18.925%">

            <col style="width:3.403%">

            <col style="width:2.301%">

            <col style="width:2.243%">

            <col style="width:3.754%">

            <col style="width:3.920%">

            <col style="width:15.494%">

            <col style="width:5.462%">

            <col style="width:7.830%">

            <col style="width:10.140%">

            <col style="width:6.914%">

            <col style="width:6.338%">

        </colgroup>



        <tbody>



        <tr class="title-row">

            <td colspan="14">FICHA DE DERIVACIÓN</td>

        </tr>



        <tr class="section-row">

            <td colspan="14">DATOS INSTITUCIONALES</td>

        </tr>



        <tr>

            <td colspan="14">

                <div class="row-inline">

                    <span class="lbl">Nombre de la institución educativa:</span>

                    <span class="dato-fijo">Unidad Educativa Ángel Polibio Chaves</span>

                </div>

            </td>

        </tr>



        <tr>

            <td colspan="14">

                <div class="row-inline">

                    <span class="lbl">Dirección y número telefónico de la institución:</span>

                    <span class="dato-fijo">Avda. El Maestro - Barrio 13 de Abril - 032989035</span>

                </div>

            </td>

        </tr>



        <tr>

            <td colspan="14">

                <div class="row-inline">

                    <span class="lbl">Fecha de derivación:</span>

                    <input type="date" name="fecha_derivacion" data-desde-hoy>

                </div>

            </td>

        </tr>



        <tr class="spacer-row">

            <td colspan="14"></td>

        </tr>



        <tr class="section-row">

            <td colspan="14">INTERNA</td>

        </tr>



        <tr class="section-row">

            <td colspan="7">INTERNA A LA INSTITUCIÓN EDUCATIVA</td>

            <td colspan="7">INTERNA AL MINISTERIO DE EDUCACIÓN</td>

        </tr>



        <tr>

            <td colspan="6">Departamento de Inclusión Educativa</td>

            <td class="chk-cell">

                <input type="checkbox" name="chk_inc_educ">

            </td>



            <td colspan="6">Unidad Distrital de Apoyo a la Inclusión (UDAI)</td>

            <td class="chk-cell">

                <input type="checkbox" name="chk_udai">

            </td>

        </tr>



        <tr>

            <td colspan="6">Docente de apoyo a la inclusión</td>

            <td class="chk-cell">

                <input type="checkbox" name="chk_doc_apoyo">

            </td>



            <td colspan="6">Dirección Distrital de Educación</td>

            <td class="chk-cell">

                <input type="checkbox" name="chk_dir_distrital">

            </td>

        </tr>



        <tr>

            <td colspan="6">Inspección</td>

            <td class="chk-cell">

                <input type="checkbox" name="chk_inspeccion">

            </td>



            <td colspan="6" rowspan="2">

                <div class="row-inline">

                    Otro (indique)

                    <input type="text" name="interna_men_otro_txt">

                </div>

            </td>



            <td class="chk-cell" rowspan="2">

                <input type="checkbox" name="chk_men_otro">

            </td>

        </tr>



        <tr>

            <td colspan="6">

                <div class="row-inline">

                    Otro (indique)

                    <input type="text" name="interna_inst_otro_txt">

                </div>

            </td>



            <td class="chk-cell">

                <input type="checkbox" name="chk_inst_otro">

            </td>

        </tr>



        <tr class="section-row">

            <td colspan="14">EXTERNA</td>

        </tr>



        <tr class="section-row">

            <td colspan="14">EXTERNA AL MINISTERIO DE EDUCACIÓN</td>

        </tr>



        <tr>

            <td colspan="7">Unidades especializadas de la policía</td>

            <td class="chk-cell">

                <input type="checkbox" name="chk_policia">

            </td>



            <td colspan="6">

                <input type="text" name="ext_policia_txt">

            </td>

        </tr>



        <tr>

            <td colspan="7">Establecimiento de salud pública</td>

            <td class="chk-cell">

                <input type="checkbox" name="chk_salud_pub">

            </td>



            <td colspan="6">

                <input

                    type="text"

                    name="ext_salud_pub_txt"

                    placeholder="Citar en este espacio el centro de salud al que se deriva">

                >

            </td>

        </tr>



        <tr>

            <td colspan="7">Establecimiento de salud privada</td>

            <td class="chk-cell">

                <input type="checkbox" name="chk_salud_priv">

            </td>



            <td colspan="6">

                <input

                    type="text"

                    name="ext_salud_priv_txt"

                    placeholder="Citar en este espacio el centro de salud al que se deriva">

                >

            </td>

        </tr>



        <tr>

            <td colspan="7">Ministerio de Inclusión Económica y Social</td>

            <td class="chk-cell">

                <input type="checkbox" name="chk_mies">

            </td>



            <td colspan="6">

                <input type="text" name="ext_mies_txt">

            </td>

        </tr>



        <tr>

            <td colspan="7">Ministerio de la mujer y derechos humanos</td>

            <td class="chk-cell">

                <input type="checkbox" name="chk_mujer">

            </td>



            <td colspan="6">

                <input type="text" name="ext_mujer_txt">

            </td>

        </tr>



        <tr>

            <td colspan="7">

                <div class="row-inline">

                    Otro (indique)

                    <input type="text" name="ext_otro_txt">

                </div>

            </td>



            <td class="chk-cell">

                <input type="checkbox" name="chk_ext_otro">

            </td>



            <td colspan="6">

                <input type="text" name="ext_otro_txt2">

            </td>

        </tr>



        <tr class="section-row">

            <td colspan="14">

                DATOS PERSONALES DEL O LA ESTUDIANTE QUE SE DERIVA

            </td>

        </tr>



        <tr>

            <td colspan="14">

                <div class="row-inline">

                    <span class="lbl">Apellidos y Nombres completos:</span>

                    <input type="text" name="est_nombres">

                </div>

            </td>

        </tr>



        <tr>

            <td><strong>Edad</strong></td>

            <td>

                <input type="text" name="est_edad">

            </td>



            <td><strong>Fecha de nacimiento</strong></td>

            <td colspan="5">

                <input type="text" name="est_fecha_nac">

            </td>



            <td><strong>Grado/Curso</strong></td>



            <td colspan="2">

                <input type="text" name="est_grado">

            </td>



            <td><strong>Género</strong></td>



            <td colspan="2">

                <input type="text" name="est_genero">

            </td>

        </tr>



        <tr>

            <td colspan="3"><strong>Nº documento identidad</strong></td>



            <td colspan="5">

                <input type="text" name="est_doc_id">

            </td>



            <td><strong>Discapacidad</strong></td>



            <td colspan="5">

                <input type="text" name="est_discapacidad">

            </td>

        </tr>



        <tr>

            <td colspan="14">

                <div class="row-inline">

                    <span class="lbl">Dirección domiciliaria:</span>

                    <input type="text" name="est_direccion">

                </div>

            </td>

        </tr>



        <tr>

            <td colspan="14">

                <div class="row-inline">

                    <span class="lbl">Nacionalidad:</span>

                    <input type="text" name="est_nacionalidad">

                </div>

            </td>

        </tr>



        <tr>

            <td colspan="14">

                <div class="row-inline">

                    <span class="lbl">Nombre del representante:</span>

                    <input type="text" name="est_representante">

                </div>

            </td>

        </tr>



        <tr class="section-row">

            <td colspan="14">MOTIVO DE REFERENCIA</td>

        </tr>



        <tr class="historia-row">

            <td colspan="14" class="historia-cell">

                <div>

                    <span class="lbl">Historia de la situación actual:</span>

                    <span class="instr">

                        (síntesis de la situación de él o la estudiante, el entorno educativo y familiar desde el ámbito de la atención psicosocial)

                    </span>

                </div>



                <textarea name="historia_situacion" class="textarea-historia"></textarea>

                <div class="textarea-historia-impresion" aria-hidden="true"></div>

            </td>

        </tr>



        <tr>

            <td colspan="14" style="height:34px;">

                <div>

                    <span class="lbl">Acciones desarrolladas:</span>

                    <span class="instr">(en el ámbito de la atención psicosocial)</span>

                </div>



                <textarea name="acciones_desarrolladas" style="height:17px;"></textarea>

            </td>

        </tr>



        <tr>

            <td colspan="14" style="height:48px;">

                <div>

                    <span class="lbl">

                        Tipo de atención que se requiere de parte de la entidad interna/externa:

                    </span>

                </div>



                <textarea name="tipo_atencion" style="height:30px;"></textarea>

            </td>

        </tr>



        <tr>

            <td colspan="14" style="height:48px;">

                <div>

                    <span class="lbl">Observaciones:</span>

                </div>



                <textarea name="observaciones" style="height:30px;"></textarea>

            </td>

        </tr>



        <tr>

            <td colspan="4" class="sig-cell" style="height:120px;">

                <div class="sig-top-label">FICHA ELABORADA POR:</div>



                <div style="height:48px;"></div>



                <div class="sig-line"></div>



                <div class="sig-caption">

                    Firma profesional DECE

                </div>



                <input type="text" class="firma-nombre" name="nombre_profesional_dece">



                <div class="sig-line"></div>



                <div class="sig-caption">

                    Nombre profesional DECE

                </div>

            </td>



            <td colspan="6" class="sig-cell">

                <div class="sig-top-label" style="text-align:center;">

                    RECIBIDA POR:

                </div>



                <div style="height:48px;"></div>



                <div class="sig-line"></div>



                <div class="sig-caption">

                    Firma  autoridad institucional

                </div>



                <input type="text" class="firma-nombre" name="nombre_autoridad_institucional">



                <div class="sig-line"></div>



                <div class="sig-caption">

                    Nombre autoridad institucional

                </div>

            </td>



            <td colspan="4" class="sello-cell">

                <div style="height:82px;"></div>



                <div class="sig-caption">

                    <strong>Sello de la institución</strong>

                </div>

            </td>

        </tr>



        <tr>

            <td colspan="4">

                <div class="row-inline">

                    <span class="lbl">FECHA:</span>

                    <input type="date" name="fecha_elaborada" data-desde-hoy>

                </div>

            </td>



            <td colspan="6">

                <div class="row-inline">

                    <span class="lbl">FECHA:</span>

                    <input type="date" name="fecha_recibida" data-desde-hoy>

                </div>

            </td>



            <td colspan="4"></td>

        </tr>



        </tbody>

    </table>



    <p class="citation">

        Ministerio de Educación (2023).

        <em>Modelo de Gestión del Departamento de Consejería Estudiantil.</em>

          Quito: Ecuador.

    </p>



</div>



</div>



<script>

const CLAVE_BORRADOR = 'apch_ficha_derivacion_borrador';



/* ===== Estado ===== */



function actualizarEstadoGuardado(texto) {

    const textoEstado = document.getElementById('textoEstado');



    if (textoEstado) {

        textoEstado.textContent = texto;

    }

}



/* ===== Campos ===== */



function obtenerCampos() {

    return document.querySelectorAll('.page input, .page textarea');

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



/* ===== Ajuste automático de Historia de la situación actual ===== */

function ajustarAlturaHistoria() {
    const campo = document.querySelector('.textarea-historia');

    if (!campo) {

        return;

    }

    campo.style.height = 'auto';

    campo.style.height = Math.max(55, campo.scrollHeight) + 'px';
}

function prepararHistoriaParaImpresion() {
    const campo = document.querySelector('.textarea-historia');
    const vistaImpresion = document.querySelector('.textarea-historia-impresion');

    if (campo && vistaImpresion) {
        vistaImpresion.textContent = campo.value;
    }
}

window.prepararHistoriaParaImpresion = prepararHistoriaParaImpresion;

window.addEventListener('beforeprint', function () {
    ajustarAlturaHistoria();
    prepararHistoriaParaImpresion();
});



/* ===== Cargar borrador ===== */



function cargarBorrador() {

    if (window.formularioEnEdicion) {
        return;
    }

    const borrador = localStorage.getItem(CLAVE_BORRADOR);



    if (!borrador) {

        actualizarEstadoGuardado('Sin datos guardados');

        return;

    }



    try {

        const datos = JSON.parse(borrador);

        const campos = obtenerCampos();



        campos.forEach(campo => {

            if (!campo.name || !datos[campo.name]) {

                return;

            }



            if (campo.type === 'checkbox') {

                campo.checked = datos[campo.name].valor;

            } else {

                campo.value = datos[campo.name].valor || '';

            }

        });



        actualizarEstadoGuardado('Borrador cargado');

        ajustarAlturaHistoria();



    } catch (error) {

        console.error(

            'Error al cargar el borrador:',

            error

        );



        actualizarEstadoGuardado('Error al cargar');

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

    ajustarAlturaHistoria();
    prepararHistoriaParaImpresion();
    guardarBorrador();

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
                    'FICHA DE DERIVACIÓN',

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



    const zoomLabel = document.getElementById('zoomLabel');



    if (zoomLabel) {

        zoomLabel.textContent =

            Math.round(zoomActual * 100) + '%';

    }

}



function calcularZoomAutomatico() {

    const anchoDisponible = window.innerWidth - 80;

    const anchoA4 = 793.7;



    let zoomCalculado =

        (anchoDisponible * 0.92) / anchoA4;



    zoomCalculado = Math.max(

        ZOOM_MINIMO,

        Math.min(ZOOM_MAXIMO, zoomCalculado)

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

        ajustarAlturaHistoria();



        const campos = obtenerCampos();



        campos.forEach(campo => {



            campo.addEventListener(

                'input',

                function () {

                    if (campo.classList.contains('textarea-historia')) {

                        ajustarAlturaHistoria();

                    }

                    guardarBorrador();

                }

            );



            campo.addEventListener(

                'change',

                guardarBorrador

            );



        });



        calcularZoomAutomatico();

    }

);



/* ===== Ajustar nuevamente al cambiar tamaño ===== */



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
