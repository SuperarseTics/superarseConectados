<?php
class AsignaturaModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Obtener asignaturas por el nombre del programa
    public function getAsignaturasByProgramaNombre($programaNombre) {
        $query = "SELECT * FROM asignaturas WHERE programa = :programa";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':programa', $programaNombre);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
