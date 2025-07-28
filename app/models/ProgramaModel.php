<?php
class ProgramaModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Obtener un programa por su nombre
    public function getProgramaByNombre($nombre) {
        $query = "SELECT * FROM programas WHERE nombre = :nombre";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
