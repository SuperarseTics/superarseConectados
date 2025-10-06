<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Estudiante</title>
    <link rel="icon" type="image/png" href="/superarseconectados/assets/logos/logoSuperarse.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="/superarseconectados/css/style.css">
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
                    <li class="nav-item"><a class="nav-link" href="#" onclick="showSection('practicas')">Prácticas</a></li>
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

        <div id="practicas" class="section-content">
            <h2>Administración de prácticas pre profesionales</h2>
            <!-- Pestañas de Navegación por Fases -->
            <ul class="nav nav-tabs" id="practicaFasesTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="fase1-tab" data-bs-toggle="tab" data-bs-target="#fase1" type="button" role="tab" aria-controls="fase1" aria-selected="true">
                        <i class="fas fa-file-signature"></i> Fase 1 - Inicio del proceso
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="fase2-tab" data-bs-toggle="tab" data-bs-target="#fase2" type="button" role="tab" aria-controls="fase2" aria-selected="false">
                        <i class="fas fa-tasks"></i> Fase 2 - Planificación
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="fase3-tab" data-bs-toggle="tab" data-bs-target="#fase3" type="button" role="tab" aria-controls="fase3" aria-selected="false">
                        <i class="fas fa-calendar-check"></i> Fase 3 - Desarrollo y Cierre
                    </button>
                </li>
            </ul>

            <!-- Contenido de las Pestañas de Fases -->
            <div class="tab-content tab-content-panel" id="practicaFasesTabsContent">
                <!-- FASE I: INICIO DEL PROCESO (Formulario de Registro/Solicitud) -->
                <div class="tab-pane fade show active" id="fase1" role="tabpanel" aria-labelledby="fase1-tab">
                    <h4 class="text-primary mb-4">Fase 1 - Inicio del proceso de prácticas pre profesionales del estudiante</h4>
                    <div class="panel-header mb-0">Datos del estudiante</div>
                    <div class="data-table p-3 mb-4">
                        <!-- Estructura replicada de 'fase 1.jpeg' -->
                        <form>
                            <div class="row mb-3">
                                <div class="col-md-6"><label class="form-label">ID Banner del estudiante:</label></div>
                                <div class="col-md-6"><input type="text" class="form-control" value="L00360035" disabled></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6"><label class="form-label">Nombre completo:</label></div>
                                <div class="col-md-6"><input type="text" class="form-control" value="AUCAY AUCAY, EDISON GONZALO" disabled></div>
                            </div>
                            <!-- Nuevos campos de selección y contacto -->
                            <div class="row mb-3">
                                <div class="col-md-6"><label for="selectNivel" class="form-label">Nivel:</label></div>
                                <div class="col-md-6"><select id="selectNivel" class="form-select">
                                        <option>Seleccione un nivel</option>
                                    </select></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6"><label for="selectPeriodo" class="form-label">Escoja el periodo:</label></div>
                                <div class="col-md-6"><select id="selectPeriodo" class="form-select">
                                        <option>Seleccione un periodo</option>
                                    </select></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6"><label for="selectPractica" class="form-label">Escoja la práctica:</label></div>
                                <div class="col-md-6"><select id="selectPractica" class="form-select">
                                        <option>Seleccione una práctica</option>
                                    </select></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6"><label for="inputTelefono" class="form-label">Teléfono:</label></div>
                                <div class="col-md-6"><input type="text" id="inputTelefono" class="form-control" value="593 02285495 5938" disabled></div>
                            </div>
                            <h4 class="mt-4 text-center">Práctica preprofesional no remunerada, pasantía o ayuda a la comunidad</h4>
                            <!-- Campos de Tutor Académico y Empresa replicados de 'fase 1.1.jpeg' -->
                            <div class="row mb-3">
                                <div class="col-md-6"><label for="selectTutorAcademico" class="form-label">Sugiera un docente como tutor académico:</label></div>
                                <div class="col-md-6"><select id="selectTutorAcademico" class="form-select">
                                        <option>Seleccione un tutor académico</option>
                                    </select></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6"><label for="selectEmpresa" class="form-label">Empresa:</label></div>
                                <div class="col-md-6"><select id="selectEmpresa" class="form-select">
                                        <option>Seleccione una empresa</option>
                                        <option>QUESA GUASUMBINI ALTO</option>
                                    </select></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6"><label for="inputCedulaTutor" class="form-label">Cédula Tutor Empresarial:</label></div>
                                <div class="col-md-6"><input type="text" id="inputCedulaTutor" class="form-control" required></div>
                            </div>
                            <!-- ... más campos como Nombre del tutor empresarial, Función, Teléfono, Email, Departamento ... -->

                            <div class="d-flex justify-content-end mt-4">
                                <button type="button" class="btn btn-primary action-button rounded-pill"><i class="fas fa-search"></i> Ver opciones de práctica</button>
                                <button type="submit" class="btn btn-success action-button rounded-pill"><i class="fas fa-play"></i> Iniciar práctica</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- FASE II: PLANIFICACIÓN -->
                <div class="tab-pane fade" id="fase2" role="tabpanel" aria-labelledby="fase2-tab">
                    <h4 class="text-info mb-4">Fase 2 de prácticas pre profesionales - Planificación</h4>
                    <div class="panel-header mb-0">Datos del estudiante</div>
                    <div class="data-table p-3 mb-4">
                        <!-- Estructura replicada de 'fase 2.jpeg' -->
                        <table class="table table-sm mb-0">
                            <tbody>
                                <tr>
                                    <th style="width: 30%;">Nombre:</th>
                                    <td>AUCAY AUCAY, EDISON GONZALO</td>
                                </tr>
                                <tr>
                                    <th>Carrera:</th>
                                    <td>ING COMERCIAL</td>
                                </tr>
                                <tr>
                                    <th>Periodo académico:</th>
                                    <td><input type="text" class="form-control form-control-sm" placeholder="Pendiente"></td>
                                </tr>
                                <tr>
                                    <th>Tipo de práctica:</th>
                                    <td><input type="text" class="form-control form-control-sm" placeholder="Pendiente"></td>
                                </tr>
                                <tr>
                                    <th>Número de créditos aprobados:</th>
                                    <td><input type="text" class="form-control form-control-sm" placeholder="Pendiente"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="alert alert-warning mt-4">
                        <i class="fas fa-exclamation-triangle"></i> **Nota:** La información detallada del plan de trabajo (actividades planificadas) se encontrará en la **Fase 3 - Programa de trabajo** una vez que este sea aprobado.
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="#" class="btn btn-secondary action-button rounded-pill"><i class="fas fa-video"></i> Video tutorial: Estudiantes</a>
                    </div>
                </div>
                <!-- FASE III: DESARROLLO Y CIERRE -->
                <div class="tab-pane fade" id="fase3" role="tabpanel" aria-labelledby="fase3-tab">
                    <h4 class="text-success mb-4">Fase 3 - Administración de prácticas pre profesionales del alumno</h4>
                    <!-- Bloque de Información del Estudiante -->
                    <div class="panel-header mb-0">Administración de prácticas pre profesionales del estudiante</div>
                    <div class="data-table mb-4 p-3">
                        <table class="table table-sm mb-0">
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
                    </div>
                    <p class="alert alert-danger text-center" id="no-practicas-msg">
                        No registra prácticas pre profesionales. Si tiene dudas contáctese con el Coordinador de prácticas de su carrera
                    </p>
                    <!-- Sub-Navegación dentro de la Fase III -->
                    <ul class="nav nav-tabs" id="registroTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="sub-programa-tab" data-bs-toggle="pill" data-bs-target="#sub-programa" type="button" role="tab" aria-controls="sub-programa" aria-selected="true">Programa de trabajo</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="sub-actividades-tab" data-bs-toggle="pill" data-bs-target="#sub-actividades" type="button" role="tab" aria-controls="sub-actividades" aria-selected="false">Actividades Realizadas</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="sub-resultados-tab" data-bs-toggle="pill" data-bs-target="#sub-resultados" type="button" role="tab" aria-controls="sub-resultados" aria-selected="false">Resultados de aprendizaje</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="sub-calificaciones-tab" data-bs-toggle="pill" data-bs-target="#sub-calificaciones" type="button" role="tab" aria-controls="sub-calificaciones" aria-selected="false">Calificaciones</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="sub-manual-tab" data-bs-toggle="pill" data-bs-target="#sub-manual" type="button" role="tab" aria-controls="sub-manual" aria-selected="false">Manual de usuario</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="sub-videos-tab" data-bs-toggle="pill" data-bs-target="#sub-videos" type="button" role="tab" aria-controls="sub-videos" aria-selected="false">Videos Tutoriales</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="registroTabsContent">
                        <!-- 3.1 PROGRAMA DE TRABAJO -->
                        <div class="tab-pane fade show active" id="sub-programa" role="tabpanel" aria-labelledby="sub-programa-tab">
                            <p class="text-muted mt-3">Detalle de las actividades planificadas para tu práctica.</p>
                            <table class="table table-bordered table-striped table-sm">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Actividad Realizada</th>
                                        <th>Departamento / Área</th>
                                        <th>Función Asignada</th>
                                        <th>Fecha de la actividad</th>
                                        <th class="text-center">Editar item</th>
                                        <th class="text-center">Eliminar item</th>
                                    </tr>
                                </thead>
                                <tbody id="programa-trabajo-fase3-body">
                                    <tr>
                                        <td colspan="6" class="text-center text-secondary">No hay registros de programa de trabajo.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- 3.2 ACTIVIDADES REALIZADAS -->
                        <div class="tab-pane fade" id="sub-actividades" role="tabpanel" aria-labelledby="sub-actividades-tab">
                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-success btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#registroActividadModal"><i class="fas fa-plus-circle"></i> Registrar Nueva Actividad</button>
                            </div>
                            <table class="table table-bordered table-striped table-sm data-table mt-3">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Actividad Realizada</th>
                                        <th>Número de horas</th>
                                        <th>Observación</th>
                                        <th>Fecha de la actividad</th>
                                        <th class="text-center">Editar item</th>
                                        <th class="text-center">Eliminar item</th>
                                    </tr>
                                </thead>
                                <tbody id="actividades-realizadas-body">
                                    <!-- Contenido cargado por JavaScript -->
                                </tbody>
                            </table>
                            <!-- Totales de Horas y Recomendaciones -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <table class="table table-sm">
                                        <tbody>
                                            <tr>
                                                <th style="width: 35%;">Número de horas de la práctica actual:</th>
                                                <td><span id="horas-actuales">0</span></td>
                                            </tr>
                                            <tr>
                                                <th>Número total de horas de prácticas:</th>
                                                <td><span id="horas-totales">160</span></td>
                                            </tr>
                                            <tr>
                                                <th>Recomendaciones:</th>
                                                <td><textarea id="recomendaciones" class="form-control" rows="1" disabled></textarea></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- 3.3 RESULTADOS DE APRENDIZAJE -->
                        <div class="tab-pane fade" id="sub-resultados" role="tabpanel" aria-labelledby="sub-resultados-tab">
                            <p class="text-muted mt-3">Módulo para la evaluación de los resultados de aprendizaje obtenidos en la práctica.</p>
                            <table class="table table-bordered table-striped table-sm">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Resultado de aprendizaje</th>
                                        <th style="width: 20%;">Calificación</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="2" class="text-center text-secondary">No hay resultados de aprendizaje cargados para calificación.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- 3.4 CALIFICACIONES -->
                        <div class="tab-pane fade" id="sub-calificaciones" role="tabpanel" aria-labelledby="sub-calificaciones-tab">
                            <p class="text-muted mt-3">Calificaciones finales de la práctica preprofesional.</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="calificacion-box">
                                        <h5 class="text-center fw-bold">Calificación del tutor académico</h5>
                                        <div class="p-3 text-center border mt-2">
                                            <p class="mb-0">Calificación total del tutor académico</p>
                                            <h2 class="text-danger fw-bold">0.00</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="calificacion-box">
                                        <h5 class="text-center fw-bold">Calificación total de las prácticas</h5>
                                        <div class="p-3 text-center border mt-2">
                                            <p class="mb-0">Calificación total</p>
                                            <h2 class="text-danger fw-bold">N/A</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 3.5 MANUAL DE USUARIO -->
                        <div class="tab-pane fade" id="sub-manual" role="tabpanel" aria-labelledby="sub-manual-tab">
                            <p class="alert alert-light mt-3">Documentos de referencia y ayuda.</p>
                            <a href="#" class="btn btn-info action-button text-white rounded-pill"><i class="fas fa-file-pdf"></i> Descargar Reglamento</a>
                        </div>
                        <!-- 3.6 VIDEOS TUTORIALES -->
                        <div class="tab-pane fade" id="sub-videos" role="tabpanel" aria-labelledby="sub-videos-tab">
                            <p class="alert alert-light mt-3">Enlaces a videos instructivos para tu práctica.</p>
                            <a href="#" class="btn btn-warning action-button rounded-pill"><i class="fas fa-video"></i> Ver Tutorial de Registro de Actividades</a>
                            <a href="#" class="btn btn-warning action-button rounded-pill"><i class="fas fa-video"></i> Video Tutorial: Estudiantes</a>
                        </div>
                    </div>
                </div>
            </div>
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
            <div id="info-pagos" class="mb-4">
                <h4>Resumen de Pagos</h4>
                <div id="tabla-pagos-container" class="mt-3"></div>
                <p class="mt-3"><strong>Abono Total:</strong> $<span id="abono-total"></span></p>
                <p class="mt-3"><strong>Saldo Pendiente Por Pagar:</strong> $<span id="saldo-total"></span></p>
                <p><strong>Observación Cuotas Cubiertas:</strong> <span id="observacion"></span></p>
            </div>
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

    <!-- MODAL PARA REGISTRAR ACTIVIDAD (Se mantiene en la Fase III) -->
    <div class="modal fade" id="registroActividadModal" tabindex="-1" aria-labelledby="registroActividadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content rounded-lg">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="registroActividadModalLabel"><i class="fas fa-tasks"></i> Registrar Nueva Actividad Realizada</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formulario-registro-actividad">
                        <div class="mb-3">
                            <label for="inputActividad" class="form-label fw-bold">Actividad Realizada (Descripción detallada)</label>
                            <textarea class="form-control" id="inputActividad" rows="3" required placeholder="Ej: Configuración del servidor de desarrollo y despliegue del ambiente de pruebas."></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="inputHoras" class="form-label fw-bold">Número de Horas</label>
                                <input type="number" class="form-control" id="inputHoras" min="1" required placeholder="Ej: 8">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="inputFecha" class="form-label fw-bold">Fecha de la Actividad</label>
                                <input type="date" class="form-control" id="inputFecha" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="inputObservacion" class="form-label fw-bold">Observaciones (Opcional)</label>
                            <input type="text" class="form-control" id="inputObservacion" placeholder="Ej: La actividad fue supervisada por el tutor empresarial.">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success rounded-pill" form="formulario-registro-actividad">Guardar Registro</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // json_encode convierte el array de PHP en un objeto JSON que JS entiende
        const datosEstudiante = <?= json_encode($datos_estudiante) ?>;
    </script>
    <script src="/superarseconectados/js/main.js"></script>
    <script src="/superarseconectados/js/global.js"></script>
    <!--<script src="/superarseconectados/js/practicas.js"></script>-->
</body>

</html>