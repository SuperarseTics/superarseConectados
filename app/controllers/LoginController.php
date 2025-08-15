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

        if (!isset($_SESSION['cedula'])) {
            header("Location: /public/login");
            exit();
        }

        $cedula = $_SESSION['cedula'];
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE numero_identificacion = ?");
        $stmt->execute([$cedula]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            echo "No se encontró la información del usuario.";
            exit();
        }

        // Formatear los datos principales del usuario
        $informacionUsuario = [
            'codigo_matricula' => $usuario['codigo_matricula'] ?? null,
            'nombres' => ($usuario['primer_nombre'] ?? '') . ' ' . ($usuario['segundo_nombre'] ?? ''),
            'apellidos' => ($usuario['primer_apellido'] ?? '') . ' ' . ($usuario['segundo_apellido'] ?? ''),
            'tipo_identificacion' => $usuario['tipo_identificacion'] ?? null,
            'numero_identificacion' => $usuario['numero_identificacion'] ?? null,
            'estado' => $usuario['estado'] ?? null,
            'cond_matricula' => $usuario['cond_matricula'] ?? null,
            'programa' => $usuario['programa'] ?? null,
            'periodo' => $usuario['periodo'] ?? null,
            'nivel' => $usuario['nivel'] ?? null,
            'usuario' => $usuario['usuario'] ?? null,
        ];

        $programaYAsignaturas = $this->obtenerProgramaYAsignaturas($informacionUsuario['programa']);
        $credenciales = $this->obtenerCredenciales($usuario['id']);
        
        // Juntar todos los datos en un solo array para pasarlos a la vista
        $datos_estudiante = [
            'informacionUsuario' => $informacionUsuario,
            'programa' => $programaYAsignaturas['programa'],
            'asignaturas' => $programaYAsignaturas['asignaturas'],
            'credenciales' => $credenciales
        ];

        // Usamos el helper View y le pasamos el arreglo completo
        require_once __DIR__ . '/../helpers/View.php';
        View::render(__DIR__ . '/../views/informacion.php', ['datos_estudiante' => $datos_estudiante]);
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
