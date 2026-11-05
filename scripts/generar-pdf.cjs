const fs = require('fs');
const path = require('path');
const puppeteer = require('puppeteer');

async function generarPDF() {
    const htmlPath = process.argv[2];
    const pdfPath = process.argv[3];

    if (!htmlPath || !pdfPath) {
        console.error(
            'Uso: node generar-pdf.cjs archivo.html archivo.pdf'
        );
        process.exit(1);
    }

    if (!fs.existsSync(htmlPath)) {
        console.error(
            'No existe el archivo HTML:',
            htmlPath
        );
        process.exit(1);
    }

    const html = fs.readFileSync(
        htmlPath,
        'utf8'
    );

    fs.mkdirSync(path.dirname(pdfPath), { recursive: true });

    const usarSandbox = process.env.PDF_SANDBOX === '1';

    const browser = await puppeteer.launch({
        headless: true,
        executablePath: process.env.CHROME_PATH || '/usr/bin/google-chrome',

        args: [
            ...(usarSandbox ? [] : ['--no-sandbox', '--disable-setuid-sandbox']),
            '--disable-dev-shm-usage'
        ]
    });

    try {

        const page = await browser.newPage();

        await page.evaluateOnNewDocument(() => {
            const storage = new Map();

            Object.defineProperty(window, 'localStorage', {
                configurable: true,
                value: {
                    get length() {
                        return storage.size;
                    },
                    clear() {
                        storage.clear();
                    },
                    getItem(key) {
                        return storage.get(String(key)) ?? null;
                    },
                    key(index) {
                        return Array.from(storage.keys())[index] ?? null;
                    },
                    removeItem(key) {
                        storage.delete(String(key));
                    },
                    setItem(key, value) {
                        storage.set(String(key), String(value));
                    }
                }
            });
        });

        /*
        |--------------------------------------------------------------------------
        | Cargar HTML
        |--------------------------------------------------------------------------
        */

        await page.setContent(
            html,
            {
                waitUntil: 'domcontentloaded',
                timeout: 10000
            }
        );

        const camposAplicados = await page.evaluate(() => {
            const elementoDatos = document.getElementById('datos-formulario-pdf');

            if (!elementoDatos) {
                throw new Error('No se encontraron los datos para generar el PDF.');
            }

            const datos = JSON.parse(elementoDatos.textContent);
            let aplicados = 0;

            const aplicarDato = (campo, dato) => {
                if (!campo || dato === undefined || dato === null) {
                    return;
                }

                const esRegistro = typeof dato === 'object' && !Array.isArray(dato);
                const tienePropiedad = nombre =>
                    esRegistro && Object.prototype.hasOwnProperty.call(dato, nombre);

                let valor = dato;

                if (tienePropiedad('checked')) {
                    valor = dato.checked;
                } else if (tienePropiedad('valor')) {
                    valor = dato.valor;
                } else if (tienePropiedad('value')) {
                    valor = dato.value;
                }

                if (campo.type === 'checkbox') {
                    campo.checked = Boolean(valor);
                } else if (campo.type === 'radio') {
                    campo.checked = typeof valor === 'boolean'
                        ? valor
                        : campo.value === String(valor ?? '');
                } else {
                    campo.value = valor ?? '';
                }

                aplicados++;
            };

            if (Array.isArray(datos)) {
                const campos = Array.from(document.querySelectorAll('.page input'));

                datos.forEach((dato, indice) => {
                    const indiceCampo = Number.isInteger(dato?.index) ? dato.index : indice;
                    aplicarDato(campos[indiceCampo], dato);
                });
            } else if (datos && datos.campos && typeof datos.campos === 'object') {
                const campos = Array.from(
                    document.querySelectorAll('.page input, .page textarea')
                );

                campos.forEach((campo, indice) => {
                    if (campo.closest('.dynamic-action-row, .dynamic-follow-row')) {
                        return;
                    }

                    if (Object.prototype.hasOwnProperty.call(datos.campos, indice)) {
                        aplicarDato(campo, datos.campos[indice]);
                    }
                });

                if (datos.filas && typeof window.cargarFilasDinamicas !== 'function') {
                    throw new Error('No se pudieron restaurar las filas del formulario.');
                }

                if (datos.filas) {
                    window.cargarFilasDinamicas(datos.filas);
                }
            } else if (datos && typeof datos === 'object') {
                const campos = Array.from(
                    document.querySelectorAll('.page input, .page textarea, .page select')
                );

                campos.forEach(campo => {
                    const clave = campo.name || campo.id;

                    if (clave && Object.prototype.hasOwnProperty.call(datos, clave)) {
                        aplicarDato(campo, datos[clave]);
                    }
                });
            }

            return aplicados;
        });

        if (camposAplicados === 0) {
            throw new Error('No se pudieron aplicar los datos del formulario al PDF.');
        }

        /*
        |--------------------------------------------------------------------------
        | Esperar fuentes y ejecución visual del formulario
        |--------------------------------------------------------------------------
        */

        await page.evaluate(
            async () => {

                if (document.fonts) {
                    await document.fonts.ready;
                }

                await new Promise(resolve => {

                    requestAnimationFrame(() => {

                        requestAnimationFrame(resolve);

                    });

                });

            }
        );

        /*
        |--------------------------------------------------------------------------
        | Dar tiempo adicional al JavaScript del formulario
        |--------------------------------------------------------------------------
        */

        /*
        |--------------------------------------------------------------------------
        | Usar estilos de impresión
        |--------------------------------------------------------------------------
        */
       /*
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
*/

        await page.emulateMediaType(
            'print'
        );

        await page.evaluate(() => {
            if (typeof window.ajustarCamposMultilinea === 'function') {
                window.ajustarCamposMultilinea();
            }

            if (typeof window.prepararHistoriaParaImpresion === 'function') {
                window.prepararHistoriaParaImpresion();
            }
        });

        /*
        |--------------------------------------------------------------------------
        | Generar PDF
        |--------------------------------------------------------------------------
        */

        await page.pdf({

            path: pdfPath,

            format: 'A4',

            printBackground: true,

            preferCSSPageSize: true,

            margin: {
                top: '0',
                right: '0',
                bottom: '0',
                left: '0'
            }

        });

        if (!fs.existsSync(pdfPath) || fs.statSync(pdfPath).size === 0) {
            throw new Error('El PDF generado está vacío.');
        }

        console.log(
            'PDF generado correctamente:'
        );

        console.log(
            pdfPath
        );

    } finally {

        /*
        |--------------------------------------------------------------------------
        | Cerrar Chrome
        |--------------------------------------------------------------------------
        */

        await browser.close();

        /*
        |--------------------------------------------------------------------------
        | Eliminar HTML temporal
        |--------------------------------------------------------------------------
        */

        try {

            if (fs.existsSync(htmlPath)) {

                fs.unlinkSync(
                    htmlPath
                );

                console.log(
                    'HTML temporal eliminado.'
                );

            }

        } catch (error) {

            console.error(
                'No se pudo eliminar el HTML temporal:',
                error.message
            );

        }

    }
}

/*
|--------------------------------------------------------------------------
| Manejo de errores
|--------------------------------------------------------------------------
*/

generarPDF().catch(
    error => {

        console.error(
            'Error generando PDF:'
        );

        console.error(
            error
        );

        process.exit(1);

    }
);
