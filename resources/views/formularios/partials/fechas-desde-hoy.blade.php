<style>
    @media print {
        input[type="date"]::-webkit-calendar-picker-indicator {
            display: none;
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
