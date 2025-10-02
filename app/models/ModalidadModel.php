<?php
/**
 * ModalidadModel.php
 * Se encarga de la lógica de negocio y acceso a datos para la tabla 'modalidades'.
 */

class ModalidadModel
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
     * Obtiene todas las modalidades de práctica disponibles.
     * @return array Lista de modalidades.
     */
    public function getAllModalidades()
    {
        try {
            $stmt = $this->db->prepare("SELECT id_modalidad, nombre FROM modalidades ORDER BY nombre");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // En un entorno de producción, esto debería ir a un logger, no a die().
            error_log("Error al obtener modalidades: " . $e->getMessage());
            return [];
        }
    }
}