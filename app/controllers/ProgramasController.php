<?php
class ProgramasController {
    private $usuarioModel;
    private $programaModel;
    private $asignaturaModel;
    private $credencialModel;

    public function __construct() {
        $this->usuarioModel = new UsuarioModel();
        $this->programaModel = new ProgramaModel();
        $this->asignaturaModel = new AsignaturaModel();
        $this->credencialModel = new CredencialModel();
    }

    public function showInfo() {
        // Obtener el ID del usuario desde la sesión o donde lo tengas almacenado
        $userId = $_SESSION['user_id'];  // Este es un ejemplo

        // Obtener información del usuario
        $usuario = $this->usuarioModel->getUsuarioById($userId);
        $programaNombre = $usuario['programa'];  // El nombre del programa del usuario

        // Obtener el programa usando el nombre
        $programa = $this->programaModel->getProgramaByNombre($programaNombre);

        // Obtener las asignaturas asociadas a ese programa
        $asignaturas = $this->asignaturaModel->getAsignaturasByProgramaNombre($programaNombre);

        // Obtener las credenciales del usuario
        $credenciales = $this->credencialModel->getCredencialesByUserId($userId);

        // Pasar los datos a la vista
        include 'views/usuario/informacion.php';  // Esta es la vista que ya tienes
    }
}
?>
