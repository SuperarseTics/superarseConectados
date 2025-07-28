<?php
class CredencialModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Obtener las credenciales de un usuario
    public function getCredencialesByUserId($userId) {
        $query = "SELECT * FROM credenciales WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
