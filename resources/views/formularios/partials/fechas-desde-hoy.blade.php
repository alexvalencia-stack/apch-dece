<style>
    .fecha-impresa {
        display: none;
    }

    @media print {
        input[type="date"] {
            display: none !important;
        }

        .fecha-impresa {
            display: inline-block;
        }

        input[type="date"]::-webkit-calendar-picker-indicator {
            display: none;
        }

        input[type="date"].sin-fecha::-webkit-datetime-edit {
            visibility: hidden;
        }
    }
</style>
<script>
    (function () {
        function fechaDeHoy() {
            const ahora = new Date();
            const mes = String(ahora.getMonth() + 1).padStart(2, '0');
            const dia = String(ahora.getDate()).padStart(2, '0');

            return ahora.getFullYear() + '-' + mes + '-' + dia;
        }

        function marcarFechasVacias() {
            document.querySelectorAll('input[type="date"]').forEach(function (campo) {
                campo.classList.toggle('sin-fecha', !campo.value);
            });
        }

        function formatearFecha(valor) {
            const partes = /^(\d{4})-(\d{2})-(\d{2})$/.exec(valor || '');

            return partes ? partes[3] + '/' + partes[2] + '/' + partes[1] : '';
        }

        function sincronizarFechasImpresas() {
            document.querySelectorAll('input[type="date"]').forEach(function (campo) {
                let impresa = campo.nextElementSibling;

                if (!impresa || !impresa.classList.contains('fecha-impresa')) {
                    impresa = document.createElement('span');
                    impresa.className = 'fecha-impresa';
                    impresa.setAttribute('aria-hidden', 'true');
                    campo.insertAdjacentElement('afterend', impresa);
                }

                const estilo = getComputedStyle(campo);

                impresa.textContent = formatearFecha(campo.value);
                impresa.style.font = estilo.font;
                impresa.style.color = estilo.color;
            });
        }

        window.marcarFechasVacias = marcarFechasVacias;
        window.sincronizarFechasImpresas = sincronizarFechasImpresas;

        function actualizarFechas() {
            marcarFechasVacias();
            sincronizarFechasImpresas();
        }

        document.addEventListener('input', actualizarFechas);
        document.addEventListener('change', actualizarFechas);
        document.addEventListener('DOMContentLoaded', actualizarFechas);
        window.addEventListener('load', actualizarFechas);
        window.addEventListener('beforeprint', actualizarFechas);

        document.addEventListener('DOMContentLoaded', function () {
            const hoy = fechaDeHoy();

            document
                .querySelectorAll('input[type="date"][data-desde-hoy]')
                .forEach(function (campo) {
                    campo.min = hoy;

                    campo.addEventListener('change', function () {
                        if (campo.value && campo.value < hoy) {
                            campo.value = '';
                            campo.dispatchEvent(new Event('input', { bubbles: true }));
                            alert('No se puede elegir una fecha anterior a la actual.');
                        }
                    });
                });
        });
    })();
</script>
