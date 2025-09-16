// Script para manejar la visualización del modal de error basado en parámetros de URL.
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const error = urlParams.get('error');
            const errorMessageElement = document.getElementById('errorMessage');

            if (error) {
                let message = "Ha ocurrido un error inesperado.";
                if (error === 'cedula_no_encontrada') {
                    message = "Estimado/a, la cédula ingresada no se encuentra registrada en nuestro sistema.<br><br>Para recibir más información sobre nuestras carreras, puede comunicarse al siguiente número de WhatsApp: <a href='https://wa.me/593987289072' target='_blank'><strong>098&nbsp;728&nbsp;9072</strong></a>.<br><br>Le invitamos a conocer nuestra <a href='https://superarse.edu.ec/' target='_blank'><strong>oferta académica</strong></a> y descubrir las oportunidades que tenemos para usted.";
                } else if (error === 'campos_vacios') {
                    message = "Debe ingresar la cédula.";
                }

                if (errorMessageElement) {
                    errorMessageElement.innerHTML = message;
                }

                const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();
            }
        });