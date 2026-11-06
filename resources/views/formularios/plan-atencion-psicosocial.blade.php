<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PLAN DE ATENCIÓN PSICOSOCIAL Y SEGUIMIENTO</title>

<style>

    @page {
        size: A4;
        margin: 10mm 8mm;
    }

    * {
        box-sizing: border-box;
    }

    :root {
        --zoom-documento: 1;
    }

    html,
    body {
        margin: 0;
        padding: 0;
        color: #000;
    }

    body {
        background: #e5e5e5;
        font-family: "Times New Roman", Times, serif;
        font-size: 10pt;
        padding: 0;
    }

    /* =========================
       BARRA DE HERRAMIENTAS
       ========================= */

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

        transition:
            background 0.15s ease,
            border-color 0.15s ease;
    }

    .toolbar button:hover {
        background: #e9e9e9;
        border-color: #999;
    }

    .btn-volver {
        background: #f5f5f5 !important;
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

    /* =========================
       CONTROL DE ZOOM
       ========================= */

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

    /* =========================
       ESTADO DE GUARDADO
       ========================= */

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

    /* =========================
       CONTENEDOR DEL DOCUMENTO
       ========================= */

    .documento {
        width: 100%;
        overflow-x: auto;
        overflow-y: visible;

        padding: 25px 20px 40px;
    }

    /* =========================
       HOJA A4 DINÁMICA
       ========================= */

    .page {
        width: 210mm;
        min-height: 297mm;
        height: auto;

        position: relative;

        margin: 0 auto 25px;

        overflow: visible;

        background: #fff;

        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.20);

        page-break-after: always;
        break-after: page;

        zoom: var(--zoom-documento, 1);
        transform-origin: top center;

        font-family: "Times New Roman", Times, serif;

        padding-top: 32.8mm;
        padding-bottom: 8mm;
    }

    .page:last-of-type {
        page-break-after: auto;
        break-after: auto;
    }

    .page input,
    .page textarea,
    .page select {
        font-family: "Times New Roman", Times, serif;
    }

    /* =========================
       ENCABEZADO INSTITUCIONAL
       ========================= */

    .institution-header {
        position: absolute;

        top: 7.5mm;
        left: 31.7mm;

        width: 147mm;
        height: 20.5mm;

        border-bottom: 1.2mm solid #000;

        font-family: "Times New Roman", Times, serif;
    }

    .institution-header img {
        position: absolute;

        left: 6.5mm;
        top: 0.5mm;

        width: 15.4mm;
        height: 17.3mm;

        object-fit: contain;
    }

    .institution-text {
        position: absolute;

        left: 34mm;
        top: -0.3mm;

        width: 88mm;

        text-align: center;

        line-height: 1.05;
        white-space: nowrap;
    }

    .institution-text .line1 {
        font-size: 14pt;
    }

    .institution-text .line2 {
        font-size: 16pt;
    }

    .institution-text .line3 {
        margin-top: 0.8mm;
        font-size: 11pt;
    }

    .institution-text .line4 {
        font-size: 9pt;
        margin-top: 0.5mm;
    }

    /* =========================
       CONTENEDORES PRINCIPALES
       ========================= */

    .form-box {
        position: relative;

        left: auto;
        top: auto;

        width: 180mm;

        margin-left: auto;
        margin-right: auto;

        border: 0.55mm solid #000;

        height: auto;

        overflow: visible;
    }

    .page1-box {
        min-height: 212.3mm;
    }

    .page2-box {
        min-height: 259.4mm;
    }

    /* =========================
       TABLAS
       ========================= */

    table {
        width: 100%;

        border-collapse: collapse;
        table-layout: fixed;

        margin: 0;
    }

    td,
    th {
        border: 0.25mm solid #000;

        padding: 1.2mm 1.7mm;

        vertical-align: top;
    }

    .thick {
        border-width: 0.5mm !important;
    }

    /*
     * Las filas completas se mantienen juntas
     * cuando sea posible al imprimir.
     */

    tr {
        break-inside: avoid;
        page-break-inside: avoid;
    }

    /* =========================
       PRIMERA PÁGINA
       ========================= */

    .title-cell {
        height: 14.8mm;

        text-align: center;
        vertical-align: middle;

        font-weight: bold;
        font-size: 12pt;

        font-family: "Times New Roman", Times, serif;
    }

    .section-title {
        height: 4.6mm;

        text-align: center;
        vertical-align: middle;

        font-weight: bold;
        font-size: 10pt;

        padding-top: 0.5mm;
        padding-bottom: 0.5mm;
    }

    .data-row {
        height: 5.7mm;

        vertical-align: middle;
    }

    .data-row td {
        vertical-align: middle;

        padding-top: 0.6mm;
        padding-bottom: 0.6mm;
    }

    .diagnostic {
        min-height: 41.2mm;

        height: auto;

        font-size: 9pt;
        line-height: 1.55;
    }

    .diagnostic strong {
        font-size: 10pt;
    }

    .intervention-row {
        min-height: 6mm;

        height: auto;

        font-size: 10pt;
        font-weight: bold;

        vertical-align: middle;

        white-space: nowrap;
    }

    .intervention-row .normal {
        position: static;

        display: inline-flex;

        height: auto;

        line-height: normal;

        margin-left: 7mm;
    }

    .intervention-row td {
        position: relative;
    }

    .actions-title {
        height: 4.5mm;

        text-align: center;
        vertical-align: middle;

        font-weight: bold;
        font-size: 10pt;

        padding-top: 0.4mm;
        padding-bottom: 0.4mm;
    }

    .actions-head {
        height: 15.8mm;

        font-weight: bold;
        font-size: 10pt;

        line-height: 1.25;

        vertical-align: top;
    }

    .actions-row {
        height: 21.5mm;
        min-height: 21.5mm;
    }

    /* =========================
       BOTÓN AGREGAR FILA
       ========================= */

    .dynamic-controls {
        display: flex;
        justify-content: flex-end;
        align-items: center;

        gap: 5px;

        margin-top: 2mm;

        padding-bottom: 2mm;

        font-family: Arial, sans-serif;
    }

    .btn-agregar-fila {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        padding: 4px 10px;

        border: 1px solid #999;
        border-radius: 5px;

        background: #f5f5f5;
        color: #222;

        font-family: Arial, sans-serif;
        font-size: 12px;
        font-weight: bold;

        cursor: pointer;
    }

    .btn-agregar-fila:hover {
        background: #e8e8e8;
    }

    .fila-ayuda {
        font-family: Arial, sans-serif;
        font-size: 10px;
        color: #666;
    }

    /* =========================
       FIRMA
       ========================= */

    .signature-box {
        position: relative;

        left: auto;
        top: auto;

        width: 180mm;
        min-height: 36.2mm;
        height: auto;

        margin: 2mm auto 0;

        border: 0.55mm solid #000;
    }

    .signature-inner {
        width: 100%;

        border-collapse: collapse;
    }

    .signature-title {
        height: 12.5mm;

        text-align: center;
        vertical-align: bottom;

        font-weight: bold;
        font-size: 10pt;

        padding-bottom: 1.5mm;
    }

    .name-row {
        height: 10mm;

        font-weight: bold;

        vertical-align: middle;
    }

    .confidential {
        height: 11mm;

        font-style: italic;
        font-size: 10pt;

        line-height: 1.25;

        vertical-align: top;
    }

    .citation {
        position: relative;

        left: auto;
        top: auto;

        width: 180mm;

        margin: 1mm auto 0;

        font-family: "Times New Roman", Times, serif;

        font-size: 8pt;

        white-space: nowrap;
    }

    /* =========================
       SEGUNDA PÁGINA
       ========================= */

.follow-title {
        height: 14.5mm;

        text-align: center;
        vertical-align: middle;

        font-weight: bold;
        font-size: 12pt;
    }

    .follow-subtitle {
        height: 4.8mm;

        text-align: center;
        vertical-align: middle;

        font-weight: bold;
        font-size: 10pt;

        padding-top: 0.5mm;
        padding-bottom: 0.5mm;
    }

    .follow-head {
        height: 17.8mm;

        text-align: center;
        vertical-align: middle;

        font-weight: bold;
        font-size: 10pt;

        line-height: 1.05;

        padding: 1.1mm 1.5mm;
    }

    .follow-row {
        height: 21.4mm;
        min-height: 21.4mm;
    }

    .follow-confidential {
        height: 11mm;

        font-style: italic;
        font-size: 10pt;

        line-height: 1.25;

        vertical-align: top;
    }

    /* =========================
       CAMPOS
       ========================= */

    input[type="text"],
    input[type="date"],
    textarea {
        width: 100%;

        margin: 0;
        padding: 0;

        border: 0;
        outline: 0;
        border-radius: 0;

        background: transparent;

        color: #000;

        font: inherit;

        resize: none;
    }

    input[type="text"],
    input[type="date"] {
        height: 4.5mm;
    }

    textarea {
        height: 100%;
        min-height: 24mm;
    }

    .inline-field {
        display: inline-block;

        vertical-align: middle;

        height: 4.5mm;
    }

    .student-field {
        width: 100mm;
    }

    .course-field {
        width: 55mm;
    }

    .day-field {
        width: 30mm;
    }

    .teacher-field {
        width: 55mm;
    }

    .date-field {
        width: 38mm;
    }

    .diagnostic-input {
        height: 30mm;

        border-bottom: none;
    }

    .cell-input,
    .cell-textarea {
        height: 100%;

        min-height: 17mm;
    }

    /* =========================
       CHECKBOX
       ========================= */

    .check-wrap {
        display: inline-flex;

        align-items: center;

        gap: 1mm;

        margin-left: 2mm;

        font-weight: normal;

        white-space: nowrap;
    }

    input[type="checkbox"] {
        appearance: none;
        -webkit-appearance: none;

        width: 7mm;
        height: 4mm;

        border: none;

        vertical-align: middle;

        margin: 0;
        padding: 0;

        background: transparent;

        position: relative;
    }

    input[type="checkbox"]::after {
        content: "( )";

        position: absolute;

        inset: 0;

        display: flex;

        align-items: center;
        justify-content: center;

        font-family: "Times New Roman", Times, serif;

        font-size: 10pt;

        font-weight: normal;

        line-height: 4mm;

        color: #000;
    }

    input[type="checkbox"]:checked::after {
        content: "(x)";
        font-weight: bold;
    }

    /* =========================
       CONTINUACIÓN
       ========================= */

    .continuation-page {
        position: relative;
    }

    .continuation-page .form-box {
        top: auto;
        height: auto;
        min-height: 40mm;
    }

    .continuation-page .continuation-table {
        width: 100%;
    }

    .continuation-page .continuation-title {
        height: 9mm;

        text-align: center;
        vertical-align: middle;

        font-weight: bold;
        font-size: 10pt;
    }

    .continuation-page .continuation-head {
        height: 15.8mm;

        text-align: center;
        vertical-align: middle;

        font-weight: bold;
        font-size: 10pt;

        line-height: 1.2;
    }

    .continuation-page .continuation-follow-head {
        height: 17.8mm;

        text-align: center;
        vertical-align: middle;

        font-weight: bold;
        font-size: 10pt;

        line-height: 1.05;

        padding: 1.1mm 1.5mm;
    }

    .continuation-page .actions-row,
    .continuation-page .follow-row {
        height: 21.5mm;
    }

    .continuation-page .follow-row {
        height: 21.4mm;
    }

    /* =========================
       IMPRESIÓN
       ========================= */

    @media print {

        html,
        body {
            width: 210mm;

            margin: 0;
            padding: 0;

            background: #fff;
        }

        .toolbar,
        .dynamic-controls {
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

            padding-top: 32.8mm;
            padding-bottom: 8mm;

            box-shadow: none;

            overflow: visible;

            zoom: 1 !important;

            page-break-after: always;
            break-after: page;
        }

        .page:last-of-type {
            page-break-after: auto;
            break-after: auto;
        }

        .form-box {
            overflow: visible;
            min-height: 0;
        }

        .signature-box {
            overflow: visible;
        }

        .continuation-page {
            page-break-after: always;
            break-after: page;
        }

        .continuation-page:last-child {
            page-break-after: auto;
            break-after: auto;
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
        onclick="window.location.href='{{ route('formularios.mis-documentos', ['tipo' => 'plan-atencion-psicosocial']) }}'"
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


<div class="documento" id="documento">


<!-- =========================
     PÁGINA 1
     ========================= -->

<section class="page" id="paginaPrincipal">

    @include('formularios.partials.encabezado-institucional')


    <div class="form-box page1-box">

        <table>

            <colgroup>
                <col style="width:25%">
                <col style="width:25%">
                <col style="width:25%">
                <col style="width:25%">
            </colgroup>

            <tr>

                <td
                    colspan="4"
                    class="title-cell thick"
                >
                    PLAN DE ATENCIÓN PSICOSOCIAL Y SEGUIMIENTO
                </td>

            </tr>

            <tr>

                <td
                    colspan="4"
                    class="section-title thick"
                >
                    DATOS INFORMATIVOS GENERALES
                </td>

            </tr>

            <tr class="data-row">

                <td colspan="4">

                    Nombre de estudiante a atender:

                    <span class="inline-field student-field">

                        <input
                            type="text"
                            aria-label="Nombre de estudiante a atender"
                        >

                    </span>

                </td>

            </tr>

            <tr class="data-row">

                <td colspan="2">

                    Curso y paralelo:

                    <span class="inline-field course-field">

                        <input
                            type="text"
                            aria-label="Curso y paralelo"
                        >

                    </span>

                </td>

                <td colspan="2">

                    Jornada:

                    <span class="inline-field day-field">

                        <input
                            type="text"
                            aria-label="Jornada"
                        >

                    </span>

                </td>

            </tr>

            <tr class="data-row">

                <td colspan="2">

                    Nombre docente tutor/a:

                    <span class="inline-field teacher-field">

                        <input
                            type="text"
                            aria-label="Nombre docente tutor/a"
                        >

                    </span>

                </td>

                <td colspan="2">

                    Fecha de elaboración del plan:

                    <span class="inline-field date-field">

                        <input
                            type="date"
                            aria-label="Fecha de elaboración del plan"
                        >

                    </span>

                </td>

            </tr>

            <tr>

                <td
                    colspan="4"
                    class="diagnostic thick"
                >

                    <strong>
                        Resumen del diagnóstico situacional:
                    </strong>

                    Sintetizar la información que motiva de la atención psicosocial
                    (ficha notificación de alerta; ficha de observación; entrevista)

                    <textarea
                        class="diagnostic-input"
                        aria-label="Resumen del diagnóstico situacional"
                    ></textarea>

                </td>

            </tr>

            <tr class="intervention-row thick">

                <td colspan="4">

                    Tipo o tipos de intervención psicosocial a realizar:

                    <span class="normal check-wrap">

                        <input
                            type="checkbox"
                            aria-label="Intervención individual"
                        >

                        Individual

                    </span>

                    <span class="normal check-wrap">

                        <input
                            type="checkbox"
                            aria-label="Intervención familiar"
                        >

                        Familiar

                    </span>

                    <span class="normal check-wrap">

                        <input
                            type="checkbox"
                            aria-label="Intervención grupal"
                        >

                        Grupal

                    </span>

                </td>

            </tr>

            <tr>

                <td
                    colspan="4"
                    class="actions-title thick"
                >
                    Acciones para implementar para la atención psicosocial
                </td>

            </tr>

            <tr class="actions-head">

                <th class="thick">
                    Acciones para implementar
                </th>

                <th class="thick">
                    Profesional que ejecutará la acción
                </th>

                <th class="thick">
                    Tiempo en que se ejecutará la acción<br>
                    (días/semanas/meses)
                </th>

                <th class="thick">
                    Observaciones
                </th>

            </tr>

            <tbody id="accionesBody">

                <tr class="actions-row dynamic-action-row">

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="accion"
                            aria-label="Acción 1"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="profesional"
                            aria-label="Profesional acción 1"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="tiempo"
                            aria-label="Tiempo acción 1"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="observaciones"
                            aria-label="Observaciones acción 1"
                        ></textarea>
                    </td>

                </tr>

                <tr class="actions-row dynamic-action-row">

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="accion"
                            aria-label="Acción 2"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="profesional"
                            aria-label="Profesional acción 2"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="tiempo"
                            aria-label="Tiempo acción 2"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="observaciones"
                            aria-label="Observaciones acción 2"
                        ></textarea>
                    </td>

                </tr>

                <tr class="actions-row dynamic-action-row">

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="accion"
                            aria-label="Acción 3"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="profesional"
                            aria-label="Profesional acción 3"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="tiempo"
                            aria-label="Tiempo acción 3"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="observaciones"
                            aria-label="Observaciones acción 3"
                        ></textarea>
                    </td>

                </tr>

                <tr class="actions-row dynamic-action-row">

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="accion"
                            aria-label="Acción 4"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="profesional"
                            aria-label="Profesional acción 4"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="tiempo"
                            aria-label="Tiempo acción 4"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="observaciones"
                            aria-label="Observaciones acción 4"
                        ></textarea>
                    </td>

                </tr>

            </tbody>

        </table>



    </div>


    <div class="signature-box">

        <table class="signature-inner">

            <tr>

                <td class="signature-title">

                    Firma profesional del Departamento de Consejería Estudiantil que elabora el plan

                </td>

            </tr>

            <tr>

                <td class="name-row">

                    Nombre profesional DECE:

                    <span
                        class="inline-field"
                        style="width:105mm;"
                    >

                        <input
                            type="text"
                            aria-label="Nombre profesional DECE"
                        >

                    </span>

                </td>

            </tr>

            <tr>

                <td class="confidential">

                    *La información registrada en este documento es confidencial y de uso exclusivo del Departamento de Consejería Estudiantil

                </td>

            </tr>

        </table>

    </div>


    <div class="citation">

        *Ministerio de Educación (2023).

        <i>
            Modelo de Gestión del Departamento de Consejería Estudiantil.
        </i>

        Quito: Ecuador.

    </div>

</section>


<!-- =========================
     PÁGINA 2
     ========================= -->

<section class="page" id="paginaSeguimiento">

    @include('formularios.partials.encabezado-institucional')


    <div class="form-box page2-box">

        <table>

            <colgroup>

                <col style="width:21.5%">
                <col style="width:30.0%">
                <col style="width:12.0%">
                <col style="width:12.0%">
                <col style="width:24.5%">

            </colgroup>

<tr>

                <td
                    colspan="5"
                    class="follow-title thick"
                >
                    SEGUIMIENTO DE LA ATENCIÓN PSICOSOCIAL
                </td>

            </tr>

            <tr>

                <td
                    colspan="5"
                    class="follow-subtitle thick"
                >
                    Acciones implementadas para la atención psicosocial
                </td>

            </tr>

            <tr class="follow-head">

                <th class="thick">

                    Tipo de intervención realizada
                    (individual, familiar o grupal, en crisis)

                </th>

                <th class="thick">

                    Descripción de la atención psicosocial realizada

                </th>

                <th class="thick">

                    Profesional que realiza la atención psicosocial

                </th>

                <th class="thick">

                    Fecha de atención

                </th>

                <th class="thick">

                    Observaciones

                </th>

            </tr>

            <tbody id="seguimientoBody">

                <tr class="follow-row dynamic-follow-row">

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="tipo"
                            aria-label="Seguimiento 1 tipo de intervención"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="descripcion"
                            aria-label="Seguimiento 1 descripción"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="profesional"
                            aria-label="Seguimiento 1 profesional"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="fecha"
                            aria-label="Seguimiento 1 fecha"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="observaciones"
                            aria-label="Seguimiento 1 observaciones"
                        ></textarea>
                    </td>

                </tr>

                <tr class="follow-row dynamic-follow-row">

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="tipo"
                            aria-label="Seguimiento 2 tipo de intervención"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="descripcion"
                            aria-label="Seguimiento 2 descripción"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="profesional"
                            aria-label="Seguimiento 2 profesional"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="fecha"
                            aria-label="Seguimiento 2 fecha"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="observaciones"
                            aria-label="Seguimiento 2 observaciones"
                        ></textarea>
                    </td>

                </tr>

                <tr class="follow-row dynamic-follow-row">

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="tipo"
                            aria-label="Seguimiento 3 tipo de intervención"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="descripcion"
                            aria-label="Seguimiento 3 descripción"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="profesional"
                            aria-label="Seguimiento 3 profesional"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="fecha"
                            aria-label="Seguimiento 3 fecha"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="observaciones"
                            aria-label="Seguimiento 3 observaciones"
                        ></textarea>
                    </td>

                </tr>

                <tr class="follow-row dynamic-follow-row">

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="tipo"
                            aria-label="Seguimiento 4 tipo de intervención"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="descripcion"
                            aria-label="Seguimiento 4 descripción"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="profesional"
                            aria-label="Seguimiento 4 profesional"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="fecha"
                            aria-label="Seguimiento 4 fecha"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="observaciones"
                            aria-label="Seguimiento 4 observaciones"
                        ></textarea>
                    </td>

                </tr>

                <tr class="follow-row dynamic-follow-row">

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="tipo"
                            aria-label="Seguimiento 5 tipo de intervención"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="descripcion"
                            aria-label="Seguimiento 5 descripción"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="profesional"
                            aria-label="Seguimiento 5 profesional"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="fecha"
                            aria-label="Seguimiento 5 fecha"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="observaciones"
                            aria-label="Seguimiento 5 observaciones"
                        ></textarea>
                    </td>

                </tr>

                <tr class="follow-row dynamic-follow-row">

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="tipo"
                            aria-label="Seguimiento 6 tipo de intervención"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="descripcion"
                            aria-label="Seguimiento 6 descripción"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="profesional"
                            aria-label="Seguimiento 6 profesional"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="fecha"
                            aria-label="Seguimiento 6 fecha"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="observaciones"
                            aria-label="Seguimiento 6 observaciones"
                        ></textarea>
                    </td>

                </tr>

                <tr class="follow-row dynamic-follow-row">

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="tipo"
                            aria-label="Seguimiento 7 tipo de intervención"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="descripcion"
                            aria-label="Seguimiento 7 descripción"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="profesional"
                            aria-label="Seguimiento 7 profesional"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="fecha"
                            aria-label="Seguimiento 7 fecha"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="observaciones"
                            aria-label="Seguimiento 7 observaciones"
                        ></textarea>
                    </td>

                </tr>

                <tr class="follow-row dynamic-follow-row">

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="tipo"
                            aria-label="Seguimiento 8 tipo de intervención"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="descripcion"
                            aria-label="Seguimiento 8 descripción"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="profesional"
                            aria-label="Seguimiento 8 profesional"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="fecha"
                            aria-label="Seguimiento 8 fecha"
                        ></textarea>
                    </td>

                    <td>
                        <textarea
                            class="cell-textarea"
                            data-dynamic-field="observaciones"
                            aria-label="Seguimiento 8 observaciones"
                        ></textarea>
                    </td>

                </tr>

            </tbody>

            <tr>

                <td
                    colspan="5"
                    class="follow-confidential thick"
                >

                    *La información registrada en este documento es confidencial y de uso exclusivo del Departamento de Consejería Estudiantil

                </td>

            </tr>

        </table>




    </div>

</section>


</div>


<script>

const CLAVE_BORRADOR =
    "apch_plan_atencion_psicosocial_borrador";

const FILAS_ACCION_INICIALES =
    document.querySelectorAll(
        "#accionesBody .dynamic-action-row"
    ).length;

const FILAS_SEGUIMIENTO_INICIALES =
    document.querySelectorAll(
        "#seguimientoBody .dynamic-follow-row"
    ).length;


function actualizarEstadoGuardado(texto) {

    const textoEstado =
        document.getElementById("textoEstado");

    if (textoEstado) {
        textoEstado.textContent = texto;
    }

}


function obtenerCampos() {

    return document.querySelectorAll(
        ".page input, .page textarea"
    );

}

function restaurarFilasDinamicasIniciales() {
    const grupos = [
        {
            id: "accionesBody",
            selector: ".dynamic-action-row",
            cantidadInicial: FILAS_ACCION_INICIALES
        },
        {
            id: "seguimientoBody",
            selector: ".dynamic-follow-row",
            cantidadInicial: FILAS_SEGUIMIENTO_INICIALES
        }
    ];

    grupos.forEach(grupo => {
        const body = document.getElementById(grupo.id);

        if (!body) {
            return;
        }

        Array.from(body.querySelectorAll(grupo.selector))
            .slice(grupo.cantidadInicial)
            .forEach(fila => fila.remove());
    });
}


function crearFilaAccion(numero) {

    const tr = document.createElement("tr");

    tr.className =
        "actions-row dynamic-action-row";

    tr.innerHTML = `

        <td>
            <textarea
                class="cell-textarea"
                data-dynamic-field="accion"
                aria-label="Acción ${numero}"
            ></textarea>
        </td>

        <td>
            <textarea
                class="cell-textarea"
                data-dynamic-field="profesional"
                aria-label="Profesional acción ${numero}"
            ></textarea>
        </td>

        <td>
            <textarea
                class="cell-textarea"
                data-dynamic-field="tiempo"
                aria-label="Tiempo acción ${numero}"
            ></textarea>
        </td>

        <td>
            <textarea
                class="cell-textarea"
                data-dynamic-field="observaciones"
                aria-label="Observaciones acción ${numero}"
            ></textarea>
        </td>

    `;

    prepararCampoDinamico(tr);

    return tr;

}


function crearFilaSeguimiento(numero) {

    const tr = document.createElement("tr");

    tr.className =
        "follow-row dynamic-follow-row";

    tr.innerHTML = `

        <td>
            <textarea
                class="cell-textarea"
                data-dynamic-field="tipo"
                aria-label="Seguimiento ${numero} tipo de intervención"
            ></textarea>
        </td>

        <td>
            <textarea
                class="cell-textarea"
                data-dynamic-field="descripcion"
                aria-label="Seguimiento ${numero} descripción"
            ></textarea>
        </td>

        <td>
            <textarea
                class="cell-textarea"
                data-dynamic-field="profesional"
                aria-label="Seguimiento ${numero} profesional"
            ></textarea>
        </td>

        <td>
            <textarea
                class="cell-textarea"
                data-dynamic-field="fecha"
                aria-label="Seguimiento ${numero} fecha"
            ></textarea>
        </td>

        <td>
            <textarea
                class="cell-textarea"
                data-dynamic-field="observaciones"
                aria-label="Seguimiento ${numero} observaciones"
            ></textarea>
        </td>

    `;

    prepararCampoDinamico(tr);

    return tr;

}


function agregarFilaAccion() {

    const body =
        document.getElementById("accionesBody");

    if (!body) {
        return;
    }

    const numero =
        body.querySelectorAll(
            ".dynamic-action-row"
        ).length + 1;

    const fila =
        crearFilaAccion(numero);

    body.appendChild(fila);

    actualizarEstadoGuardado(
        "Fila agregada"
    );

    guardarBorrador();

    const campos =
        fila.querySelectorAll("textarea");

    if (campos.length > 0) {
        campos[0].focus();
    }

}


function agregarFilaSeguimiento() {

    const body =
        document.getElementById("seguimientoBody");

    if (!body) {
        return;
    }

    const numero =
        body.querySelectorAll(
            ".dynamic-follow-row"
        ).length + 1;

    const fila =
        crearFilaSeguimiento(numero);

    body.appendChild(fila);

    actualizarEstadoGuardado(
        "Fila agregada"
    );

    guardarBorrador();

    const campos =
        fila.querySelectorAll("textarea");

    if (campos.length > 0) {
        campos[0].focus();
    }

}


function prepararCampoDinamico(fila) {

    const campos =
        fila.querySelectorAll("textarea");

    campos.forEach((campo, indice) => {

        campo.addEventListener(
            "keydown",
            function (evento) {

                if (
                    evento.key === "Enter" &&
                    !evento.shiftKey
                ) {

                    const ultimoCampo =
                        indice === campos.length - 1;

                    const body =
                        fila.parentElement;

                    const ultimaFila =
                        fila === body.lastElementChild;

                    if (
                        ultimoCampo &&
                        ultimaFila
                    ) {

                        evento.preventDefault();

                        if (
                            fila.classList.contains(
                                "dynamic-action-row"
                            )
                        ) {

                            agregarFilaAccion();

                        }

                        else if (
                            fila.classList.contains(
                                "dynamic-follow-row"
                            )
                        ) {

                            agregarFilaSeguimiento();

                        }

                    }

                }

            }
        );

        campo.addEventListener(
            "input",
            guardarBorrador
        );

        campo.addEventListener(
            "change",
            guardarBorrador
        );

    });

}


function prepararFilasDinamicas() {

    const filasAcciones =
        document.querySelectorAll(
            ".dynamic-action-row"
        );

    filasAcciones.forEach(
        fila => prepararCampoDinamico(fila)
    );


    const filasSeguimiento =
        document.querySelectorAll(
            ".dynamic-follow-row"
        );

    filasSeguimiento.forEach(
        fila => prepararCampoDinamico(fila)
    );

}


function obtenerDatosFilas() {

    const datos = {

        acciones: [],

        seguimiento: []

    };


    const filasAcciones =
        document.querySelectorAll(
            ".dynamic-action-row"
        );

    filasAcciones.forEach(fila => {

        const campos =
            fila.querySelectorAll(
                "textarea"
            );

        datos.acciones.push(
            Array.from(campos).map(
                campo => campo.value
            )
        );

    });


    const filasSeguimiento =
        document.querySelectorAll(
            ".dynamic-follow-row"
        );

    filasSeguimiento.forEach(fila => {

        const campos =
            fila.querySelectorAll(
                "textarea"
            );

        datos.seguimiento.push(
            Array.from(campos).map(
                campo => campo.value
            )
        );

    });


    return datos;

}


function guardarBorrador() {

    const campos =
        obtenerCampos();

    const datos = {};


    campos.forEach((campo, index) => {

        if (
            campo.closest(
                ".dynamic-action-row, .dynamic-follow-row"
            )
        ) {
            return;
        }


        if (campo.type === "checkbox") {

            datos[index] = {

                tipo: "checkbox",

                valor: campo.checked

            };

        }

        else {

            datos[index] = {

                tipo: "texto",

                valor: campo.value

            };

        }

    });


    const datosFilas =
        obtenerDatosFilas();


    const borrador = {

        campos: datos,

        filas: datosFilas

    };


    localStorage.setItem(
        CLAVE_BORRADOR,
        JSON.stringify(borrador)
    );


    actualizarEstadoGuardado(
        "Guardado"
    );

}


function cargarFilasDinamicas(datos) {

    if (!datos) {
        return;
    }


    const acciones =
        datos.acciones || [];

    const accionesBody =
        document.getElementById(
            "accionesBody"
        );


    if (accionesBody && acciones.length > 0) {

        const filasExistentes =
            accionesBody.querySelectorAll(
                ".dynamic-action-row"
            );


        for (
            let i = filasExistentes.length;
            i < acciones.length;
            i++
        ) {

            accionesBody.appendChild(
                crearFilaAccion(i + 1)
            );

        }


        const filas =
            accionesBody.querySelectorAll(
                ".dynamic-action-row"
            );


        filas.forEach(
            (fila, indice) => {

                if (!acciones[indice]) {
                    return;
                }

                const campos =
                    fila.querySelectorAll(
                        "textarea"
                    );

                campos.forEach(
                    (campo, posicion) => {

                        campo.value =
                            acciones[indice][posicion]
                            || "";

                    }
                );

            }
        );

    }


    const seguimiento =
        datos.seguimiento || [];

    const seguimientoBody =
        document.getElementById(
            "seguimientoBody"
        );


    if (
        seguimientoBody &&
        seguimiento.length > 0
    ) {

        const filasExistentes =
            seguimientoBody.querySelectorAll(
                ".dynamic-follow-row"
            );


        for (
            let i = filasExistentes.length;
            i < seguimiento.length;
            i++
        ) {

            seguimientoBody.appendChild(
                crearFilaSeguimiento(i + 1)
            );

        }


        const filas =
            seguimientoBody.querySelectorAll(
                ".dynamic-follow-row"
            );


        filas.forEach(
            (fila, indice) => {

                if (!seguimiento[indice]) {
                    return;
                }

                const campos =
                    fila.querySelectorAll(
                        "textarea"
                    );

                campos.forEach(
                    (campo, posicion) => {

                        campo.value =
                            seguimiento[indice][posicion]
                            || "";

                    }
                );

            }
        );

    }

}


function cargarBorrador() {

    if (window.formularioEnEdicion) {
        return;
    }

    const borrador =
        localStorage.getItem(
            CLAVE_BORRADOR
        );


    if (!borrador) {

        actualizarEstadoGuardado(
            "Sin datos guardados"
        );

        return;

    }


    try {

        const datos =
            JSON.parse(borrador);


        if (
            datos &&
            datos.campos
        ) {

            const campos =
                obtenerCampos();


            campos.forEach(
                (campo, index) => {

                    if (
                        campo.closest(
                            ".dynamic-action-row, .dynamic-follow-row"
                        )
                    ) {
                        return;
                    }


                    if (
                        !datos.campos[index]
                    ) {
                        return;
                    }


                    if (
                        campo.type === "checkbox"
                    ) {

                        campo.checked =
                            datos.campos[index].valor;

                    }

                    else {

                        campo.value =
                            datos.campos[index].valor
                            || "";

                    }

                }
            );


            cargarFilasDinamicas(
                datos.filas
            );

        }

        else {

            const campos =
                obtenerCampos();


            campos.forEach(
                (campo, index) => {

                    if (
                        !datos[index]
                    ) {
                        return;
                    }


                    if (
                        campo.type === "checkbox"
                    ) {

                        campo.checked =
                            datos[index].valor;

                    }

                    else {

                        campo.value =
                            datos[index].valor
                            || "";

                    }

                }
            );

        }


        actualizarEstadoGuardado(
            "Borrador cargado"
        );


    }

    catch (error) {

        console.error(
            "Error al cargar el borrador:",
            error
        );


        actualizarEstadoGuardado(
            "Error al cargar"
        );

    }

}


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
    restaurarFilasDinamicasIniciales();

    const campos = obtenerCampos();

    campos.forEach((campo) => {

        if (campo.type === 'radio' || campo.type === 'checkbox') {

            campo.checked = false;

        } else {

            campo.value = '';

        }

    });

    guardarBorrador();

    actualizarEstadoGuardado(
        "Formulario restablecido"
    );

    cerrarModalBorrarTodo();
}





function volver() {

    window.history.back();

}


function guardarEImprimir() {

    guardarBorrador();

    const campos = obtenerCampos();

    const datos = {};

    campos.forEach((campo, index) => {

        if (
            campo.closest(
                ".dynamic-action-row, .dynamic-follow-row"
            )
        ) {
            return;
        }

        if (campo.type === "checkbox") {

            datos[index] = {
                tipo: "checkbox",
                valor: campo.checked
            };

        } else {

            datos[index] = {
                tipo: "texto",
                valor: campo.value
            };

        }

    });

    const datosFilas = obtenerDatosFilas();

    const datosFormulario = {

        campos: datos,

        filas: datosFilas

    };

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
                    'PLAN DE ATENCIÓN PSICOSOCIAL Y SEGUIMIENTO',

                carpeta: document.getElementById('carpetaDestino')?.value || null,
                datos: datosFormulario

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


const ZOOM_MINIMO = 0.80;

const ZOOM_MAXIMO = 1.70;

const ZOOM_PASO = 0.10;

let zoomActual = 1;


function aplicarZoom() {

    document.documentElement.style.setProperty(
        "--zoom-documento",
        zoomActual
    );


    const zoomLabel =
        document.getElementById(
            "zoomLabel"
        );


    if (zoomLabel) {

        zoomLabel.textContent =
            Math.round(
                zoomActual * 100
            ) + "%";

    }

}


function calcularZoomAutomatico() {

    const anchoDisponible =
        window.innerWidth - 80;


    const anchoA4 =
        793.7;


    let zoomCalculado =
        (anchoDisponible * 0.92)
        /
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

    zoomActual +=
        ZOOM_PASO;


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

    zoomActual -=
        ZOOM_PASO;


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


document.addEventListener(
    "DOMContentLoaded",
    function () {

        cargarBorrador();

        prepararFilasDinamicas();


        const campos =
            document.querySelectorAll(
                ".page input, .page textarea"
            );


        campos.forEach(campo => {

            if (
                campo.closest(
                    ".dynamic-action-row, .dynamic-follow-row"
                )
            ) {
                return;
            }


            campo.addEventListener(
                "input",
                guardarBorrador
            );


            campo.addEventListener(
                "change",
                guardarBorrador
            );

        });


        calcularZoomAutomatico();

    }
);


window.addEventListener(
    "resize",
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
</body>
</html>
