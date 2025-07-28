<?php
class View {
    public static function render($viewPath, $data = []) {
        extract($data); // Crea variables desde las claves del array
        require $viewPath;
    }
}
