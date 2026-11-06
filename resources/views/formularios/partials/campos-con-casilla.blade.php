<style>
    [data-casilla]:disabled {
        background: #ececec;
        color: #000;
        -webkit-text-fill-color: #000;
        opacity: 1;
        cursor: not-allowed;
    }

    [data-casilla].campo-activo,
    [data-casilla].campo-activo:focus {
        background: #fff6cc;
        outline: 1px solid #d9a400;
    }

    @media print {
        [data-casilla],
        [data-casilla]:disabled,
        [data-casilla].campo-activo,
        [data-casilla].campo-activo:focus {
            background: transparent !important;
            outline: none !important;
        }
    }
</style>
<script>
    (function () {
        function sincronizarCamposConCasilla() {
            document.querySelectorAll('[data-casilla]').forEach(function (campo) {
                const casilla = document.querySelector(
                    'input[type="checkbox"][name="' + campo.dataset.casilla + '"]'
                );
                const activo = Boolean(casilla && casilla.checked);

                campo.disabled = !activo;
                campo.classList.toggle('campo-activo', activo);
            });
        }

        window.sincronizarCamposConCasilla = sincronizarCamposConCasilla;

        document.addEventListener('change', function (evento) {
            const casilla = evento.target;

            if (!casilla.matches('input[type="checkbox"]')) {
                return;
            }

            const campos = document.querySelectorAll('[data-casilla="' + casilla.name + '"]');

            if (campos.length === 0) {
                return;
            }

            if (!casilla.checked) {
                campos.forEach(function (campo) {
                    campo.value = '';
                    campo.dispatchEvent(new Event('input', { bubbles: true }));
                });
            }

            sincronizarCamposConCasilla();

            if (casilla.checked) {
                campos[0].focus();
            }
        });

        document.addEventListener('DOMContentLoaded', sincronizarCamposConCasilla);
        window.addEventListener('load', sincronizarCamposConCasilla);
    })();
</script>
