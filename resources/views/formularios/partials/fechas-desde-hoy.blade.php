<style>
    @media print {
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

        window.marcarFechasVacias = marcarFechasVacias;

        document.addEventListener('input', marcarFechasVacias);
        document.addEventListener('change', marcarFechasVacias);
        window.addEventListener('load', marcarFechasVacias);
        window.addEventListener('beforeprint', marcarFechasVacias);

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
