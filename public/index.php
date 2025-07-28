<?php
require_once '../app/controllers/LoginController.php';

// Normalizar la URI quitando barras finales (excepto para raíz)
$uri = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$method = $_SERVER['REQUEST_METHOD'];

// Rutas
switch ($uri) {
    case '/public':
    case '/public/login':
        require_once '../app/views/login.php';
        break;

    case '/public/login/validar':
        if ($method === 'POST') {
            $controller = new LoginController();
            $controller->validar();
        } else {
            header("Location: /public/login");
        }
        break;

    case '/public/informacion':
        $controller = new LoginController();
        $controller->mostrarInformacion();
        break;

    /*case '/public/logout':
        $controller = new LoginController();
        $controller->cerrarSesion();
        break;*/

    default:
        http_response_code(404);
        echo "404 - Página no encontrada";
        break;
}
