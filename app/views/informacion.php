<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Estudiante</title>
    <link rel="icon" type="image/png" href="/assets/logos/logoSuperarse.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Superarse</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#" onclick="showSection('informacion')">Información del estudiante</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" onclick="showSection('programas')">Carreras y Asignaturas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" onclick="showSection('credenciales')">Credenciales</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" onclick="showSection('pagos')">Pagos</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Perfil</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/public/login">Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <div id="informacion" class="section-content">
            <h2>Información del Estudiante</h2>
            <h4>Datos del estudiante</h4>
            <table class="table table-bordered">
                <tbody id="tabla-informacion-estudiante"></tbody>
            </table>
        </div>

        <div id="programas" class="section-content">
            <h2>Carrera y Asignaturas</h2>
            <h4>Listado de Carreras y Asignaturas</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Carrera</th>
                        <th>Asignaturas</th>
                    </tr>
                </thead>
                <tbody id="tabla-asignaturas"></tbody>
            </table>
        </div>

        <div id="credenciales" class="section-content">
            <h2>Credenciales</h2>
            <h4>
                Información de Credenciales
            </h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Plataforma</th>
                        <th>Usuario</th>
                        <th>Contraseña
                        </th>
                    </tr>
                </thead>
                <tbody id="tabla-credenciales"></tbody>

            </table>
            <p>
                <small><strong>Nota:</strong> Las contraseñas proporcionadas son temporales y deben ser actualizadas por el usuario en el primer inicio de sesión para garantizar la seguridad de la cuenta.</small>
            </p>
        </div>

        <div id="pagos" class="section-content">
            <h2>Opciones de Pago</h2>
            <!-- Transferencias Bancarias -->
            <div class="mb-4">

                <h4>Pago por Transferencia Bancaria</h4>

                <p>Selecciona una de las siguientes cuentas para realizar tu transferencia:</p>



                <div class="btn-group mb-3" role="group" id="opciones-bancos">

                    <button type="button" class="btn btn-primary" data-id="produbanco">Banco del Produbanco</button>

                    <button type="button" class="btn btn-primary" data-id="guayaquil">Banco de Guayaquil</button>

                </div>



                <div id="info-cuenta-seleccionada" class="mt-3">

                </div>



                <p class="mt-3"><strong>Tipo de cuenta:</strong> Cuenta Corriente</p>

                <p><strong>Nombre del Beneficiario:</strong> Instituto Superior Tecnológico Superarse</p>



                <label for="transferencia-file" class="form-label mt-3">Sube tu comprobante de transferencia:</label>

                <input type="file" class="form-control" id="transferencia-file" accept="image/*">



                <a href="#" class="btn btn-primary mt-3 d-none" id="enviar-btn">Enviar Comprobante</a>

            </div>

            <!-- Payphone -->

            <div class="mb-4">

                <h4>Pago a través de Payphone</h4>

                <div class="row">
                    <div class="col-md-6">
                        <label for="cantidad" class="form-label mt-3">Cantidad:</label>
                        <input type="text" class="form-control" id="cantidad" placeholder="Ingresar el valor a pagar">
                    </div>

                    <div class="col-md-6">
                        <label for="referencia" class="form-label mt-3">Referencia:</label>
                        <input type="text" class="form-control" id="referencia" placeholder="Ej: Matias Valdivieso / Pago Cuota de febrero">
                    </div>
                </div>

                <p>Haz clic en el siguiente enlace para realizar tu pago con Payphone:</p>

                <a href="#" id="payphone-link" class="btn btn-primary">Pagar con Payphone</a>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // json_encode convierte el array de PHP en un objeto JSON que JS entiende
        const datosEstudiante = <?= json_encode($datos_estudiante) ?>;
    </script>

    <script src="/js/main.js"></script>

    <script src="/js/global.js"></script>

</body>

</html>