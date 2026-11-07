<html>
<head>
<meta charset="UTF-8">
<title>FICHA DE NOTIFICACIÓN DE ALERTA</title>

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

        padding: 12mm 14mm 10mm 14mm;

        margin: 0 auto 25px auto;

        background: #fff;
        position: relative;

        box-shadow: 0 2px 14px rgba(0, 0, 0, 0.18);

        zoom: var(--zoom-documento, 1);
        transform-origin: top center;

        font-family: "Times New Roman", Times, serif;
    }

    .page input,
    .page textarea,
    .page select {
        font-family: "Times New Roman", Times, serif;
    }

    /* ===== HEADER ===== */

    .header {
        display: flex;
        align-items: center;
        border-bottom: 3px solid #000;
        padding-bottom: 4px;
        margin-bottom: 10px;
    }

    .header img {
        width: 85px;
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

    .header-text .line1 {
        font-size: 17px;
        font-weight: bold;
        line-height: 1.15;
    }

    .header-text .line2 {
        font-size: 17px;
        font-weight: bold;
        line-height: 1.15;
    }

    .header-text .line3 {
        font-size: 12px;
        line-height: 1.3;
    }

    .header-text .line4 {
        font-size: 12px;
        line-height: 1.3;
    }

    /* ===== Main form table ===== */

    table.form {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #000;
        table-layout: fixed;
    }

    table.form td,
    table.form th {
        border: 1px solid #000;
        padding: 5px 6px;
        vertical-align: top;
        font-size: 12px;
    }

    col.label {
        width: 21.4%;
    }

    col.value {
        width: 78.6%;
    }

    .title-row td {
        text-align: center;
        font-size: 15px;
        font-weight: bold;
        padding: 8px 6px;
    }

    .section-row td {
        text-align: center;
        font-weight: bold;
        font-size: 12px;
        padding: 4px 6px;
    }

    .label-cell {
        font-weight: bold;
        vertical-align: middle !important;
    }

    /* ===== TEXT INPUTS ===== */

    .field-input {
        width: 100%;
        border: none;
        border-bottom: 1px solid transparent;
        font-family: "Times New Roman", Times, serif;
        font-size: 12px;
        background: transparent;
        padding: 2px;
        height: 20px;
    }

    .field-input:focus {
        outline: none;
        background: #fafff0;
    }

    .instructions {
        font-size: 10.5px;
        margin: 0 0 4px 0;
    }

    /* ===== DESCRIPCIÓN ===== */

    .description-cell {
        height: 445px;
        padding: 5px 6px;
    }

    textarea.description {
        width: 100%;
        height: 405px;
        border: none;
        resize: none;

        font-family: "Times New Roman", Times, serif;
        font-size: 12px;
        line-height: 20px;

        /* Se eliminan las líneas para escribir */
        background: transparent;
        background-image: none;
    }

    textarea.description:focus {
        outline: none;
    }

    .fecha-cell {
        padding: 6px;
    }

    .fecha-cell .instructions {
        margin-bottom: 5px;
    }

    /* ===== FOOTER / CITATION ===== */

    .citation {
        font-size: 10px;
        margin-top: 5px;
        margin-bottom: 0;
    }

    .signature-block {
        text-align: center;
        margin-top: 24px;
    }

    .signature-line {
        border-bottom: 1px solid #000;
        width: 260px;
        margin: 0 auto;
        height: 14px;
    }

    .signature-label {
        font-weight: bold;
        font-size: 12px;
        margin-top: 3px;
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

            margin: 0;

            padding: 12mm 14mm 10mm 14mm;

            box-shadow: none;

            zoom: 1 !important;

            page-break-after: always;

            font-family: "Times New Roman", Times, serif;
        }

        .page input,
        .page textarea,
        .page select {
            font-family: "Times New Roman", Times, serif;
        }

        .page:last-child {
            page-break-after: auto;
        }

        textarea.description {
            background: transparent !important;
            background-image: none !important;
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
    class="btn-ver-formularios"
    onclick="window.location.href='{{ route('formularios.mis-documentos', ['tipo' => 'ficha-alerta-dece']) }}'"
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

    @include('formularios.partials.encabezado-institucional')


    <table class="form">

        <colgroup>

            <col class="label">
            <col class="value">

        </colgroup>


        <tr class="title-row">

            <td colspan="2">
                FICHA DE NOTIFICACIÓN DE ALERTA
            </td>

        </tr>


        <tr class="section-row">

            <td colspan="2">
                Información de la o el estudiante
            </td>

        </tr>


        <tr>

            <td class="label-cell">
                Nombre y apellido
            </td>

            <td>

                <input
                    type="text"
                    class="field-input"
                    name="estudiante_nombre"
                >

            </td>

        </tr>


        <tr>

            <td class="label-cell">
                Grado o curso
            </td>

            <td>

                <input
                    type="text"
                    class="field-input"
                    name="estudiante_grado"
                >

            </td>

        </tr>


        <tr class="section-row">

            <td colspan="2">
                Información sobre la alerta
            </td>

        </tr>


        <tr>

            <td class="label-cell">
                Descripción de la alerta
            </td>

            <td class="description-cell">

                <p class="instructions">
                    Escribir de forma concreta la alerta identificada, ubicar factores, fecha, lugar, contexto
                </p>

                <textarea
                    class="description"
                    name="descripcion_alerta"
                ></textarea>

            </td>

        </tr>


        <tr class="section-row">

            <td colspan="2">
                Información de quien notifica la alerta
            </td>

        </tr>


        <tr>

            <td class="label-cell">
                Nombre y apellido
            </td>

            <td>

                <input
                    type="text"
                    class="field-input"
                    name="notifica_nombre"
                >

            </td>

        </tr>


        <tr>

            <td class="label-cell">
                Cargo
            </td>

            <td>

                <input
                    type="text"
                    class="field-input"
                    name="notifica_cargo"
                >

            </td>

        </tr>


        <tr>

            <td class="label-cell">
                Contacto
            </td>

            <td>

                <input
                    type="text"
                    class="field-input"
                    name="notifica_contacto"
                >

            </td>

        </tr>


        <tr>

            <td class="label-cell">
                Fecha
            </td>

            <td class="fecha-cell">

                <p class="instructions">
                    Ubicar la fecha cuando se entrega la ficha al Departamento de Consejería Estudiantil
                </p>

                <input
                    type="date"
                    class="field-input"
                    name="fecha_entrega"
                    data-desde-hoy
                >

            </td>

        </tr>

    </table>


    <p class="citation">

        Ministerio de Educación (2023).

        <em>
            Modelo de Gestión del Departamento de Consejería Estudiantil.
        </em>

        &nbsp; Quito: Ecuador.

    </p>


    <div class="signature-block">

        <div class="signature-line"></div>

        <div class="signature-label">
            Firma
        </div>

    </div>

</div>

</div>


<script>

    /* =====================================================
       CLAVE DEL BORRADOR
       ===================================================== */

    const CLAVE_BORRADOR =
        'apch_ficha_notificacion_alerta_borrador';


    /* =====================================================
       OBTENER TODOS LOS CAMPOS
       ===================================================== */

    function obtenerCampos() {

        return document.querySelectorAll(
            '.page input, .page textarea'
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

        const datos = {};


        campos.forEach(campo => {

            if (!campo.name) {

                return;

            }


            if (
                campo.type === 'checkbox' ||
                campo.type === 'radio'
            ) {

                datos[campo.name] = {

                    tipo: campo.type,

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


        actualizarEstadoGuardado(
            'Guardado'
        );

    }


    /* =====================================================
       CARGAR BORRADOR
       ===================================================== */

   function cargarBorrador() {

    /* =================================================
       MODO EDICIÓN
       ================================================= */

    const datosEditar = @json($datosEditar ?? null);

    if (datosEditar) {

        const campos = obtenerCampos();

        campos.forEach(campo => {

            if (
                !campo.name ||
                !datosEditar[campo.name]
            ) {
                return;
            }

            if (
                campo.type === 'checkbox' ||
                campo.type === 'radio'
            ) {

                campo.checked =
                    datosEditar[campo.name].valor;

            } else {

                campo.value =
                    datosEditar[campo.name].valor || '';

            }

        });

        actualizarEstadoGuardado(
            'Formulario cargado para edición'
        );

        return;
    }


    /* =================================================
       BORRADOR LOCAL NORMAL
       ================================================= */

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


        campos.forEach(campo => {

            if (
                !campo.name ||
                !datos[campo.name]
            ) {

                return;

            }


            if (
                campo.type === 'checkbox' ||
                campo.type === 'radio'
            ) {

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


    /* =====================================================
       GUARDAR E IMPRIMIR
       ===================================================== */

    async function guardarEImprimir() {
    guardarBorrador();

    const datos = {};

    const campos = obtenerCampos();

    campos.forEach((campo, indice) => {
        const clave = campo.name || campo.id || `campo_${indice}`;

        if (campo.type === 'radio' || campo.type === 'checkbox') {
            datos[clave] = campo.checked;
        } else {
            datos[clave] = campo.value;
        }
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
                nombre_formulario: 'FICHA DE NOTIFICACIÓN DE ALERTA DECE',
                carpeta: document.getElementById('carpetaDestino')?.value || null,
                datos: datos
            })
        });
        window.print();

        const respuesta = await solicitud;

        const resultado = await respuesta.json();

        if (!respuesta.ok || !resultado.success) {
            if (resultado.datos_guardados) {
                console.error('El formulario se guardó sin PDF de respaldo:', resultado);
                alert(resultado.message);

                return;
            }

            throw new Error(
                resultado.message || 'No se pudo guardar el formulario.'
            );
        }

        console.log('Formulario guardado:', resultado);

    } catch (error) {
        console.error('Error al guardar:', error);

        alert('No se pudo guardar el formulario en el servidor.');
    }
}



/* =====================================================
   CARGAR DATOS DESDE EL SERVIDOR
   ===================================================== */

function cargarDatosServidor(datos) {

    if (!datos) {
        return;
    }

    const campos = obtenerCampos();

    campos.forEach(campo => {

        if (!campo.name) {
            return;
        }

        if (
            !Object.prototype.hasOwnProperty.call(
                datos,
                campo.name
            )
        ) {
            return;
        }

        const valor = datos[campo.name];

        if (
            campo.type === 'checkbox' ||
            campo.type === 'radio'
        ) {

            campo.checked = Boolean(valor);

        } else {

            campo.value = valor ?? '';

        }

    });

}



    /* =====================================================
       INICIAR
       ===================================================== */

    document.addEventListener(

    'DOMContentLoaded',

    function () {

        cargarBorrador();

        @if(isset($datos))
            cargarDatosServidor(@json($datos));
        @endif

        @if(isset($datosEditar))
            cargarDatosServidor(@json($datosEditar));
        @endif

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
