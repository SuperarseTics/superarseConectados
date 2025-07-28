<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conectados Superarse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMz4z5j6b6a5l5e5f5e5f5e5f">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>

    <!-- Header -->
    <header class="bg-primary text-white text-center py-4">
        <img src="/assets/logos/logoSuperarse.png" alt="Logo de Superarse" class="logo mb-2" style="max-width: 150px;">
        <h1 class="h3">Instituto Superarse</h1>
        <p>Plataforma Conectados</p>
    </header>

    <!-- Main container -->
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 60vh;">
        <div class="w-100" style="max-width: 400px;">
            <h2 class="text-center mb-4">Iniciar Sesión</h2>
            <form action="/public/login/validar" method="POST">
                <div class="mb-3">
                    <label for="cedula" class="form-label">Cédula</label>
                    <input type="text" class="form-control" id="cedula" name="cedula" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Ingresar</button>
            </form>
        </div>
    </div>

    <!-- Modal de errores -->
    <?php if (isset($_GET['error'])): ?>
        <div class="modal fade show" style="display:block;" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Error</h5>
                    </div>
                    <div class="modal-body">
                        <p>
                            <?php
                            if ($_GET['error'] === 'cedula_no_encontrada') {
                                echo "La cédula no se encuentra registrada.";
                            } elseif ($_GET['error'] === 'campos_vacios') {
                                echo "Debe ingresar la cédula.";
                            } else {
                                echo "Ha ocurrido un error.";
                            }
                            ?>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <a href="/public/login" class="btn btn-secondary">Cerrar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    <?php endif; ?>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-4">
        <p>&copy; <?php echo date("Y"); ?> Instituto Superarse. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
