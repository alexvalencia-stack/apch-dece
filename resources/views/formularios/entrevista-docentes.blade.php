
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Entrevista Semiestructurada para Docentes</title>

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

    html,
    body {
        margin: 0;
        padding: 0;
        color: #000;
    }

    body {
        background: #e6e6e6;
        font-family: "Times New Roman", Times, serif;
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
        transition: background 0.15s ease, border-color 0.15s ease;
    }

    .toolbar button:hover {
        background: #e9e9e9;
        border-color: #999;
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
       HOJA A4
       ========================= */

    .page {
        width: 210mm;
        min-height: 297mm;
        margin: 0 auto 25px;
        background: #ffffff;
        padding: 8mm 15mm 6mm 15mm;
        position: relative;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.25);
        zoom: var(--zoom-documento, 1);
        transform-origin: top center;
    }

    /* ===== ENCABEZADO ===== */

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

    .header-text .l1 {
        font-size: 19px;
        line-height: 1.15;
    }

    .header-text .l2 {
        font-size: 19px;
        line-height: 1.15;
    }

    .header-text .l3 {
        font-size: 14px;
        line-height: 1.3;
        margin-top: 2px;
    }

    .header-text .l4 {
        font-size: 12px;
        font-weight: bold;
        line-height: 1.3;
    }

    .header-rule {
        border: none;
        border-top: 4px solid #000;
        margin: 3px 0 5px 0;
    }

    .form-title {
        text-align: center;
        font-style: italic;
        font-weight: bold;
        font-size: 14px;
        margin-bottom: 2px;
    }

    .form-subtitle {
        text-align: center;
        font-weight: bold;
        font-size: 11px;
        margin-bottom: 5px;
    }

    /* ===== TABLA SUPERIOR ===== */

    table.datos {
        width: 100%;
        border-collapse: collapse;
        border: 1.5px solid #000;
        font-size: 11px;
        margin-bottom: 4px;
    }

    table.datos td {
        border: 1px solid #000;
        padding: 2px 6px;
        font-weight: bold;
        vertical-align: middle;
    }

    table.datos td .campo {
        font-weight: normal;
    }

    /* ===== SECCIONES ===== */

    .seccion {
        margin-top: 3px;
        font-size: 10.3px;
        line-height: 1.2;
    }

    .seccion-header {
        display: table;
        width: 100%;
    }

    .seccion-letra {
        display: table-cell;
        width: 34px;
        font-weight: bold;
        vertical-align: top;
        padding-left: 14px;
        white-space: nowrap;
    }

    .seccion-cuerpo {
        display: table-cell;
        vertical-align: top;
    }

    .seccion-titulo {
        font-weight: bold;
        margin-right: 3px;
    }

    .seccion-desc {
        font-style: italic;
    }

    /* ===== PREGUNTAS ===== */

    .pregunta {
        font-size: 10.3px;
        line-height: 1.2;
        margin-top: 2px;
        white-space: nowrap;
    }

    .pregunta .qtext {
        white-space: normal;
    }

    .fill-inline {
        font-family: "Times New Roman", Times, serif;
        font-size: 10.3px;
        border: none;
        border-bottom: none;
        background: transparent;
        outline: none;
        width: 130px;
        margin-left: 2px;
    }

    .fill-full {
        display: block;
        width: 100%;
        font-family: "Times New Roman", Times, serif;
        font-size: 10.3px;
        border: none;
        border-bottom: none;
        background: transparent;
        outline: none;
        margin-top: 1px;
        margin-bottom: 1px;
    }

    .comentarios .fill-full {
        margin-bottom: 4px;
    }

    /* ===== PIE ===== */

    .fuente {
        font-size: 10px;
        margin-top: 3px;
    }

    .fuente i {
        font-style: italic;
    }

    .firma-fecha {
        display: table;
        width: 100%;
        margin-top: 3px;
        font-size: 10.5px;
        font-style: italic;
    }

    .firma {
        display: table-cell;
        width: 65%;
    }

    .firma input {
        font-family: "Times New Roman", Times, serif;
        font-style: italic;
        font-size: 10.5px;
        border: none;
        border-bottom: none;
        background: transparent;
        outline: none;
        width: 260px;
        margin-left: 4px;
    }

    .fecha {
        display: table-cell;
        width: 35%;
        text-align: right;
    }

    .fecha input {
        font-family: "Times New Roman", Times, serif;
        font-style: italic;
        font-size: 10.5px;
        border: none;
        border-bottom: none;
        background: transparent;
        outline: none;
        width: 30px;
        text-align: center;
    }
    .fecha input[type="date"] {
        width: 100px;
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

        .toolbar {
            display: none !important;
        }

        .documento {
            width: auto;
            overflow: visible;
            padding: 0;
        }

        .page {
            width: 210mm;
            height: 297mm;
            min-height: 297mm;
            margin: 0;
            box-shadow: none;
            zoom: 1 !important;
            overflow: hidden;
        }

        .fill-inline,
        .fill-full,
        .firma input,
        .fecha input {
            border-bottom: none;
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

<!-- =========================
     BARRA DE HERRAMIENTAS
     ========================= -->

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
        onclick="window.location.href='{{ route('formularios.mis-documentos', ['tipo' => 'entrevista-docentes']) }}'"
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


<!-- =========================
     CONTENEDOR DEL DOCUMENTO
     ========================= -->

<div class="documento">

<div class="page">

    @include('formularios.partials.encabezado-institucional')


    <div class="form-title">
        ENTREVISTA SEMIESTRUCTURADA PARA DOCENTES
    </div>

    <div class="form-subtitle">
        A&Ntilde;O LECTIVO 2026-2027
    </div>


    <table class="datos">

        <tr>

            <td colspan="2">

                Apellidos y nombres de el/la estudiante:

                <input
                    type="text"
                    class="fill-inline"
                    style="width:65%;border:none;border-bottom:none;font-weight:normal;"
                >

            </td>

        </tr>


        <tr>

            <td colspan="2">

                A&ntilde;o/paralelo:

                <input
                    type="text"
                    class="fill-inline"
                    style="width:60%;border:none;border-bottom:none;font-weight:normal;"
                >

            </td>

        </tr>


        <tr>

            <td style="width:60%;">

                Nombre de el/la Docente:

                <input
                    type="text"
                    style="border:none;background:transparent;outline:none;font-weight:normal;font-family:inherit;font-size:inherit;width:40%;"
                >

            </td>

            <td>

                Asignatura:

                <input
                    type="text"
                    style="border:none;background:transparent;outline:none;font-weight:normal;font-family:inherit;font-size:inherit;width:50%;"
                >

            </td>

        </tr>

    </table>


    <!-- SECCIÓN A -->

    <div class="seccion">

        <div class="seccion-header">

            <div class="seccion-letra">
                A.
            </div>

            <div class="seccion-cuerpo">

                <span class="seccion-titulo">
                    Motivo.-
                </span>

                <span class="seccion-desc">
                    Preguntas relacionadas a identificar la perspectiva de &eacute;l o la docente sobre la alerta o el requerimiento de atenci&oacute;n psicosocial para &eacute;l o la estudiante
                </span>

            </div>

        </div>


        <div class="pregunta">

            <span class="qtext">
                &iquest;Por qu&eacute; considera que su estudiante requiere la atenci&oacute;n psicosocial del Departamento de Consejer&iacute;a Estudiantil?
            </span>

            <input
                type="text"
                class="fill-inline"
                style="width:60%;"
            >

        </div>

        <input type="text" class="fill-full">


        <div class="pregunta">

            <span class="qtext">
                &iquest;Cu&aacute;les son las dificultades o problemas en el &aacute;mbito psicosocial que est&aacute; presentando &eacute;l o la estudiante?
            </span>

            <input
                type="text"
                class="fill-inline"
                style="width:20%;"
            >

        </div>

        <input type="text" class="fill-full">


        <div class="pregunta">

            <span class="qtext">
                &iquest;Cu&aacute;les cree que son las causas para que se est&eacute;n presentando las dificultades?
            </span>

            <input
                type="text"
                class="fill-inline"
                style="width:30%;"
            >

        </div>

        <input type="text" class="fill-full">


        <div class="pregunta">

            <span class="qtext">
                &iquest;C&oacute;mo cree que se siente &eacute;l o la estudiante ante las dificultades que se est&aacute;n presentando?
            </span>

            <input
                type="text"
                class="fill-inline"
                style="width:25%;"
            >

        </div>

        <input type="text" class="fill-full">


        <div class="pregunta">

            <span class="qtext">
                &iquest;Qu&eacute; se ha venido haciendo para intentar solucionar el problema al interior de la instituci&oacute;n educativa y quienes se han involucrado?
            </span>

            <input
                type="text"
                class="fill-inline"
                style="width:12%;"
            >

        </div>

        <input type="text" class="fill-full">


        <div class="pregunta">

            <span class="qtext">
                &iquest;Qu&eacute; considera que hace falta para solucionar el problema y quienes deber&iacute;an involucrarse?
            </span>

            <input
                type="text"
                class="fill-inline"
                style="width:20%;"
            >

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
                    Adaptaci&oacute;n en el contexto educativo.-
                </span>

                <span class="seccion-desc">
                    Preguntas para conocer la perspectiva de el o la docente sobre la adaptaci&oacute;n de el o la estudiante en la instituci&oacute;n educativa y el tipo de relaciones que mantiene con los miembros de la comunidad educativa
                </span>

            </div>

        </div>


        <div class="pregunta">

            <span class="qtext">
                &iquest;C&oacute;mo cree que &eacute;l o la estudiante se siente en la instituci&oacute;n educativa?
            </span>

            <input
                type="text"
                class="fill-inline"
                style="width:30%;"
            >

        </div>

        <input type="text" class="fill-full">


        <div class="pregunta">

            <span class="qtext">
                &iquest;C&oacute;mo se siente &eacute;l o la estudiante con sus compa&ntilde;eros/as de aula?
            </span>

            <input
                type="text"
                class="fill-inline"
                style="width:30%;"
            >

        </div>

        <input type="text" class="fill-full">


        <div class="pregunta">

            <span class="qtext">
                &iquest;Hay alguna/s materia/s que le genere preocupaci&oacute;n a &eacute;l o la estudiante?
            </span>

            <input
                type="text"
                class="fill-inline"
                style="width:25%;"
            >

        </div>

        <input type="text" class="fill-full">


        <div class="pregunta">

            <span class="qtext">
                &iquest;Qu&eacute; le preocupa?
            </span>

            <input
                type="text"
                class="fill-inline"
                style="width:70%;"
            >

        </div>

        <input type="text" class="fill-full">


        <div class="pregunta">

            <span class="qtext">
                &iquest;C&oacute;mo considera que es la relaci&oacute;n entre usted y &eacute;l o la estudiante?
            </span>

            <input
                type="text"
                class="fill-inline"
                style="width:30%;"
            >

        </div>

        <input type="text" class="fill-full">


        <div class="pregunta">

            <span class="qtext">
                &iquest;C&oacute;mo considera que es la relaci&oacute;n entre el estudiante con otros/as docentes?
            </span>

            <input
                type="text"
                class="fill-inline"
                style="width:25%;"
            >

        </div>

        <input type="text" class="fill-full">


        <div class="pregunta">

            <span class="qtext">
                &iquest;C&oacute;mo considera que es la relaci&oacute;n entre &eacute;l o la estudiante con las autoridades de su instituci&oacute;n?
            </span>

            <input
                type="text"
                class="fill-inline"
                style="width:15%;"
            >

        </div>

        <input type="text" class="fill-full">


        <div class="pregunta">

            <span class="qtext">
                &iquest;Tal vez &eacute;l o la estudiante ha cambiado de actitud? &iquest;En qu&eacute; ha cambiado? &iquest;Desde cu&aacute;ndo? &iquest;Sabe si existe alguna raz&oacute;n para el cambio de actitud?
            </span>

            <input type="text" class="fill-full">

        </div>


        <div class="pregunta">

            <span class="qtext">
                &iquest;Usted ha visto que &eacute;l o la estudiante comparte tiempo con amigos/as? &iquest;Qu&eacute; hacen cuando est&aacute;n juntos/as? &iquest;Qui&eacute;nes son sus amigos/as? &iquest;C&oacute;mo son sus relaciones?
            </span>

            <input type="text" class="fill-full">

        </div>


        <div class="pregunta">

            <span class="qtext">
                &iquest;Ha observado o identificado tal vez alguna conducta o situaci&oacute;n que pueda poner en riesgo a &eacute;l o la estudiante?
            </span>

            <input
                type="text"
                class="fill-inline"
                style="width:18%;"
            >

        </div>

        <input type="text" class="fill-full">


        <div class="pregunta">

            <span class="qtext">
                &iquest;Qu&eacute; aspectos usted destacar&iacute;a de &eacute;l o la estudiante? (habilidades, valores, saberes, etc.)
            </span>

            <input
                type="text"
                class="fill-inline"
                style="width:15%;"
            >

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
                    Relaciones familiares.-
                </span>

                <span class="seccion-desc">
                    Perspectiva de los/as docentes sobre c&oacute;mo est&aacute; organizada la familia y el tipo de relaciones que se han construido entre los miembros que la conforman
                </span>

            </div>

        </div>


        <div class="pregunta">

            <span class="qtext">
                &iquest;C&oacute;mo considera que &eacute;l o la estudiante se siente en su hogar?
            </span>

            <input
                type="text"
                class="fill-inline"
                style="width:35%;"
            >

        </div>

        <input type="text" class="fill-full">


        <div class="pregunta">

            <span class="qtext">
                &iquest;Conoce qui&eacute;nes conforman el hogar de &eacute;l o la estudiante?
            </span>

            <input
                type="text"
                class="fill-inline"
                style="width:35%;"
            >

        </div>

        <input type="text" class="fill-full">


        <div class="pregunta">

            <span class="qtext">
                &iquest;Conoce si &eacute;l o la estudiante comparte suficiente tiempo con su familia?
            </span>

            <input
                type="text"
                class="fill-inline"
                style="width:25%;"
            >

        </div>

        <input type="text" class="fill-full">


        <div class="pregunta">

            <span class="qtext">
                &iquest;Conoce c&oacute;mo se relaciona &eacute;l o la estudiante con los/as integrantes de su familia?
            </span>

            <input
                type="text"
                class="fill-inline"
                style="width:20%;"
            >

        </div>

        <input type="text" class="fill-full">


        <div class="pregunta">

            <span class="qtext">
                &iquest;Conoce si &eacute;l o la representante cumple su responsabilidad de apoyar y acompa&ntilde;ar a &eacute;l o la estudiante en su proceso de desarrollo integral?
            </span>

            <input type="text" class="fill-full">

        </div>

        <input type="text" class="fill-full">

    </div>


    <!-- SECCIÓN D -->

    <div class="seccion comentarios">

        <div class="seccion-header">

            <div class="seccion-letra">
                D.
            </div>

            <div class="seccion-cuerpo">

                <span class="seccion-titulo">
                    Comentarios adicionales u observaciones
                </span>

            </div>

        </div>

        <input type="text" class="fill-full">
        <input type="text" class="fill-full">

    </div>


    <div class="fuente">

        Ministerio de Educaci&oacute;n (2023).

        <i>
            Modelo de Gesti&oacute;n del Departamento de Consejer&iacute;a Estudiantil.
        </i>

        Quito: Ecuador.

    </div>


    <div class="firma-fecha">

        <div class="firma">

            Entrevistador/a

            <input type="text">

        </div>


        <div class="fecha">

            Fecha:

            <input type="date" data-desde-hoy>

        </div>

    </div>

</div>

</div>


<script>

const CLAVE_BORRADOR =
    'apch_entrevista_docentes_borrador';


function actualizarEstadoGuardado(texto) {

    const textoEstado =
        document.getElementById('textoEstado');

    if (textoEstado) {
        textoEstado.textContent = texto;
    }

}


function obtenerCampos() {

    return document.querySelectorAll(
        '.page input'
    );

}


function guardarBorrador() {

    const campos =
        obtenerCampos();

    const datos = [];

    campos.forEach((campo, index) => {

        datos.push({

            index: index,

            value: campo.value

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
            'Sin datos guardados'
        );

        return;

    }


    try {

        const datos =
            JSON.parse(borrador);

        const campos =
            obtenerCampos();


        datos.forEach(dato => {

            if (campos[dato.index]) {

                campos[dato.index].value =
                    dato.value;

            }

        });


        actualizarEstadoGuardado(
            'Borrador cargado'
        );


    } catch (error) {

        console.error(
            'No se pudo cargar el borrador:',
            error
        );

        actualizarEstadoGuardado(
            'Error al cargar'
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


function volver() {

    window.history.back();

}


async function guardarEImprimir() {

    guardarBorrador();

    const campos = obtenerCampos();

    const datos = [];

    campos.forEach((campo, index) => {

        datos.push({
            index: index,
            value: campo.value
        });

    });

    try {

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
                    nombre_formulario: 'ENTREVISTA DOCENTES',
                    carpeta: document.getElementById('carpetaDestino')?.value || null,
                    datos: datos
                })
            }
        );
        window.print();

        const respuesta = await solicitud;

        const resultado = await respuesta.json();

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

    } catch (error) {

        console.error(
            'Error de conexión:',
            error
        );

        alert(
            'No se pudo guardar el formulario en el servidor.'
        );
    }
}


/* =========================
   ZOOM
   ========================= */

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
        document.getElementById(
            'zoomLabel'
        );


    if (zoomLabel) {

        zoomLabel.textContent =
            Math.round(
                zoomActual * 100
            ) + '%';

    }

}


function calcularZoomAutomatico() {

    const anchoDisponible =
        window.innerWidth - 80;

    const anchoA4 =
        793.7;


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


    if (zoomActual > ZOOM_MAXIMO) {

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


    if (zoomActual < ZOOM_MINIMO) {

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


/* =========================
   INICIO
   ========================= */

document.addEventListener(
    'DOMContentLoaded',
    function () {

        cargarBorrador();


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
