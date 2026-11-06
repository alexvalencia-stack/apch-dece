<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Entrevista Semiestructurada para Representante</title>
<style>
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
        background: #e6e6e6;
        font-family: "Times New Roman", Times, serif;
    }
    .page,
    .page input,
    .page textarea,
    .page select {
        font-family: "Times New Roman", Times, serif;
    }
    /* =========================================================
       BARRA DE HERRAMIENTAS
       ========================================================= */
    .toolbar {
        position: sticky;
        top: 0;
        z-index: 1000;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        padding: 12px 18px;
        background: rgba(255, 255, 255, 0.97);
        border-bottom: 1px solid #d5d5d5;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.10);
        font-family: Arial, Helvetica, sans-serif;
    }
    .toolbar-group {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .toolbar button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 38px;
        padding: 8px 15px;
        border: none;
        border-radius: 8px;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        white-space: nowrap;
    }
    .toolbar button:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.14);
    }
    .toolbar button:active {
        transform: translateY(0);
        box-shadow: none;
    }
    .btn-volver {
        background: #eeeeee;
        color: #333333;
    }
    .btn-volver:hover {
        background: #e2e2e2;
    }
    .btn-borrar {
        background: #fff0f0;
        color: #b00020;
        border: 1px solid #f1c4c4 !important;
    }
    .btn-borrar:hover {
        background: #ffe2e2;
    }
    .btn-guardar {
        background: #eeeeee;
        color: #333333;
    }
    .btn-guardar:hover {
        background: #e2e2e2;
    }
    .btn-imprimir {
        background: #b5121b;
        color: white;
    }
    .btn-imprimir:hover {
        background: #930e16;
    }
    .btn-zoom {
        width: 38px;
        padding: 8px !important;
        background: #eeeeee;
        color: #333333;
        font-size: 18px !important;
    }
    .btn-reset {
        min-width: 58px;
        padding: 8px 10px !important;
        background: #eeeeee;
        color: #333333;
        font-size: 12px !important;
    }
    .zoom-control {
        display: flex;
        align-items: center;
        gap: 4px;
        padding: 3px;
        border-radius: 9px;
        background: #f4f4f4;
        border: 1px solid #dddddd;
    }
    .zoom-label {
        min-width: 48px;
        text-align: center;
        font-size: 12px;
        font-weight: 600;
        color: #555;
        font-family: Arial, Helvetica, sans-serif;
    }
    .estado-guardado {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        min-height: 30px;
        padding: 5px 10px;
        border-radius: 20px;
        background: #f1f8f3;
        color: #287a3d;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        font-weight: 600;
    }
    .estado-punto {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #38a852;
    }
    /* =========================================================
       DOCUMENTO
       ========================================================= */
    .documento {
        width: 100%;
        overflow-x: auto;
        overflow-y: visible;
        padding: 25px 20px 40px;
    }
    .page {
        width: 210mm;
        min-height: 297mm;
        margin: 0 auto;
        background: #ffffff;
        padding: 7mm 13mm 6mm 13mm;
        position: relative;
        font-size: 9.3px;
        box-shadow: 0 2px 14px rgba(0, 0, 0, 0.18);
        zoom: var(--zoom-documento, 1);
        transform-origin: top center;
        margin-bottom: 25px;
    }
    .page:last-child {
        margin-bottom: 0;
    }
    /* ===== ENCABEZADO ===== */
    input[type="checkbox"] {
        appearance: none;
        -webkit-appearance: none;
        width: 11px;
        height: 11px;
        position: relative;
        vertical-align: middle;
        margin: 0 4px;
        padding: 0;
        border: 1px solid #000;
        background: #fff;
        cursor: pointer;
    }
    input[type="checkbox"]::after {
        content: "";
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 10px;
        font-weight: bold;
        line-height: 9px;
        color: #000;
    }
    input[type="checkbox"]:checked::after {
        content: "X";
    }
    .header {
        display: table;
        width: 100%;
    }
    .header-logo {
        display: table-cell;
        width: 90px;
        vertical-align: middle;
    }
    .header-logo img {
        width: 78px;
        position: relative;
        left: 150px;
    }
    .header-text {
        display: table-cell;
        vertical-align: middle;
        text-align: center;
    }
    .header-text .l1,
    .header-text .l2 {
        font-size: 16px;
        line-height: 1.1;
    }
    .header-text .l3 {
        font-size: 12px;
        line-height: 1.2;
        margin-top: 1px;
    }
    .header-text .l4 {
        font-size: 10.5px;
        font-weight: bold;
        line-height: 1.2;
    }
    .header-rule {
        border: none;
        border-top: 3px solid #000;
        margin: 3px 0 6px 0;
    }
    .form-title {
        text-align: center;
        font-style: italic;
        font-weight: bold;
        font-size: 12px;
        margin-bottom: 1px;
    }
    .form-subtitle {
        text-align: center;
        font-weight: bold;
        font-size: 10px;
        margin-bottom: 4px;
    }
    /* ===== TABLA SUPERIOR ===== */
    table.datos {
        width: 100%;
        border-collapse: collapse;
        border: 1.5px solid #000;
        font-size: 9.3px;
        margin-bottom: 3px;
    }
    table.datos td {
        border: 1px solid #000;
        padding: 1.5px 5px;
        vertical-align: middle;
    }
    .fill-inline {
        font-family: "Times New Roman", Times, serif;
        font-size: 9.3px;
        border: none;
        border-bottom: none;
        background: transparent;
        outline: none;
    }
    .hermanos-row {
        padding-top: 2px;
    }
    .hermanos-line {
        display: block;
        margin-top: 2px;
    }
    .hermanos-line span {
        display: inline-block;
        width: 14px;
    }
    /* ===== ALERTA / ENTREVISTADO ===== */
    .alerta-block {
        text-align: center;
        font-size: 9.3px;
        margin: 3px 0;
        line-height: 1.5;
    }
    /* ===== SECCIONES ===== */
    .seccion {
        margin-top: 3px;
        font-size: 9.3px;
        line-height: 1.22;
    }
    .seccion-header {
        display: table;
        width: 100%;
    }
    .seccion-letra {
        display: table-cell;
        width: 30px;
        font-weight: bold;
        font-style: italic;
        vertical-align: top;
        padding-left: 10px;
        white-space: nowrap;
    }
    .seccion-cuerpo {
        display: table-cell;
        vertical-align: top;
    }
    .seccion-titulo {
        font-weight: bold;
        font-style: italic;
        margin-right: 3px;
    }
    /* ===== PREGUNTAS ===== */
    .pregunta {
        font-size: 9.3px;
        line-height: 1.22;
        margin-top: 2px;
    }
    .fill-full {
        display: block;
        width: 100%;
        font-family: "Times New Roman", Times, serif;
        font-size: 9.3px;
        border: none;
        border-bottom: none;
        background: transparent;
        outline: none;
        margin-top: 0px;
        margin-bottom: 1px;
    }
    /* ===== TABLAS DE ANTECEDENTES ===== */
    .subtitulo {
        font-weight: bold;
        font-style: italic;
        margin-top: 3px;
        margin-bottom: 1px;
    }
    .subtitulo-centro {
        text-align: center;
        font-weight: bold;
        font-size: 10px;
        margin: 2px 0 2px 0;
    }
    .nota-fuente {
        text-align: right;
        font-style: italic;
        font-size: 8px;
        margin-bottom: 2px;
    }
    table.antecedentes {
        width: 100%;
        border-collapse: collapse;
        border: 1.5px solid #000;
        font-size: 8.7px;
        margin-bottom: 2px;
        text-align: center;
    }
    table.antecedentes th,
    table.antecedentes td {
        border: 1px solid #000;
        padding: 1px 4px;
        line-height: 1.15;
    }
    table.antecedentes td.izq {
        text-align: left;
    }
    table.simple-box {
        width: 100%;
        border-collapse: collapse;
        border: 1.5px solid #000;
        font-size: 8.7px;
        margin-bottom: 2px;
    }
    table.simple-box td {
        padding: 2px 5px;
        text-align: left;
    }
    .vivienda-wrap {
        display: table;
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 2px;
    }
    .vivienda-col {
        display: table-cell;
        vertical-align: top;
        padding-right: 4px;
    }
    table.vivienda {
        width: 100%;
        border-collapse: collapse;
        border: 1.5px solid #000;
        font-size: 8.5px;
    }
    table.vivienda td {
        border: 1px solid #000;
        padding: 0.5px 4px;
        line-height: 1.1;
    }
    table.vivienda td.chk {
        width: 16px;
        text-align: center;
    }
    .chk-inline {
        display: inline-block;
        width: 12px;
        height: 10px;
        border: 1px solid #000;
        margin-left: 4px;
        vertical-align: middle;
    }
    table.discapacidad {
        width: 100%;
        border-collapse: collapse;
        border: 1.5px solid #000;
        font-size: 8.7px;
        margin-bottom: 2px;
    }
    table.discapacidad td {
        border: 1px solid #000;
        padding: 1px 5px;
        vertical-align: top;
        line-height: 1.25;
    }
    table.discapacidad td.label-col {
        width: 22%;
        text-align: center;
        vertical-align: middle;
    }
    table.discapacidad td.si-no {
        width: 5%;
        text-align: center;
        font-weight: bold;
    }
    .linea-box {
        border: 1.5px solid #000;
        font-size: 8.7px;
        padding: 1px 6px;
        margin-bottom: 2px;
        line-height: 1.3;
    }
    .problemas-row {
        display: block;
    }
    .fill-dots {
        border-bottom: none;
        display: inline-block;
        min-width: 40px;
    }
    /* ===== PIE ===== */
    .fuente {
        font-size: 8.5px;
        margin-top: 4px;
    }
    .fuente i {
        font-style: italic;
    }
    .profesional-fecha {
        display: table;
        width: 100%;
        margin-top: 3px;
        font-size: 9px;
        font-style: italic;
    }
    .profesional {
        display: table-cell;
        width: 65%;
    }
    .profesional input {
        font-family: "Times New Roman", Times, serif;
        font-style: italic;
        font-size: 9px;
        border: none;
        border-bottom: none;
        background: transparent;
        outline: none;
        width: 260px;
        margin-left: 4px;
    }
    .fecha2 {
        display: table-cell;
        width: 35%;
        text-align: right;
    }
    .fecha2 input {
        font-family: "Times New Roman", Times, serif;
        font-style: italic;
        font-size: 9px;
        border: none;
        border-bottom: none;
        background: transparent;
        outline: none;
        width: 26px;
        text-align: center;
    }
    /* =========================================================
       RESPONSIVE
       ========================================================= */
    @media screen and (max-width: 800px) {
        .toolbar {
            justify-content: flex-start;
            overflow-x: auto;
            flex-wrap: nowrap;
            padding: 10px;
        }
        .toolbar button {
            flex-shrink: 0;
        }
        .estado-guardado {
            display: none;
        }
        .documento {
            padding: 15px 10px 30px;
        }
    }
    /* =========================================================
       IMPRESIÓN
       ========================================================= */
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
            width: auto;
            min-height: auto;
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
.page,
.page * {
    font-family: "Times New Roman", Times, serif !important;
}

@include('formularios.partials.encabezado-institucional-estilos')
@include('formularios.partials.toolbar-moderno')
</style>
</head>
<body>
<!-- =========================================================
     BARRA DE HERRAMIENTAS
     ========================================================= -->
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
            title="Reducir tamaño"
        >
            −
        </button>
        <span class="zoom-label" id="zoomLabel">
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
            title="Restablecer zoom"
        >
            Ajustar
        </button>
    </div>
    <button type="button" class="btn-imprimir" onclick="guardarEImprimir()">
        🖨 Guardar e imprimir
    </button>
    <button
        type="button"
        class="btn-volver btn-ver-formularios"
        onclick="window.location.href='{{ route('formularios.mis-documentos', ['tipo' => 'entrevista-representantes']) }}'"
    >
        📂 Mis formularios
    </button>
    <div class="estado-guardado" id="estadoGuardado">
        <span class="estado-punto"></span>
        <span id="textoEstado">Guardado</span>
    </div>
</div>
<!-- =========================================================
     DOCUMENTO
     ========================================================= -->
<div class="documento">
<!-- ==================== PÁGINA 1 ==================== -->
<div class="page">
    @include('formularios.partials.encabezado-institucional')
    <div class="form-title">
        ENTREVISTA SEMIESTRUCTURADA PARA REPRESENTANTE
    </div>
    <div class="form-subtitle">
        AÑO LECTIVO 2026-2027
    </div>
    <table class="datos">
        <tr>
            <td style="width:60%;">
                Apellidos y nombres de el/la estudiante:
                <input type="text" class="fill-inline" style="width:55%;">
            </td>
            <td style="width:40%;">
                Cédula de ciudadanía:
                <input type="text" class="fill-inline" style="width:55%;">
            </td>
        </tr>
        <tr>
            <td>
                Año/paralelo:
                <input type="text" class="fill-inline" style="width:60%;">
            </td>
            <td>
                Docente tutor/a:
                <input type="text" class="fill-inline" style="width:60%;">
            </td>
        </tr>
        <tr>
            <td>
                Lugar y fecha de nacimiento:
                <input type="text" class="fill-inline" style="width:45%;">
            </td>
            <td>
                Edad:
                <input type="text" class="fill-inline" style="width:70%;">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Lugar donde vive:
                <input type="text" class="fill-inline" style="width:80%;">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Referencia:
                <input type="text" class="fill-inline" style="width:85%;">
            </td>
        </tr>
        <tr>
            <td>
                Representante legal en la institución:
                <input type="text" class="fill-inline" style="width:35%;">
            </td>
            <td>
                Parentesco:
                <input type="text" class="fill-inline" style="width:28%;">
                CC:
                <input type="text" class="fill-inline" style="width:28%;">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Teléfonos:
                <input type="text" class="fill-inline" style="width:85%;">
            </td>
        </tr>
        <tr>
            <td colspan="2" class="hermanos-row">
                Apellidos y nombres de hermanos/as que estudien en la institución - Año/paralelo:
                <span class="hermanos-line">
                    a.
                    <input type="text" class="fill-inline" style="width:26%;">
                       b.
                    <input type="text" class="fill-inline" style="width:26%;">
                       c.
                    <input type="text" class="fill-inline" style="width:26%;">
                </span>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="hermanos-row">
                Apellidos y nombres de otros familiares que estudien en la institución - Año/paralelo:
                <span class="hermanos-line">
                    a.
                    <input type="text" class="fill-inline" style="width:26%;">
                       b.
                    <input type="text" class="fill-inline" style="width:26%;">
                       c.
                    <input type="text" class="fill-inline" style="width:26%;">
                </span>
            </td>
        </tr>
    </table>
    <div class="alerta-block">
        Identificación de la alerta:
        Iniciativa propia
        <input type="checkbox">

        Derivación de otro miembro de la comunidad educativa
        <input type="checkbox">
        <br>
        Nombre del entrevistado/a:
        <input type="text" class="fill-inline" style="width:30%;">

        Parentesco:
        <input type="text" class="fill-inline" style="width:18%;">
    </div>
    <!-- SECCIÓN A -->
    <div class="seccion">
        <div class="seccion-header">
            <div class="seccion-letra">
                A.
            </div>
            <div class="seccion-cuerpo">
                <span class="seccion-titulo">
                    MOTIVO.-
                </span>
                <span>
                    Preguntas relacionadas a identificar la perspectiva de él o la representante sobre la alerta o el requerimiento de atención psicosocial para él o la estudiante.
                </span>
            </div>
        </div>
        <div class="pregunta">
            ¿Conoce el motivo de haberle convocado al Departamento de Consejería Estudiantil? o ¿Cuál es el motivo por el cual acude al Departamento de Consejería Estudiantil?
        </div>
        <input type="text" class="fill-full">
        <input type="text" class="fill-full">
        <div class="pregunta">
            ¿Cuáles cree que son las causas de esas dificultades?
        </div>
        <input type="text" class="fill-full">
        <div class="pregunta">
            ¿Cómo se siente con lo que está sucediendo?
        </div>
        <input type="text" class="fill-full">
        <div class="pregunta">
            ¿Ha tratado de solucionar el problema? ¿Cómo?
        </div>
        <input type="text" class="fill-full">
    </div>
    <!-- SECCIÓN B -->
    <div class="seccion">
        <div class="seccion-header">
            <div class="seccion-letra">
                B.
            </div>
            <div class="seccion-cuerpo">
                <span class="seccion-titulo">
                    ADAPTACIÓN EN EL CONTEXTO EDUCATIVO.-
                </span>
                <span>
                    Preguntas para conocer la perspectiva de el o la representante sobre la adaptación de el o la estudiante en su institución educativa y el tipo de relaciones que mantiene con los miembros de la comunidad educativa.
                </span>
            </div>
        </div>
        <div class="pregunta">
            ¿Cómo cree que su representado/a se siente en la institución educativa?
        </div>
        <input type="text" class="fill-full">
        <div class="pregunta">
            ¿Cómo se siente su representado/a con sus compañeros/as de aula?
        </div>
        <input type="text" class="fill-full">
        <div class="pregunta">
            ¿Hay alguna/s materia/s que le genere preocupación a su representado/a? ¿Qué le preocupa?
        </div>
        <input type="text" class="fill-full">
        <div class="pregunta">
            ¿Cómo considera que es el apoyo que recibe su representado/a de su docente tutor/a?
        </div>
        <input type="text" class="fill-full">
        <div class="pregunta">
            ¿Cómo considera que es el apoyo que recibe su representado/a de sus docentes de área?
        </div>
        <input type="text" class="fill-full">
        <div class="pregunta">
            ¿Cómo considera que es el apoyo que recibe su representado/a de las autoridades de su institución?
        </div>
        <input type="text" class="fill-full">
        <div class="pregunta">
            ¿Cómo siente que es la relación entre usted como representante con docentes, autoridades, personal DECE, con otros representantes y/o con otros miembros de la comunidad educativa?
        </div>
        <input type="text" class="fill-full">
        <div class="pregunta">
            ¿Usted sabe si su representado/a tiene amigos/as? ¿Qué hacen cuando están juntos/as? ¿Conoce quiénes son sus amigos/as?
        </div>
        <input type="text" class="fill-full">
    </div>
    <!-- SECCIÓN C -->
    <div class="seccion">
        <div class="seccion-header">
            <div class="seccion-letra">
                C.
            </div>
            <div class="seccion-cuerpo">
                <span class="seccion-titulo">
                    RELACIONES FAMILIARES.-
                </span>
                <span>
                    Permite conocer la perspectiva de los/as representantes sobre cómo está organizada la familia y el tipo de relaciones que se han construido entre los miembros que la conforman.
                </span>
            </div>
        </div>
        <div class="pregunta">
            ¿Cómo considera que su representado/a se siente en su hogar?
        </div>
        <input type="text" class="fill-full">
        <div class="pregunta">
            ¿Quiénes conforman su hogar?
        </div>
        <input type="text" class="fill-full">
        <div class="pregunta">
            ¿Cuánto tiempo comparten en familia? ¿Qué hacen? (entre semana, fines de semana, feriados, vacaciones)
        </div>
        <input type="text" class="fill-full">
        <div class="pregunta">
            ¿Tal vez su representado/a ha cambiado de actitud? ¿En qué ha cambiado? ¿Desde cuándo? ¿Sabe si existe alguna razón para el cambio de actitud?
        </div>
        <input type="text" class="fill-full">
        <input type="text" class="fill-full">
        <div class="pregunta">
            ¿Cómo se relacionan entre los integrantes de su familia?
        </div>
        <input type="text" class="fill-full">
        <div class="pregunta">
            ¿Asiste el/la representante a las convocatorias que realizan docentes, autoridades, personal del Departamento de Consejería Estudiantil? ¿Con qué frecuencia?
        </div>
        <input type="text" class="fill-full">
        <div class="pregunta">
            ¿Tal vez ha observado alguna conducta o situación que pueda poner en riesgo a su representado/a?
        </div>
        <input type="text" class="fill-full">
    </div>
    <div class="pregunta">
        ¿Qué reglas usan en casa para mantener la disciplina?
    </div>
    <input type="text" class="fill-full">
    <!-- SECCIÓN D -->
    <div class="seccion">
        <div class="seccion-header">
            <div class="seccion-letra">
                D.
            </div>
            <div class="seccion-cuerpo">
                <span class="seccion-titulo">
                    OTROS ASPECTOS
                </span>
            </div>
        </div>
        <div class="pregunta">
            ¿Cuáles son los pasatiempos o actividades que más le gusta hacer a su representado/a en el tiempo libre?
        </div>
        <input type="text" class="fill-full">
        <div class="pregunta">
            ¿Qué aspectos usted destacaría de su representado/a? (habilidades, valores, saberes, etc.)
        </div>
        <input type="text" class="fill-full">
    </div>
</div>
<!-- ==================== PÁGINA 2 ==================== -->
<div class="page">
    <!-- SECCIÓN E -->
    <div class="seccion">
        <div class="seccion-header">
            <div class="seccion-letra">
                E.
            </div>
            <div class="seccion-cuerpo">
                <span class="seccion-titulo">
                    COMENTARIOS ADICIONALES U OBSERVACIONES
                </span>
            </div>
        </div>
    </div>
    <div class="nota-fuente">
        * “Se pueden añadir otras preguntas que sean adecuadas, oportunas al caso” (Ministerio de Educación, 2023)
    </div>
    <div class="subtitulo">
        Afectividad y hábitos
    </div>
    <div class="pregunta">
        Preocupaciones y miedos
        <input type="text" class="fill-inline" style="width:80%;">
    </div>
    <div class="pregunta">
        Hábitos de sueño
        <input type="text" class="fill-inline" style="width:83%;">
    </div>
    <div class="pregunta">
        Hábitos alimenticios
        <input type="text" class="fill-inline" style="width:81%;">
    </div>
    <div class="pregunta">
        Hábitos de aseo
        <input type="text" class="fill-inline" style="width:85%;">
    </div>
    <div class="pregunta">
        Actividades escolares
        <input type="text" class="fill-inline" style="width:82%;">
    </div>
    <div class="subtitulo">
        Antecedentes familiares
    </div>
    <table class="antecedentes">
        <tr>
            <th style="width:10%;">Progenitores</th>
            <th style="width:24%;">Nombres y apellidos</th>
            <th style="width:14%;">Tipo de relación con el estudiante</th>
            <th style="width:7%;">Edad</th>
            <th style="width:9%;">Estado civil</th>
            <th style="width:12%;">Instrucción</th>
            <th style="width:14%;">Profesión u ocupación</th>
            <th style="width:10%;">Lugar de trabajo</th>
        </tr>
        <tr>
            <td>Madre</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Padre</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <table class="simple-box">
        <tr>
            <td style="width:22%;">
                Número de hermanos:
            </td>
            <td style="width:22%;">
                H:
                <input type="text" class="fill-inline" style="width:60%;">
            </td>
            <td style="width:22%;">
                M:
                <input type="text" class="fill-inline" style="width:60%;">
            </td>
            <td style="width:34%;">
                Lugar que ocupa:
                <input type="text" class="fill-inline" style="width:50%;">
            </td>
        </tr>
    </table>
    <table class="simple-box">
        <tr>
            <td style="width:14%;">
                Tipo de familia:
            </td>
            <td style="width:22%;">
                Nuclear <input type="checkbox">
            </td>
            <td style="width:22%;">
                Monoparental <input type="checkbox">
            </td>
            <td style="width:20%;">
                Ensamblada <input type="checkbox">
            </td>
            <td style="width:22%;">
                Acogedora <input type="checkbox">
            </td>
        </tr>
    </table>
    <table class="simple-box">
        <tr>
            <td style="width:35%;">
                Personas con quien vive el/la estudiante
            </td>
            <td style="width:32%;">
                Madre <input type="checkbox">
            </td>
            <td style="width:33%;">
                Padre <input type="checkbox">
            </td>
        </tr>
    </table>
    <table class="antecedentes">
        <tr>
            <th style="width:24%;">
                Nombres y apellidos
            </th>
            <th style="width:12%;">
                Parentesco
            </th>
            <th style="width:7%;">
                Edad
            </th>
            <th style="width:9%;">
                Estado civil
            </th>
            <th style="width:14%;">
                Instrucción
            </th>
            <th style="width:17%;">
                Profesión u ocupación
            </th>
            <th style="width:17%;">
                Lugar de trabajo/estudios
            </th>
        </tr>
        <tr>
            <td> </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td> </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td> </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td> </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <div class="linea-box">
        Familiares con discapacidad

        Si <input type="checkbox">

        Tipo:
        Física <input type="checkbox">

        Intelectual <input type="checkbox">

        Auditiva <input type="checkbox">

        Visual <input type="checkbox">

        Lenguaje <input type="checkbox">

        Multidiscapacidad <input type="checkbox">
        <br>

        Porcentaje:
        <input type="text" class="fill-inline" style="width:22%;">

        Parentesco:
        <input type="text" class="fill-inline" style="width:22%;">
        <br>

        No <input type="checkbox">
    </div>
    <div class="subtitulo">
        Antecedentes Sociales
    </div>
    <div class="subtitulo-centro">
        Ingresos/ egresos de los miembros de la familia
    </div>
    <table class="simple-box">
        <tr>
            <td style="width:30%;">
                Total ingresos:
                <input type="text" class="fill-inline" style="width:55%;">
            </td>
            <td style="width:30%;">
                Total egresos:
                <input type="text" class="fill-inline" style="width:55%;">
            </td>
            <td style="width:40%;">
                Observaciones:
                <input type="text" class="fill-inline" style="width:55%;">
            </td>
        </tr>
    </table>
    <div class="subtitulo-centro" style="font-size:9.5px;">
        1.1. Condiciones y servicios de vivienda
    </div>
    <div class="vivienda-wrap">
        <div class="vivienda-col" style="width:20%;">
            <table class="vivienda">
                <tr>
                    <td>Casa</td>
                    <td class="chk">
                        <input type="checkbox">
                    </td>
                </tr>
                <tr>
                    <td>Departamento</td>
                    <td class="chk">
                        <input type="checkbox">
                    </td>
                </tr>
                <tr>
                    <td>Cuarto</td>
                    <td class="chk">
                        <input type="checkbox">
                    </td>
                </tr>
            </table>
        </div>
        <div class="vivienda-col" style="width:28%;">
            <table class="vivienda">
                <tr>
                    <td>Propia</td>
                    <td class="chk">
                        <input type="checkbox">
                    </td>
                    <td>Arrendada</td>
                    <td class="chk">
                        <input type="checkbox">
                    </td>
                </tr>
                <tr>
                    <td>Con préstamo</td>
                    <td class="chk">
                        <input type="checkbox">
                    </td>
                    <td rowspan="2">Anticresis</td>
                    <td rowspan="2" class="chk">
                        <input type="checkbox">
                    </td>
                </tr>
                <tr>
                    <td>Familiar</td>
                    <td class="chk">
                        <input type="checkbox">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Prestada</td>
                    <td class="chk" colspan="2">
                        <input type="checkbox">
                    </td>
                </tr>
            </table>
        </div>
        <div class="vivienda-col" style="width:32%;">
            <table class="vivienda">
                <tr>
                    <td>Luz eléctrica</td>
                    <td class="chk">
                        <input type="checkbox">
                    </td>
                    <td>Teléfono</td>
                    <td class="chk">
                        <input type="checkbox">
                    </td>
                </tr>
                <tr>
                    <td>Agua potable</td>
                    <td class="chk">
                        <input type="checkbox">
                    </td>
                    <td>Celular</td>
                    <td class="chk">
                        <input type="checkbox">
                    </td>
                </tr>
                <tr>
                    <td>Alcantarillado</td>
                    <td class="chk">
                        <input type="checkbox">
                    </td>
                    <td>Computadora/Internet</td>
                    <td class="chk">
                        <input type="checkbox">
                    </td>
                </tr>
            </table>
        </div>
        <div class="vivienda-col" style="width:20%;">
            <table class="vivienda">
                <tr>
                    <td>Espacios privados</td>
                    <td class="chk">
                        <input type="checkbox">
                    </td>
                </tr>
                <tr>
                    <td>Espacios compartidos</td>
                    <td class="chk">
                        <input type="checkbox">
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="subtitulo">
        Antecedentes de salud personales
    </div>
    <div class="subtitulo-centro" style="font-size:9.5px;">
        Embarazo y parto
    </div>
    <table class="antecedentes">
        <tr>
            <th style="width:12%;">
                Edad madre
            </th>
            <th style="width:16%;">
                Controles médicos
            </th>
            <th style="width:34%;">
                Problemas físicos y/o emocionales en el embarazo
            </th>
            <th colspan="1" style="width:38%;">
                Parto
            </th>
        </tr>
        <tr>
            <td>
                <input type="text" class="fill-inline" style="width:70%;">
            </td>
            <td>
                SI <input type="checkbox">
                NO <input type="checkbox">
            </td>
            <td></td>
            <td>
                A término <input type="checkbox">
                Prematuro <input type="checkbox">
                Normal <input type="checkbox">
                Cesárea <input type="checkbox">
            </td>
        </tr>
    </table>
    <div class="subtitulo-centro" style="font-size:9.5px;">
        Datos del niño/a recién nacido/a
    </div>
    <table class="antecedentes">
        <tr>
            <th>Peso al nacer</th>
            <th>Talla al nacer</th>
            <th>Primeros pasos</th>
            <th>Primeras palabras</th>
            <th>Lactancia materna</th>
            <th>Uso de bibarón</th>
            <th>Control esfínteres</th>
        </tr>
        <tr>
            <td> </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <div class="subtitulo">
        Condiciones de salud
    </div>
    <div class="subtitulo" style="margin-top:1px;">
        Durante el desarrollo previo
    </div>
    <table class="antecedentes">
        <tr>
            <td style="width:14%;">
                Meningitis
            </td>
            <td class="chk" style="width:3%;">
                <input type="checkbox">
            </td>
            <td style="width:14%;">
                Traumatismos
            </td>
            <td class="chk" style="width:3%;">
                <input type="checkbox">
            </td>
            <td style="width:12%;">
                Convulsiones
            </td>
            <td class="chk" style="width:3%;">
                <input type="checkbox">
            </td>
            <td style="width:14%;">
                Desmayos
            </td>
            <td class="chk" style="width:3%;">
                <input type="checkbox">
            </td>
            <td style="width:14%;">
                Retraso del lenguaje
            </td>
            <td class="chk" style="width:3%;">
                <input type="checkbox">
            </td>
            <td style="width:13%;">
                Espasmo sollozo
            </td>
            <td class="chk" style="width:3%;">
                <input type="checkbox">
            </td>
        </tr>
        <tr>
            <td>
                Problemas visuales
            </td>
            <td class="chk">
                <input type="checkbox">
            </td>
            <td>
                Problemas del oído
            </td>
            <td class="chk">
                <input type="checkbox">
            </td>
            <td>
                Quemaduras
            </td>
            <td class="chk">
                <input type="checkbox">
            </td>
            <td colspan="2">
                Problemas psicoemocionales
            </td>
            <td class="chk">
                <input type="checkbox">
            </td>
            <td colspan="3">
                Otros:
                <input type="text" class="fill-inline" style="width:60%;">
            </td>
        </tr>
    </table>
    <div class="subtitulo" style="margin-top:1px;">
        Durante la etapa actual
    </div>
    <table class="discapacidad">
        <tr>
            <td class="label-col" rowspan="2">
                El estudiante tiene algún tipo de discapacidad
            </td>
            <td class="si-no">
                SI
            </td>
            <td>
                Tipo:
                Física <input type="checkbox">
                Intelectual <input type="checkbox">
                Auditiva <input type="checkbox">
                Visual <input type="checkbox">
                Lenguaje <input type="checkbox">
                Multidiscapacidad <input type="checkbox">
                <br>
                Posee carné de persona con discapacidad:
                No <input type="checkbox">
                Si <input type="checkbox">
                Nº:
                <input type="text" class="fill-inline" style="width:18%;">
                Porcentaje:
                <input type="text" class="fill-inline" style="width:12%;">
                <br>
                Diagnósticos:
                <input type="text" class="fill-inline" style="width:80%;">
            </td>
        </tr>
        <tr>
            <td class="si-no">
                NO
            </td>
            <td>
                Nivel de autonomía:
                Caminar solo<input type="checkbox">
                Bañarse solo <input type="checkbox">
                Vestirse solo <input type="checkbox">
                Comer solo <input type="checkbox">
                Dormir solo <input type="checkbox">
                <br>
                Recursos técnicos que requiere:
                <input type="text" class="fill-inline" style="width:70%;">
                <br>
                Origen discapacidad:
                Congénito <input type="checkbox">
                Enfermedad <input type="checkbox">
                Accidente <input type="checkbox">
            </td>
        </tr>
        <tr>
            <td class="label-col" rowspan="2">
                El estudiante tiene alguna condición médica específica actualmente (alergias u otras)
            </td>
            <td class="si-no">
                SI
            </td>
            <td>
                Determinar cuál:
                <input type="text" class="fill-inline" style="width:65%;">
                <br>
                Uso de medicación:
                NO <input type="checkbox">
                SI <input type="checkbox">
                Cuál:
                <input type="text" class="fill-inline" style="width:35%;">
            </td>
        </tr>
        <tr>
            <td class="si-no">
                NO
            </td>
            <td>
                Dosis:
                <input type="text" class="fill-inline" style="width:70%;">
                <br>
                Precauciones:
                <input type="text" class="fill-inline" style="width:65%;">
            </td>
        </tr>
    </table>
    <div class="subtitulo" style="margin-top:1px;">
        Antecedentes patológicos familiares
    </div>
    <div class="linea-box">
        Obesidad <input type="checkbox">
        Enfermedades cardíacas <input type="checkbox">
        Hipertensión <input type="checkbox">
        Enfermedades mentales <input type="checkbox">
        Diabetes <input type="checkbox">
        Otros <input type="checkbox">
        <input type="text" class="fill-inline" style="width:30%;">
    </div>
    <div class="subtitulo">
        Antecedentes académicos, comportamentales y afectivos
    </div>
    <table class="antecedentes">
        <tr>
            <th>
                Año de EGB de ingreso
            </th>
            <th>
                Año lectivo de ingreso
            </th>
            <th>
                IE de la que procede
            </th>
            <th>
                Años repetidos
            </th>
            <th>
                Razón del cambio de IE
            </th>
        </tr>
        <tr>
            <td> </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <div class="subtitulo-centro" style="font-size:9.5px;">
        Proceso de adaptación
    </div>
    <div class="linea-box">
        Aceptable <input type="checkbox">
        Dificultoso <input type="checkbox">
        Deficiente <input type="checkbox">
        Observaciones:
        <input type="text" class="fill-inline" style="width:45%;">
    </div>
    <div class="subtitulo-centro" style="font-size:9.5px;">
        Problemas escolares previos
    </div>
    <table class="antecedentes" style="text-align:left;">
        <tr>
            <td style="width:12%;font-weight:bold;font-style:italic;">
                Académicos
            </td>
            <td>
                Escritura <input type="checkbox">
                Lectura <input type="checkbox">
                Cálculo <input type="checkbox">
                Ortografía <input type="checkbox">
                Otros <input type="checkbox">
                <input type="text" class="fill-inline" style="width:40%;">
            </td>
        </tr>
        <tr>
            <td style="font-weight:bold;font-style:italic;">
                Conductuales
            </td>
            <td>
                Hiperactividad <input type="checkbox">
                Pasividad <input type="checkbox">
                Evitación <input type="checkbox">
                Agresividad <input type="checkbox">
                Otros <input type="checkbox">
                <input type="text" class="fill-inline" style="width:40%;">
            </td>
        </tr>
    </table>
    <div class="fuente">
        *Ministerio de Educación (2023).
        <i>
            Modelo de Gestión del Departamento de Consejería Estudiantil.
        </i>
        Quito: Ecuador.
    </div>
    <div class="profesional-fecha">
        <div class="profesional">
            Profesional que reporta
            <input type="text">
        </div>
        <div class="fecha2">
            Fecha:
            <input type="text" maxlength="2">
            /
            <input type="text" maxlength="2">
            /
            <input type="text" maxlength="4" style="width:38px;">
        </div>
    </div>
</div>
</div>
<!-- =========================================================
     JAVASCRIPT
     ========================================================= -->
<script>
const CLAVE_BORRADOR = 'apch_entrevista_representante_borrador';
const ZOOM_MINIMO = 0.80;
const ZOOM_MAXIMO = 1.70;
const ZOOM_PASO = 0.10;
let zoomActual = 1;
/* =========================================================
   CAMPOS DEL FORMULARIO
   ========================================================= */
function obtenerCampos() {
    return document.querySelectorAll('.page input');
}
/* =========================================================
   GUARDAR BORRADOR
   ========================================================= */
function guardarBorrador() {
    const campos = obtenerCampos();
    const datos = [];
    campos.forEach(campo => {
        if (campo.type === 'checkbox') {
            datos.push({
                tipo: 'checkbox',
                checked: campo.checked
            });
        } else {
            datos.push({
                tipo: campo.type,
                value: campo.value
            });
        }
    });
    localStorage.setItem(
        CLAVE_BORRADOR,
        JSON.stringify(datos)
    );
    actualizarEstadoGuardado('Guardado');
}
/* =========================================================
   GUARDAR MANUALMENTE
   ========================================================= */
function guardarManualmente() {
    guardarBorrador();
    actualizarEstadoGuardado('Guardado correctamente');
    setTimeout(() => {
        actualizarEstadoGuardado('Guardado');
    }, 1800);
}
/* =========================================================
   CARGAR BORRADOR
   ========================================================= */
function cargarBorrador() {
    if (window.formularioEnEdicion) {
        return;
    }

    const borrador = localStorage.getItem(CLAVE_BORRADOR);
    if (!borrador) {
        actualizarEstadoGuardado('Sin cambios');
        return;
    }
    try {
        const datos = JSON.parse(borrador);
        const campos = obtenerCampos();
        campos.forEach((campo, indice) => {
            if (!datos[indice]) {
                return;
            }
            if (campo.type === 'checkbox') {
                campo.checked = datos[indice].checked;
            } else {
                campo.value = datos[indice].value || '';
            }
        });
        actualizarEstadoGuardado('Borrador cargado');
        setTimeout(() => {
            actualizarEstadoGuardado('Guardado');
        }, 1800);
    } catch (error) {
        console.error(
            'No se pudo cargar el borrador:',
            error
        );
        actualizarEstadoGuardado('Error al cargar');
    }
}
/* =========================================================
   BORRAR TODO
   ========================================================= */
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
/* =========================================================
   VOLVER
   ========================================================= */
function volver() {
    const confirmar = confirm(
        '¿Desea volver? Los datos guardados como borrador permanecerán disponibles.'
    );
    if (!confirmar) {
        return;
    }
    window.history.back();
}
/* =========================================================
   GUARDAR E IMPRIMIR
   ========================================================= */
function guardarEImprimir() {

    guardarBorrador();

    const campos = obtenerCampos();

    const datos = [];

    campos.forEach(campo => {

        if (campo.type === 'checkbox') {

            datos.push({
                tipo: 'checkbox',
                checked: campo.checked
            });

        } else {

            datos.push({
                tipo: campo.type,
                value: campo.value
            });

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
                    'ENTREVISTA REPRESENTANTES',

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
/* =========================================================
   ESTADO DE GUARDADO
   ========================================================= */
function actualizarEstadoGuardado(texto) {
    const textoEstado =
        document.getElementById('textoEstado');
    if (textoEstado) {
        textoEstado.textContent = texto;
    }
}
/* =========================================================
   ZOOM
   ========================================================= */
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
/* =========================================================
   ZOOM AUTOMÁTICO PARA LA PANTALLA
   ========================================================= */
function calcularZoomAutomatico() {
    const anchoDisponible =
        window.innerWidth - 80;
    /*
     * El ancho aproximado de una hoja A4 en CSS
     * es de 793.7 px.
     *
     * Buscamos que la hoja utilice aproximadamente
     * el 92% del ancho disponible.
     */
    const anchoA4 = 793.7;
    let zoomCalculado =
        (anchoDisponible * 0.92) / anchoA4;
    /*
     * Límites para evitar que la hoja se vuelva
     * demasiado pequeña o exageradamente grande.
     */
    zoomCalculado = Math.max(
        ZOOM_MINIMO,
        Math.min(ZOOM_MAXIMO, zoomCalculado)
    );
    /*
     * Redondeamos para que los valores sean cómodos:
     * 1.10, 1.20, 1.30, etc.
     */
    zoomCalculado =
        Math.round(zoomCalculado * 10) / 10;
    zoomActual = zoomCalculado;
    aplicarZoom();
}
/* =========================================================
   AUMENTAR ZOOM
   ========================================================= */
function aumentarZoom() {
    zoomActual += ZOOM_PASO;
    if (zoomActual > ZOOM_MAXIMO) {
        zoomActual = ZOOM_MAXIMO;
    }
    zoomActual =
        Math.round(zoomActual * 10) / 10;
    aplicarZoom();
}
/* =========================================================
   DISMINUIR ZOOM
   ========================================================= */
function disminuirZoom() {
    zoomActual -= ZOOM_PASO;
    if (zoomActual < ZOOM_MINIMO) {
        zoomActual = ZOOM_MINIMO;
    }
    zoomActual =
        Math.round(zoomActual * 10) / 10;
    aplicarZoom();
}
/* =========================================================
   RESTABLECER / AJUSTAR A PANTALLA
   ========================================================= */
function restablecerZoom() {
    calcularZoomAutomatico();
}
/* =========================================================
   INICIALIZACIÓN
   ========================================================= */
document.addEventListener(
    'DOMContentLoaded',
    function () {
        cargarBorrador();
        calcularZoomAutomatico();
        const campos = obtenerCampos();
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
    }
);
/* =========================================================
   SI CAMBIA EL TAMAÑO DE LA VENTANA
   ========================================================= */
window.addEventListener(
    'resize',
    function () {
        /*
         * No cambiamos automáticamente el zoom si
         * el usuario ya está trabajando manualmente.
         *
         * El botón "Ajustar" permite recalcularlo.
         */
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
