<?php
/**
 * PracticaModel.php
 * Se encarga de la lógica de negocio y acceso a datos para la tabla 'practicas'.
 */

class PracticaModel
{
    private $db;

    /**
     * Constructor que recibe la conexión PDO.
     * @param PDO $db Instancia de la conexión a la base de datos.
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Verifica si un usuario ya tiene una práctica activa (En Curso o Pendiente).
     * @param int $userId ID del usuario (fk_user_id de la tabla users).
     * @return array|null Datos de la práctica activa, o null si no existe.
     */
    public function getPracticaActivaByUserId(int $userId)
    {
        try {
            // Buscamos una práctica que no esté "Finalizada"
            $stmt = $this->db->prepare("
                SELECT p.*, m.nombre AS nombre_modalidad 
                FROM practicas p
                JOIN modalidades m ON p.fk_id_modalidad = m.id_modalidad
                WHERE p.fk_user_id = :userId 
                AND p.estado_practica IN ('Pendiente', 'En Curso')
                LIMIT 1
            ");
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener práctica activa: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Crea un nuevo registro de práctica.
     * @param int $userId ID del estudiante.
     * @param int $modalidadId ID de la modalidad seleccionada.
     * @param string $tutorNombre Nombre del tutor académico.
     * @param string $tutorEmail Email del tutor académico.
     * @return int|bool El ID de la práctica recién creada o false en caso de error.
     */
    public function createPractica(int $userId, int $modalidadId, string $tutorNombre, string $tutorEmail)
    {
        // Estado inicial de la práctica
        $estado = 'Pendiente'; 
        
        // La fecha de inicio y fin por defecto pueden ser nulas o una fecha inicial
        $fechaInicio = date('Y-m-d'); 
        $fechaFin = null; // Se establecerá cuando se formalice

        try {
            $sql = "INSERT INTO practicas (fk_user_id, fk_id_modalidad, tutor_academico_nombre, tutor_institucional_email, fecha_inicio, estado_practica)
                    VALUES (:userId, :modalidadId, :tutorNombre, :tutorEmail, :fechaInicio, :estado)";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':modalidadId', $modalidadId, PDO::PARAM_INT);
            $stmt->bindParam(':tutorNombre', $tutorNombre, PDO::PARAM_STR);
            $stmt->bindParam(':tutorEmail', $tutorEmail, PDO::PARAM_STR);
            $stmt->bindParam(':fechaInicio', $fechaInicio, PDO::PARAM_STR);
            $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
            
            $stmt->execute();

            return $this->db->lastInsertId();

        } catch (PDOException $e) {
            error_log("Error al crear la práctica: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * (Placeholder para el Paso 3) Actualiza la ruta del PDF una vez generado.
     */
     public function updatePracticaPdfPath(int $practicaId, string $pdfPath) {
        try {
            $stmt = $this->db->prepare("UPDATE practicas SET pdf_documento_path = :pdfPath WHERE id_practica = :practicaId");
            $stmt->bindParam(':pdfPath', $pdfPath, PDO::PARAM_STR);
            $stmt->bindParam(':practicaId', $practicaId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al actualizar PDF path: " . $e->getMessage());
            return false;
        }
    }
    
    // Aquí se añadirán más métodos para gestionar Entidades, Actividades, etc.
}