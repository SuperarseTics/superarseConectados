<?php
require_once '../app/controllers/LoginController.php';

// Obtener la URI y eliminar el subdirectorio base
$uri = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$basePath = '/superarseconectados/public';

if (strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
}

// Asegurar que la URI de la página de inicio sea '/' o ''
if ($uri === '') {
    $uri = '/';
}

$method = $_SERVER['REQUEST_METHOD'];

// Rutas
switch ($uri) {
    case '/':
    case '/login':
        require_once '../app/views/login.php';
        break;

    case '/login/validar':
        if ($method === 'POST') {
            $controller = new LoginController();
            $controller->validar();
        } else {
            header("Location: " . $basePath . "/login");
        }
        break;

    case '/informacion':
        $controller = new LoginController();
        $controller->mostrarInformacion();
        break;

    case '/logout':
        $controller = new LoginController();
        $controller->cerrarSesion();
        require_once '../app/views/login.php';
        exit();
        break;

    case '/pago':
        require_once '../app/controllers/PaymentController.php';
        $controller = new PaymentController();
        $controller->showPaymentPage();
        break;

    default:
        http_response_code(404);
        echo "404 - Página no encontrada";
        break;
}
