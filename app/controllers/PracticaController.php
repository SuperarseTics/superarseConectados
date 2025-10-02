<?php
/**
 * PracticaController.php
 * Gestiona todo el ciclo de vida de las Prácticas Pre-Profesionales (PPP).
 * Incluye la selección de modalidad (Paso 1), gestión de entidades (Paso 2),
 * y registro de actividades (Paso 4).
 */

// **AÑADIDO:** Cargamos la configuración (incluye BASE_URL)
require_once __DIR__ . '/../config/config.php';

require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../helpers/View.php';
require_once __DIR__ . '/../models/PracticaModel.php';
require_once __DIR__ . '/../models/ModalidadModel.php';

class PracticaController
{
    private $practicaModel;
    private $modalidadModel;

    public function __construct() {
        // Aseguramos que la sesión esté iniciada para obtener el ID del usuario.
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Verificación básica de autenticación
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'auth/login');
            exit();
        }
        
        // Obtener la conexión PDO una sola vez
        $dbConnection = Database::connect();
        
        $this->practicaModel = new PracticaModel($dbConnection);
        $this->modalidadModel = new ModalidadModel($dbConnection);
    }

    /**
     * Muestra el dashboard principal de las prácticas y el estado actual.
     * URL: /practica/dashboard
     */
    public function dashboard() {
        $userId = $_SESSION['user_id'];
        
        // 1. Verificar si el estudiante ya tiene una práctica activa
        $practicaActiva = $this->practicaModel->getPracticaActivaByUserId($userId);

        if ($practicaActiva) {
            // Si ya tiene una práctica, redirigir al seguimiento/resumen de la práctica
            // Por ahora, solo cargamos la vista de dashboard que mostrará el estado.
            $data = [
                'practica' => $practicaActiva,
                'mensaje' => 'Ya tienes una práctica en curso. Revisa el resumen de tus actividades.',
            ];
             View::render(__DIR__ . '/../views/practicas/resumen_practica.php', $data);
        } else {
            // Si no tiene práctica, lo dirigimos al Paso 1: Selección de Modalidad.
             $this->seleccionarModalidad();
        }
    }


    // --- PASO 1: SELECCIÓN DE MODALIDAD ---

    /**
     * Muestra la vista para que el estudiante escoja la modalidad de práctica.
     * URL: /practica/seleccionarModalidad
     */
    public function seleccionarModalidad() {
        // Obtiene la lista de modalidades de la base de datos
        $modalidades = $this->modalidadModel->getAllModalidades(); 

        $data = [
            'modalidades' => $modalidades,
            'user_id' => $_SESSION['user_id'],
        ];

        // Carga la vista para la selección
        View::render(__DIR__ . '/../views/practicas/seleccionar_modalidad.php', $data);
    }
    
    /**
     * Procesa la selección de la modalidad y genera el documento inicial.
     * URL: /practica/aceptarModalidad (Método POST)
     */
    public function aceptarModalidad() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
             header('Location: ' . BASE_URL . 'practica/dashboard');
             exit();
        }

        $userId = $_SESSION['user_id'];
        $modalidadId = $_POST['modalidad_id'] ?? null;
        // Asume que el tutor académico y su email se obtendrán de otra fuente (ej. tabla de profesores)
        // Por simplicidad, usaremos placeholders
        $tutorNombre = "Nataly Costa"; // Ejemplo, debería ser dinámico
        $tutorEmail = "nataly.costa@instituto.edu"; // Ejemplo, debería ser dinámico

        if (!$modalidadId) {
             header('Location: ' . BASE_URL . 'practica/seleccionarModalidad?error=no_modalidad');
             exit();
        }
        
        // 1. Crear el registro de la práctica
        $practicaId = $this->practicaModel->createPractica($userId, $modalidadId, $tutorNombre, $tutorEmail);
        
        if ($practicaId) {
             // 2. Lógica de Generación de PDF (Paso 1)
             // Nota: Aquí se llamaría a una librería (FPDF/TCPDF) para generar el PDF
             // y se guardaría la ruta en la tabla 'practicas' (método updatePracticaPdfPath).
             // Por ahora, solo mostramos un mensaje de éxito.
             
             // Redirigir al dashboard para ver el resumen de la práctica iniciada
             header('Location: ' . BASE_URL . 'practica/dashboard?success=inicio');
             exit();

        } else {
             header('Location: ' . BASE_URL . 'practica/seleccionarModalidad?error=guardar');
             exit();
        }
    }
    
    // --- Continúa con la implementación de Paso 2, Paso 3 y Paso 4 (Entidades, Plan, Actividades) ---
}
