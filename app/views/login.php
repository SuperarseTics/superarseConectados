<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conectados Superarse - Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Usando Font Awesome según tu HTML -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Enlace al archivo de estilos externo -->
    <link rel="stylesheet" href="/css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">

    <header class="text-white text-center py-3 shadow-sm">
        <div class="container">
            <img src="/assets/logos/logoSuperarse.png" onerror="this.onerror=null; this.src='/assets/logos/logoSuperarse.png';" alt="Logo de Superarse" class="logo img-fluid mb-2">
            <p class="lead mb-0">Plataforma Conectados</p>
        </div>
    </header>

    <main class="flex-grow-1 d-flex justify-content-center align-items-center py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5 col-xl-4">
                    <div class="card shadow-lg p-4 p-md-5">
                        <div class="card-body">
                            <h2 class="card-title text-center mb-4 fs-3">Iniciar Sesión</h2>
                            <!-- La acción del formulario ha sido restaurada para apuntar al validador. -->
                            <form action="/public/login/validar" method="POST">
                                <div class="mb-3">
                                    <label for="cedula" class="form-label visually-hidden">Cédula</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        <input type="text" class="form-control form-control-lg" id="cedula" name="cedula" placeholder="Ingresa tu cédula" required>
                                    </div>
                                </div>
                                <div class="d-grid gap-2">
                                    <!-- El botón es de tipo submit para enviar la información al validador. -->
                                    <button type="submit" class="btn btn-primary btn-lg">Ingresar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- La estructura del modal de error está lista para ser activada por la validación PHP. -->
    <!-- Para propósitos de demostración, el modal se muestra si la URL contiene "?error=true". -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="errorModalLabel"><i class="fas fa-exclamation-triangle"></i> Error</h5>
                </div>
                <div class="modal-body text-center">
                    <p class="lead mb-0" id="errorMessage"></p>
                </div>
                <div class="modal-footer justify-content-center">
                    <!-- El botón para cerrar el modal. -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <div class="container">
            <p class="mb-0">&copy; 2024 Instituto Superarse. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        // Script para manejar la visualización del modal de error basado en parámetros de URL.
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const error = urlParams.get('error');
            const errorMessageElement = document.getElementById('errorMessage');

            if (error) {
                let message = "Ha ocurrido un error inesperado.";
                if (error === 'cedula_no_encontrada') {
                    message = "La cédula no se encuentra registrada.";
                } else if (error === 'campos_vacios') {
                    message = "Debe ingresar la cédula.";
                }
                
                if (errorMessageElement) {
                    errorMessageElement.innerText = message;
                }

                const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();
            }
        });
    </script>
</body>

</html>