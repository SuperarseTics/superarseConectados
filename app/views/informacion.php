<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>

    <!-- Barra de Navegación Superior Fija -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Superarse</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showSection('informacion')">Información de Usuario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showSection('programas')">Programas y Asignaturas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showSection('credenciales')">Credenciales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showSection('pagos')">Pagos</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Perfil
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/public/login">Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal con padding para la barra de navegación fija -->
    <div class="main-content">
        <!-- Información de Usuario -->
        <div id="informacion" class="section-content">
            <h2>Información del Usuario</h2>
            <h4>Datos del Usuario</h4>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Código de Matrícula</th>
                        <td><?= htmlspecialchars($informacionUsuario['codigo_matricula']) ?></td>
                    </tr>
                    <tr>
                        <th>Nombres</th>
                        <td><?= htmlspecialchars($informacionUsuario['nombres']) ?></td>
                    </tr>
                    <tr>
                        <th>Apellidos</th>
                        <td><?= htmlspecialchars($informacionUsuario['apellidos']) ?></td>
                    </tr>
                    <tr>
                        <th>Tipo de Identificación</th>
                        <td><?= htmlspecialchars($informacionUsuario['tipo_identificacion']) ?></td>
                    </tr>
                    <tr>
                        <th>Número de Identificación</th>
                        <td><?= htmlspecialchars($informacionUsuario['numero_identificacion']) ?></td>
                    </tr>
                    <tr>
                        <th>Estado</th>
                        <td><?= htmlspecialchars($informacionUsuario['estado']) ?></td>
                    </tr>
                    <tr>
                        <th>Programa</th>
                        <td><?= htmlspecialchars($informacionUsuario['programa']) ?></td>
                    </tr>
                    <tr>
                        <th>Periodo</th>
                        <td><?= htmlspecialchars($informacionUsuario['periodo']) ?></td>
                    </tr>
                    <tr>
                        <th>Nivel</th>
                        <td><?= htmlspecialchars($informacionUsuario['nivel']) ?></td>
                    </tr>
                    <tr>
                        <th>Usuario</th>
                        <td><?= htmlspecialchars($informacionUsuario['usuario']) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>


        <!-- Programas y Asignaturas -->
        <div id="programas" class="section-content">
            <h2>Programas y Asignaturas</h2>
            <h4>Listado de Programas y Asignaturas</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Programa</th>
                        <th>Asignaturas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($programa)): ?>
                        <tr>
                            <td><?= htmlspecialchars($programa['programa']) ?></td>
                            <td>
                                <?php
                                // Arrays para almacenar las asignaturas por nivel
                                $n1 = [];
                                $n2 = [];
                                $n3 = [];
                                $n4 = [];
                                $otros = []; // Para asignaturas sin nivel

                                // Iteramos sobre las asignaturas y las clasificamos
                                foreach ($asignaturas as $asignatura) {
                                    $nombre = htmlspecialchars($asignatura['nombre']);
                                    if (strpos($nombre, 'N1') !== false) {
                                        $n1[] = $nombre;
                                    } elseif (strpos($nombre, 'N2') !== false) {
                                        $n2[] = $nombre;
                                    } elseif (strpos($nombre, 'N3') !== false) {
                                        $n3[] = $nombre;
                                    } elseif (strpos($nombre, 'N4') !== false) {
                                        $n4[] = $nombre;
                                    } else {
                                        $otros[] = $nombre; // Asignaturas sin nivel
                                    }
                                }
                                ?>

                                <!-- Si hay asignaturas de N1, mostramos la lista de Nivel 1 -->
                                <?php if (!empty($n1)): ?>
                                    <ul>
                                        <strong>Nivel 1:</strong>
                                        <?php foreach ($n1 as $asignatura): ?>
                                            <li><?= $asignatura ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>

                                <!-- Si hay asignaturas de N2, mostramos la lista de Nivel 2 -->
                                <?php if (!empty($n2)): ?>
                                    <ul>
                                        <strong>Nivel 2:</strong>
                                        <?php foreach ($n2 as $asignatura): ?>
                                            <li><?= $asignatura ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>

                                <!-- Si hay asignaturas de N3, mostramos la lista de Nivel 3 -->
                                <?php if (!empty($n3)): ?>
                                    <ul>
                                        <strong>Nivel 3:</strong>
                                        <?php foreach ($n3 as $asignatura): ?>
                                            <li><?= $asignatura ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>

                                <!-- Si hay asignaturas de N4, mostramos la lista de Nivel 4 -->
                                <?php if (!empty($n4)): ?>
                                    <ul>
                                        <strong>Nivel 4:</strong>
                                        <?php foreach ($n4 as $asignatura): ?>
                                            <li><?= $asignatura ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>

                                <!-- Si hay asignaturas sin nivel, mostramos la lista de "Prácticas y Vinculación" -->
                                <?php if (!empty($otros)): ?>
                                    <ul>
                                        <strong>Prácticas y Vinculación:</strong>
                                        <?php foreach ($otros as $asignatura): ?>
                                            <li><?= $asignatura ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td colspan="2">No hay programas asignados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Credenciales -->
        <div id="credenciales" class="section-content">
            <h2>Credenciales</h2>
            <h4>Información de Credenciales</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Plataforma</th>
                        <th>Usuario</th>
                        <th>Contraseña</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($credenciales)): ?>
                        <?php foreach ($credenciales as $credencial): ?>

                            <tr>
                                <td>
                                    <?php
                                    $plataforma = htmlspecialchars($credencial['plataforma']);
                                    // Ruta predeterminada para el enlace
                                    $url = '#';
                                    $logo = ''; // Variable para la imagen

                                    // Condicional para asignar el enlace y la imagen adecuada según la plataforma
                                    if ($plataforma === 'Q10') {
                                        $url = 'https://superarse.q10.com';  // Enlace para Q10
                                        $logo = '/assets/logos/Q10.png'; // Ruta de la imagen
                                    } elseif ($plataforma === 'Office 365 /Teams') {
                                        $url = 'https://m365.cloud.microsoft/?auth=2'; // Enlace para Office 365/Teams
                                        $logo = '/assets/logos/Office365.png'; // Ruta de la imagen
                                    } elseif ($plataforma === 'eLibro') {
                                        $url = 'https://elibro.net/es/lc/superarse/login_usuario/?next=/es/lc/superarse/inicio/'; // Enlace para eLibro
                                        $logo = '/assets/logos/eLibro.png'; // Ruta de la imagen
                                    } else {
                                        $url = '#'; // Enlace por defecto
                                        $logo = '/assets/logos/logo-default.png'; // Imagen por defecto si la plataforma no es conocida
                                    }
                                    ?>

                                    <!-- Mostrar la imagen de la plataforma y el enlace -->
                                    <a href="<?= $url ?>" target="_blank">
                                        <img src="<?= $logo ?>" alt="<?= $plataforma ?>">
                                    </a> <!-- Enlace dinámico según la plataforma -->
                                </td>

                                <td><?= htmlspecialchars($informacionUsuario['usuario']) ?></td>
                                <td><?= htmlspecialchars($credencial['password_hash']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">No hay credenciales disponibles.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>


        <!-- Pagos -->
        <div id="pagos" class="section-content">
            <h2>Opciones de Pago</h2>

            <!-- Transferencias Bancarias -->
            <div class="mb-4">
                <h4>Pago por Transferencia Bancaria</h4>
                <p>Realiza una transferencia bancaria al siguiente número de cuenta:</p>
                <p><strong>Banco:</strong> Banco del Pichincha</p>
                <p><strong>Cuenta de Ahorros:</strong> 123-456-7890</p>
                <p><strong>RUC:</strong> 099999999999</p>
                <p><strong>Referencia de Pago:</strong> [Código de Matrícula]</p>
                <p><strong>Nombre del Beneficiario:</strong> Universidad XYZ</p>

                <label for="transferencia-file" class="form-label">Sube tu comprobante de transferencia:</label>
                <input type="file" class="form-control" id="transferencia-file" accept="image/*">
            </div>

            <!-- Payphone -->
            <div class="mb-4">
                <h4>Pago a través de Payphone</h4>
                <p>Haz clic en el siguiente enlace para realizar tu pago con Payphone:</p>
                <a href="https://link_de_payphone" target="_blank" class="btn btn-primary">Pagar con Payphone</a>
            </div>

            <!-- Código QR para Banco del Pichincha -->
            <div class="mb-4">
                <h4>Código QR para Banco del Pichincha</h4>
                <p>Escanea el siguiente código QR para realizar tu pago en el Banco del Pichincha:</p>
                <div class="alert alert-info" role="alert">
                    <strong>Información de Pago:</strong> Código de pago: 12345-6789
                </div>

                <!-- Código QR generado -->
                <img src="<?= $qrCodeUrl ?>" alt="Código QR Pago Banco Pichincha" class="img-fluid">
            </div>

        </div>
    </div>


    <!-- Scripts de Bootstrap y Función para Cambiar de Sección -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Función para mostrar la sección correspondiente
        function showSection(sectionId) {
            // Ocultar todas las secciones
            var sections = document.querySelectorAll('.section-content');
            sections.forEach(function(section) {
                section.style.display = 'none';
            });

            // Mostrar la sección seleccionada
            document.getElementById(sectionId).style.display = 'block';

            // Cerrar el menú después de hacer clic (en pantallas pequeñas)
            var navbarCollapse = document.getElementById("navbarNav");
            if (navbarCollapse.classList.contains("show")) {
                navbarCollapse.classList.remove("show");
            }
        }

        // Mostrar la primera sección por defecto
        document.addEventListener('DOMContentLoaded', function() {
            showSection('informacion');
        });
    </script>
</body>

</html>