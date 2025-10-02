<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Prácticas</title>
    <!-- Incluye Bootstrap CSS para la estructura y diseño -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Incluye Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLMD/CDT8xIzQCE/zKxOqF6K61U/7BwFp/oVbA/oI/6aK+iA7l5/t+GzV5/b+A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" href="/superarseconectados/assets/logos/logoSuperarse.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="/superarseconectados/css/style.css">
    <!-- Estilos personalizados para imitar el look de sistema (estilo Banner/Oracle Forms) -->

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
                    <li class="nav-item"><a class="nav-link" target="_blank" href="/superarseconectados/public/practicas">Prácticas</a></li>
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
        <div id="practicas" class="row section-content">
            <div class="col-12">

                <h1 class="mb-4 text-center">Administración de prácticas pre profesionales del alumno</h1>

                <!-- Bloque de Administración de prácticas pre profesionales del estudiante -->
                <div class="panel-header mt-4">
                    Administración de prácticas pre profesionales del estudiante
                </div>
                <table class="table table-sm data-table mb-4">
                    <tbody>
                        <tr>
                            <th style="width: 30%;">ID Banner del estudiante</th>
                            <td>L00360035</td>
                        </tr>
                        <tr>
                            <th>Nombre del estudiante</th>
                            <td>AUCAY AUCAY, EDISON GONZALO</td>
                        </tr>
                        <tr>
                            <th>Cédula del estudiante</th>
                            <td>1723580401</td>
                        </tr>
                    </tbody>
                </table>

                <p class="text-muted">No registra prácticas pre profesionales. Si tiene dudas contáctese con el Coordinador de prácticas de su carrera</p>

                <!-- Pestañas de Navegación -->
                <ul class="nav nav-tabs" id="practicaTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="programa-tab" data-bs-toggle="tab" data-bs-target="#programa" type="button" role="tab" aria-controls="programa" aria-selected="true">Programa de trabajo</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="actividades-tab" data-bs-toggle="tab" data-bs-target="#actividades" type="button" role="tab" aria-controls="actividades" aria-selected="false">Actividades Realizadas</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="resultados-tab" data-bs-toggle="tab" data-bs-target="#resultados" type="button" role="tab" aria-controls="resultados" aria-selected="false">Resultados de aprendizaje</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="calificaciones-tab" data-bs-toggle="tab" data-bs-target="#calificaciones" type="button" role="tab" aria-controls="calificaciones" aria-selected="false">Calificaciones</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="manual-tab" data-bs-toggle="tab" data-bs-target="#manual" type="button" role="tab" aria-controls="manual" aria-selected="false">Manual de usuario</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="videos-tab" data-bs-toggle="tab" data-bs-target="#videos" type="button" role="tab" aria-controls="videos" aria-selected="false">Videos Tutoriales</button>
                    </li>
                </ul>

                <!-- Contenido de las Pestañas -->
                <div class="tab-content tab-content-panel" id="practicaTabsContent">

                    <!-- PESTAÑA: PROGRAMA DE TRABAJO (Simula la primera captura sin registros) -->
                    <div class="tab-pane fade show active" id="programa" role="tabpanel" aria-labelledby="programa-tab">

                        <!-- Simulación de la tabla de contenido -->
                        <div class="panel-header panel-header-small mb-2">Tabla de Contenido (Programa de Trabajo)</div>
                        <table class="table table-bordered table-striped table-sm data-table">
                            <thead class="bg-light">
                                <tr>
                                    <th>Actividad Realizada</th>
                                    <th>Departamento / Área</th>
                                    <th>Función Asignada</th>
                                    <th>Fecha de la actividad</th>
                                    <th>Editar item</th>
                                    <th>Eliminar item</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6" class="text-center">No hay registros.</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                    <!-- PESTAÑA: ACTIVIDADES REALIZADAS -->
                    <div class="tab-pane fade" id="actividades" role="tabpanel" aria-labelledby="actividades-tab">

                        <!-- Simulación de la tabla de actividades -->
                        <div class="panel-header panel-header-small mb-2">Tabla de Actividades</div>
                        <table class="table table-bordered table-striped table-sm data-table">
                            <thead class="bg-light">
                                <tr>
                                    <th>Actividad Realizada</th>
                                    <th>Número de horas</th>
                                    <th>Observación</th>
                                    <th>Fecha de la actividad</th>
                                    <th>Editar item</th>
                                    <th>Eliminar item</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6" class="text-center">No records found.</td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Totales y Recomendaciones (parte inferior de la captura) -->
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <table class="table table-sm data-table">
                                    <tbody>
                                        <tr>
                                            <th>Número de horas de la práctica actual:</th>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <th>Número total de horas de prácticas:</th>
                                            <td>160</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <div class="data-table" style="padding: 5px;">
                                    <label for="recomendaciones" class="fw-bold">Recomendaciones:</label>
                                    <textarea id="recomendaciones" class="form-control" rows="3" disabled>Ninguna recomendación disponible en este momento.</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PESTAÑA: RESULTADOS DE APRENDIZAJE -->
                    <div class="tab-pane fade" id="resultados" role="tabpanel" aria-labelledby="resultados-tab">
                        <div class="panel-header panel-header-small mb-2">Resultados de aprendizaje</div>
                        <table class="table table-bordered table-striped table-sm data-table">
                            <thead class="bg-light">
                                <tr>
                                    <th>Resultado de aprendizaje</th>
                                    <th>Calificación</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2" class="text-center">No records found.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- PESTAÑA: CALIFICACIONES -->
                    <div class="tab-pane fade" id="calificaciones" role="tabpanel" aria-labelledby="calificaciones-tab">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="panel-header">Calificación del tutor académico</div>
                                <div class="p-3 data-table">
                                    <p class="mb-0">Calificación total del tutor académico</p>
                                    <h4 class="text-center mt-2">N/A</h4>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="panel-header">Calificación total de las prácticas</div>
                                <div class="p-3 data-table">
                                    <p class="mb-0">Calificación total</p>
                                    <h4 class="text-center mt-2">N/A</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PESTAÑA: MANUAL DE USUARIO -->
                    <div class="tab-pane fade" id="manual" role="tabpanel" aria-labelledby="manual-tab">
                        <p>Contenido del Manual de Usuario aquí. Puedes agregar enlaces a documentos PDF.</p>
                        <a href="#" class="action-button"><i class="fas fa-file-pdf"></i> Descargar Manual</a>
                    </div>

                    <!-- PESTAÑA: VIDEOS TUTORIALES -->
                    <div class="tab-pane fade" id="videos" role="tabpanel" aria-labelledby="videos-tab">
                        <p>Lista de videos tutoriales para el manejo del sistema.</p>
                        <a href="#" class="action-button"><i class="fas fa-video"></i> Ver Video: Introducción al Proceso</a>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- Incluye Bootstrap JS (necesario para el funcionamiento de las pestañas y modales) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>