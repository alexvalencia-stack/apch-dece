<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Consentimiento Informado para la Atención Psicosocial</title>

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
        background: #e6e6e6;
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

    .toolbar button,
    .toolbar a {
        font-family: Arial, sans-serif;
        font-size: 14px;
        font-weight: 500;
        padding: 8px 15px;
        cursor: pointer;
        border: 1px solid #b8b8b8;
        border-radius: 6px;
        background: #f5f5f5;
        color: #222;
        text-decoration: none;
        transition: background 0.15s ease, border-color 0.15s ease;
    }

    .toolbar button:hover,
    .toolbar a:hover {
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

    /* ===== CONTROL DE ZOOM ===== */

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

    /* ===== ESTADO DE GUARDADO ===== */

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

    /* ===== CONTENEDOR DEL DOCUMENTO ===== */

    .documento {
        width: 100%;
        overflow-x: auto;
        overflow-y: visible;
        padding: 25px 20px 40px;
    }

    /* ===== PÁGINA ===== */

    .page {
        width: 210mm;
        min-height: 297mm;
        margin: 0 auto;
        background: #ffffff;
        padding: 12mm 15mm 10mm 15mm;
        position: relative;
        font-family: "Times New Roman", Times, serif;
        color: #000;
        box-shadow: 0 2px 14px rgba(0, 0, 0, 0.18);
        zoom: var(--zoom-documento, 1);
        transform-origin: top center;
    }

    .page input,
    .page textarea,
    .page select {
        font-family: "Times New Roman", Times, serif;
    }

    /* ===== ENCABEZADO ===== */

    .header {
        display: table;
        width: 100%;
        font-family: "Times New Roman", Times, serif;
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
        line-height: 1.3;
        margin-top: 3px;
        font-weight: bold;
    }

    .header-rule {
        border: none;
        border-top: 4px solid #000;
        margin: 10mm 0 10px 0;
    }

    /* ===== CAJA PRINCIPAL ===== */

    .box {
        border: 2px solid #000;
    }

    .box-title {
        text-align: center;
        font-weight: bold;
        font-size: 12.5px;
        text-transform: uppercase;
        padding: 8px 6px;
    }

    table.datos {
        width: 100%;
        border-collapse: collapse;
        font-size: 10.5px;
        border-top: 1px solid #000;
    }

    table.datos td {
        border: 1px solid #000;
        padding: 3px 6px;
        vertical-align: middle;
    }

    table.datos td.section-header {
        text-align: center;
        font-weight: bold;
        text-transform: uppercase;
        border-left: none;
        border-right: none;
    }

    .fill-inline {
        font-family: inherit;
        font-size: 10.5px;
        border: none !important;
        border-bottom: none !important;
        background: transparent;
        outline: none;
        width: 55%;
    }

    .fill-inline:focus {
        border: none !important;
        border-bottom: none !important;
        outline: none;
    }

    .consent-header {
        text-align: center;
        font-weight: bold;
        font-size: 11px;
        padding: 6px;
        border-top: 1px solid #000;
        border-bottom: 1px solid #000;
    }

    .consent-body {
        padding: 10px 10px 6px 10px;
        font-size: 10.5px;
        line-height: 1.9;
        text-align: justify;
    }

    .consent-body input[type="text"] {
        font-family: inherit;
        font-size: 10.5px;
        border: none !important;
        border-bottom: none !important;
        background: transparent;
        outline: none;
    }

    /* ===== AUTORIZACIÓN ===== */

    .authorization {
        text-align: center;
        font-size: 10.5px;
        margin: 4px 0 8px 0;
    }

    .authorization label {
        margin: 0 12px;
        white-space: nowrap;
        cursor: pointer;
    }

    input[type="radio"] {
        appearance: none;
        -webkit-appearance: none;
        width: 13px;
        height: 13px;
        position: relative;
        vertical-align: middle;
        margin: 0 4px;
        padding: 0;
        border: 1px solid #000;
        background: #fff;
        cursor: pointer;
    }
    input[type="radio"]::after {
        content: "";
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        font-weight: bold;
        line-height: 11px;
        color: #000;
    }
    input[type="radio"]:checked::after {
        content: "X";
    }

    .writing-space {
        padding: 0 10px;
    }

    .writing-space textarea {
        width: 100%;
        height: 320px;
        resize: none;
        border: none;
        outline: none;
        font-family: inherit;
        font-size: 10.5px;
        line-height: 32px;
        background: transparent;
    }

    .consent-body2 {
        padding: 8px 10px 10px 10px;
        font-size: 10.5px;
        line-height: 1.5;
        text-align: justify;
        border-top: 1px solid #000;
    }

    /* ===== FIRMAS ===== */

    .box-firmas {
        border: 2px solid #000;
        margin-top: 8mm;
    }

    .firmas-title {
        text-align: center;
        font-weight: bold;
        font-size: 11px;
        padding: 5px;
        border-bottom: 1px solid #000;
    }

    table.firmas {
        width: 100%;
        border-collapse: collapse;
        font-size: 10px;
    }

    table.firmas td {
        width: 50%;
        vertical-align: bottom;
        text-align: center;
        font-weight: bold;
        padding: 4px 10px 4px 10px;
        height: 70px;
    }

    table.firmas td:first-child {
        border-right: 1px solid #000;
    }

    table.firmas tr.nombre td {
        text-align: left;
        vertical-align: middle;
        font-weight: normal;
        height: auto;
        border-top: 1px solid #000;
        padding: 4px 10px;
    }

    table.firmas tr.nombre td strong {
        font-weight: bold;
    }

    table.firmas .fill-inline {
        width: 75%;
    }

    .nota-confidencial {
        border-top: 1px solid #000;
        font-size: 9.5px;
        font-style: italic;
        padding: 6px 10px;
    }

    /* ===== PIE DE PÁGINA ===== */

    .fuente {
        font-family: "Times New Roman", Times, serif;
        font-size: 10px;
        margin-top: 8px;
    }

    .footer-contact {
        display: table;
        width: 100%;
        margin-top: 10px;
        font-family: "Times New Roman", Times, serif;
        font-size: 10.5px;
        line-height: 1.5;
    }

    .footer-contact-text {
        display: table-cell;
        vertical-align: middle;
    }

    .footer-contact-logo {
        display: table-cell;
        width: 130px;
        vertical-align: middle;
        text-align: right;
    }

    .footer-contact-logo img {
        width: 110px;
        height: auto;
    }

    .footer-contact a {
        color: #000;
        text-decoration: underline;
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

    /* ===== IMPRESIÓN ===== */

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
            width: 210mm;
            height: 297mm;
            min-height: 297mm;
            margin: 0;
            box-shadow: none;
            overflow: hidden;
            zoom: 1 !important;
            page-break-after: always;
        }

        .page:last-child {
            page-break-after: auto;
        }

        .writing-space textarea {
            background: transparent;
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

<!-- ===== BARRA DE HERRAMIENTAS ===== -->

<div class="toolbar">

    @include('formularios.partials.selector-carpeta')

    <button
        type="button"
        onclick="borrarTodo()"
        class="btn-borrar"
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
        onclick="window.location.href='{{ route('formularios.mis-documentos', ['tipo' => 'consentimiento-informado']) }}'"
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


<div class="documento">

<div class="page">

    <!-- ===== ENCABEZADO ===== -->

    @include('formularios.partials.encabezado-institucional')


    <!-- ===== CAJA PRINCIPAL ===== -->

    <div class="box">

        <div class="box-title">
            CONSENTIMIENTO INFORMADO PARA LA ATENCI&Oacute;N PSICOSOCIAL
        </div>


        <table class="datos">

            <tr>

                <td
                    class="section-header"
                    colspan="4"
                >
                    DATOS INFORMATIVOS GENERALES
                </td>

            </tr>


            <tr>

                <td colspan="4">

                    Nombre del/la estudiante:

                    <input
                        type="text"
                        class="fill-inline"
                        style="width:75%;"
                        name="nombre_estudiante"
                        data-draft="true"
                    >

                </td>

            </tr>


            <tr>

                <td style="width:35%;">

                    Curso y paralelo:

                    <input
                        type="text"
                        class="fill-inline"
                        style="width:55%;"
                        name="curso_paralelo"
                        data-draft="true"
                    >

                </td>

                <td colspan="3">

                    Jornada:

                    <input
                        type="text"
                        class="fill-inline"
                        style="width:70%;"
                        name="jornada"
                        data-draft="true"
                    >

                </td>

            </tr>


            <tr>

                <td style="width:35%;">

                    Tel&eacute;fono de representante:

                    <input
                        type="text"
                        class="fill-inline"
                        style="width:45%;"
                        name="telefono_representante"
                        data-draft="true"
                        inputmode="tel"
                    >

                </td>

                <td colspan="3">

                    Fecha:

                    <input
                        type="date"
                        class="fill-inline"
                        style="width:40%;"
                        name="fecha"
                        data-draft="true"
                    >

                </td>

            </tr>

        </table>


        <!-- ===== CONSENTIMIENTO ===== -->

        <div class="consent-header">
            Consentimiento informado
        </div>


        <div class="consent-body">

            Yo,

            <input
                type="text"
                style="width:44%;"
                name="nombre_representante"
                data-draft="true"
            >

            en calidad de representante de el/la estudiante

            <input
                type="text"
                style="width:38%;"
                name="estudiante_representado"
                data-draft="true"
            >,

            una vez que he conocido en qu&eacute; consiste el proceso de
            atenci&oacute;n psicosocial que ejecuta el personal del
            Departamento de Consejer&iacute;a Estudiantil de la instituci&oacute;n
            de educaci&oacute;n,

            AUTORIZO

            <input
                    type="radio"
                    name="autorizacion"
                    value="AUTORIZO"
                    data-draft="true"
                >

            NO AUTORIZO

            <input
                    type="radio"
                    name="autorizacion"
                    value="NO AUTORIZO"
                    data-draft="true"
                >,

            que mi representado/a cuente con este servicio, en raz&oacute;n de que

        </div>


        <div class="writing-space">

            <textarea
                name="razon"
                data-draft="true"
            ></textarea>

        </div>


        <div class="consent-body2">

            A su vez, declaro haber sido informado/a que el servicio de
            atenci&oacute;n y acompa&ntilde;amiento psicosocial no consiste
            en un proceso de evaluaci&oacute;n y/o terapia psicol&oacute;gica
            y que en caso de requerirlo mi representado/a podr&iacute;a ser
            derivado a un centro de atenci&oacute;n externa a la instituci&oacute;n
            educativa que brinde dicho servicio.

        </div>

    </div>


    <!-- ===== FIRMAS ===== -->

    <div class="box-firmas">

        <div class="firmas-title">
            Firmas
        </div>


        <table class="firmas">

            <tr>

                <td>

                    &nbsp;<br>
                    &nbsp;<br>
                    &nbsp;<br>

                    Profesional del Departamento de Consejer&iacute;a Estudiantil
                    <br>

                    que brindar&aacute; la atenci&oacute;n

                </td>


                <td>

                    &nbsp;<br>
                    &nbsp;<br>
                    &nbsp;<br>

                    Padre/madre/representante legal

                </td>

            </tr>


            <tr class="nombre">

                <td>

                    <strong>Nombre:</strong>

                    <input
                        type="text"
                        class="fill-inline"
                        name="nombre_profesional"
                        data-draft="true"
                    >

                </td>


                <td>

                    <strong>Nombre:</strong>

                    <input
                        type="text"
                        class="fill-inline"
                        name="nombre_representante_legal"
                        data-draft="true"
                    >

                </td>

            </tr>

        </table>


        <div class="nota-confidencial">

            *La informaci&oacute;n registrada en este documento es
            confidencial y de uso exclusivo del Departamento de
            Consejer&iacute;a Estudiantil

        </div>

    </div>


    <!-- ===== FUENTE ===== -->

    <div class="fuente">

        Ministerio de Educaci&oacute;n (2023).

        <i>
            Modelo de Gesti&oacute;n del Departamento de Consejer&iacute;a
            Estudiantil.
        </i>

        Quito: Ecuador.

    </div>


    <!-- ===== CONTACTO ===== -->

    <div class="footer-contact">

        <div class="footer-contact-text">

            <strong>Direcci&oacute;n:</strong>
            Av. El Maestro y Augusto Zavala

            <br>

            <strong>e-mail</strong>:

            <a href="mailto:colegio_apch_sm@yahoo.es">
                colegio_apch_sm@yahoo.es
            </a>

            <br>

            <strong>Telf:</strong>
            <i>Secretar&iacute;a:</i>
            032 989 035

        </div>


        <div class="footer-contact-logo">

            <img
                src="{{ asset('images/ecuador-resuelve.png') }}"
                alt="El Nuevo Ecuador Resuelve"
            >

        </div>

    </div>

</div>

</div>


<!-- ===== GUARDADO AUTOMÁTICO ===== -->

<script>

    const STORAGE_KEY =
        'apch_consentimiento_informado_borrador';


    function actualizarEstadoGuardado(texto) {

        const textoEstado =
            document.getElementById('textoEstado');

        if (textoEstado) {
            textoEstado.textContent = texto;
        }

    }


    function obtenerCampos() {

        return document.querySelectorAll(
            '[data-draft="true"]'
        );

    }


    /*
     * Guarda automáticamente todos los campos
     * en el navegador.
     */

    function guardarBorrador() {

        const campos =
            obtenerCampos();

        const datos = {};


        campos.forEach((campo) => {

            if (campo.type === 'radio') {

                if (campo.checked) {
                    datos[campo.name] = campo.value;
                }

            } else {

                datos[campo.name] = campo.value;

            }

        });


        localStorage.setItem(
            STORAGE_KEY,
            JSON.stringify(datos)
        );


        actualizarEstadoGuardado('Guardado');

    }


    /*
     * Recupera automáticamente el borrador
     * cuando se abre nuevamente el formulario.
     */

    function cargarBorrador() {

        if (window.formularioEnEdicion) {
            return;
        }

        const guardado =
            localStorage.getItem(STORAGE_KEY);


        if (!guardado) {

            actualizarEstadoGuardado(
                'Sin datos guardados'
            );

            return;

        }


        try {

            const datos =
                JSON.parse(guardado);

            const campos =
                obtenerCampos();


            campos.forEach((campo) => {

                if (!(campo.name in datos)) {
                    return;
                }


                if (campo.type === 'radio') {

                    campo.checked =
                        campo.value === datos[campo.name];

                } else {

                    campo.value =
                        datos[campo.name];

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


    /*
     * Guardar mientras el usuario escribe.
     */

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            cargarBorrador();


            const campos =
                obtenerCampos();


            campos.forEach((campo) => {

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


    /*
     * Borrar formulario y borrador.
     */

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


    /*
     * Guardar e imprimir.
     */

    function guardarEImprimir() {

    guardarBorrador();

    const campos = obtenerCampos();

    const datos = {};

    campos.forEach((campo) => {

        if (campo.type === 'checkbox') {
            datos[campo.name] = {
                tipo: 'checkbox',
                valor: campo.checked
            };
        } else if (campo.type === 'radio') {

            if (campo.checked) {
                datos[campo.name] = campo.value;
            }

        } else {

            datos[campo.name] = campo.value;

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
                    'CONSENTIMIENTO INFORMADO',

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


    /* ===== ZOOM ===== */

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
            zoomActual = ZOOM_MAXIMO;
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
            zoomActual = ZOOM_MINIMO;
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


    /*
     * Ajustar nuevamente al cambiar
     * el tamaño de la ventana.
     */

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
</body>
</html>
