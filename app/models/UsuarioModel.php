<?php
class UsuarioModel {
    private $db;

    public function __construct() {
        $this->db = new Database();  // Asegúrate de tener una clase Database para la conexión
    }

    // Obtener un usuario por ID
    public function getUsuarioById($id) {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
