<?php

require_once __DIR__ . '/../models/Database.php';


class LoginController
{
    private function getBaseUrl()
    {
        // Determina si se está usando HTTPS o HTTP
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

        // Obtiene el nombre del host
        $host = $_SERVER['HTTP_HOST'];

        // Define la ruta del subdirectorio
        $subfolder = '/superarseconectados/public';

        return $protocol . $host . $subfolder;
    }

    public function validar()
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cedula = $_POST['cedula'] ?? '';

            if (empty($cedula)) {
                header("Location: " . $this->getBaseUrl() . "/login?error=campos_vacios");
                exit();
            }

            $db = Database::connect();
            $stmt = $db->prepare("SELECT * FROM users WHERE numero_identificacion = ?");
            $stmt->execute([$cedula]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario) {
                $_SESSION['cedula'] = $cedula;
                // Redirección a la ruta correcta usando la URL base completa
                header("Location: " . $this->getBaseUrl() . "/informacion");
                exit();
            } else {
                header("Location: " . $this->getBaseUrl() . "/login?error=cedula_no_encontrada");
                exit();
            }
        } else {
            header("Location: " . $this->getBaseUrl() . "/login");
            exit();
        }
    }

    public function mostrarInformacion()
    {
        session_start();

        if (!isset($_SESSION['cedula'])) {
            header("Location: " . $this->getBaseUrl() . "/login");
            exit();
        }

        $cedula = $_SESSION['cedula'];
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE numero_identificacion = ?");
        $stmt->execute([$cedula]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            header("Location: " . $this->getBaseUrl() . "/login?error=usuario_no_encontrado");
            exit();
        }

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
        $credenciales = [
            ['plataforma' => 'Q10'],
            ['plataforma' => 'Office 365 /Teams'],
            ['plataforma' => 'eLibro']
        ];

        // --- Obtener los datos de pagos ---
        $datos_pagos = $this->obtenerPagos($cedula);

        $datos_estudiante = [
            'informacionUsuario' => $informacionUsuario,
            'programa' => $programaYAsignaturas['programa'],
            'asignaturas' => $programaYAsignaturas['asignaturas'],
            'credenciales' => $credenciales,
            'datos_pagos' => $datos_pagos
        ];

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

    // En tu archivo LoginController.php
    public function obtenerPagos($cedula_usuario)
    {
        $db = Database::connect();
        $sql = "SELECT * FROM pagos_estudiantes WHERE cedula = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$cedula_usuario]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $response = [
            'cuotas' => [],
            'abono_total' => $result['abono_total'] ?? null,
            'saldo_total' => $result['saldo_total'] ?? null, // <-- Asegúrate de que esta línea esté aquí
            'observacion' => $result['observacion'] ?? null
        ];

        $cuotas_map = [
            'cuota1_matricula',
            'cuota2',
            'cuota3',
            'cuota4',
            'cuota5',
            'cuota6',
            'cuota7',
            'cuota8'
        ];

        foreach ($cuotas_map as $key) {
            if (!empty($result[$key])) {
                $num_cuota = str_replace(['cuota', '_matricula'], '', $key);
                $pendiente_key = "pendiente_cuota{$num_cuota}";

                $response['cuotas'][] = [
                    'nombre' => ($key === 'cuota1_matricula') ? 'Cuota 1 (Matrícula)' : "Cuota {$num_cuota}",
                    'valor' => $result[$key],
                    'pendiente' => $result[$pendiente_key] ?? null
                ];
            }
        }
        return $response;
    }

    public function cerrarSesion()
    {
        session_start();
        session_destroy();
    }
}
