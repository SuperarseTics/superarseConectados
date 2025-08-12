<?php

require_once __DIR__ . '/../models/Database.php';

class LoginController
{
    public function validar()
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cedula = $_POST['cedula'] ?? '';

            if (empty($cedula)) {
                header("Location: /public/login?error=campos_vacios");
                exit();
            }

            $db = Database::connect();
            $stmt = $db->prepare("SELECT * FROM users WHERE numero_identificacion = ?");
            $stmt->execute([$cedula]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario) {
                $_SESSION['cedula'] = $cedula;
                header("Location: /public/informacion");
                exit();
            } else {
                header("Location: /public/login?error=cedula_no_encontrada");
                exit();
            }
        } else {
            header("Location: /public/login");
            exit();
        }
    }

    public function mostrarInformacion()
{
    session_start();

    // Verificamos si hay sesión activa
    if (!isset($_SESSION['cedula'])) {
        header("Location: /public/login");
        exit();
    }

    // Recuperamos la cédula del usuario desde la sesión
    $cedula = $_SESSION['cedula'];

    // Conectamos a la base de datos
    $db = Database::connect();

    // Consultamos la información del usuario
    $stmt = $db->prepare("SELECT * FROM users WHERE numero_identificacion = ?");
    $stmt->execute([$cedula]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        echo "No se encontró la información del usuario.";
        exit();
    }

    // Formateamos los datos que necesitamos
    $informacionUsuario = [
        'codigo_matricula' => $usuario['codigo_matricula'], // Asumiendo que 'codigo_matricula' existe en la tabla
        'nombres' => $usuario['primer_nombre'] . ' ' . $usuario['segundo_nombre'], // Concatenamos los nombres
        'apellidos' => $usuario['primer_apellido'] . ' ' . $usuario['segundo_apellido'], // Concatenamos los apellidos
        'tipo_identificacion' => $usuario['tipo_identificacion'], // Tipo de identificación (por ejemplo, cédula, pasaporte)
        'numero_identificacion' => $usuario['numero_identificacion'], // El número de identificación
        'estado' => $usuario['estado'], // El estado del usuario
        'programa' => $usuario['programa'], // El programa al que pertenece el usuario
        'periodo' => $usuario['periodo'], // El periodo de estudios
        'nivel' => $usuario['nivel'], // El nivel académico
        'usuario' => $usuario['usuario'], // El nombre de usuario
    ];

    // Obtenemos el programa y las asignaturas
    $programaYAsignaturas = $this->obtenerProgramaYAsignaturas($informacionUsuario['programa']);
    $programa = $programaYAsignaturas['programa'];
    $asignaturas = $programaYAsignaturas['asignaturas'];

    // Obtenemos las credenciales del usuario
    $credenciales = $this->obtenerCredenciales($usuario['id']);

    // Pasamos los datos a la vista
    require_once __DIR__ . '/../helpers/View.php';
    View::render(__DIR__ . '/../views/informacion.php', [
        'informacionUsuario' => $informacionUsuario,
        'programa' => $programa,
        'asignaturas' => $asignaturas,
        'credenciales' => $credenciales
    ]);
}

    public function obtenerProgramaYAsignaturas($programaNombre)
    {
        // Conectamos a la base de datos
        $db = Database::connect();

        // Consultamos el programa en la tabla programas
        $stmtPrograma = $db->prepare("SELECT * FROM programas WHERE programa = ?");
        $stmtPrograma->execute([$programaNombre]);
        $programa = $stmtPrograma->fetch(PDO::FETCH_ASSOC);

        // Verificamos si el programa existe
        if (!$programa) {
            echo "No se encontró información sobre el programa.";
            exit();
        }

        // Consultamos las asignaturas asociadas a ese programa
        $stmtAsignaturas = $db->prepare("SELECT * FROM asignaturas WHERE programa_id = ?");
        $stmtAsignaturas->execute([$programa['id']]);
        $asignaturas = $stmtAsignaturas->fetchAll(PDO::FETCH_ASSOC);

        return ['programa' => $programa, 'asignaturas' => $asignaturas];
    }

    public function obtenerCredenciales($userId)
    {
        // Conectamos a la base de datos
        $db = Database::connect();

        // Consultamos las credenciales del usuario
        $stmtCredenciales = $db->prepare("SELECT * FROM credenciales WHERE user_id = ?");
        $stmtCredenciales->execute([$userId]);
        $credenciales = $stmtCredenciales->fetchAll(PDO::FETCH_ASSOC);

        return $credenciales;
    }

    public function cerrarSesion()
    {
        session_start();
        session_destroy();
        header("Location: /public/login");
        exit();
    }

    
}
