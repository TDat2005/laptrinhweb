<?php
session_start();

require_once 'commons/db.php';
require_once __DIR__ . '/commons/helpers.php';
require_once __DIR__ . '/commons/auth.php';

// Autoload đơn giản cho Controller/Model
spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . '/controllers/' . $class . '.php',
        __DIR__ . '/models/' . $class . '.php',
    ];
    foreach ($paths as $p) {
        if (file_exists($p)) {
            require_once $p;
            return;
        }
    }
});

$c = strtolower($_GET['c'] ?? 'home');
$a = strtolower($_GET['a'] ?? 'index');

function controller_class(string $c): string {
    $c = str_replace(['-', '_'], ' ', $c);
    $c = str_replace(' ', '', ucwords($c));
    return $c . 'Controller';
}

$controllerClass = controller_class($c);

if (!class_exists($controllerClass)) {
    http_response_code(404);
    echo "404 - Controller not found: " . e($controllerClass);
    exit;
}

$controller = new $controllerClass();

if (!method_exists($controller, $a)) {
    http_response_code(404);
    echo "404 - Action not found: " . e($a);
    exit;
}

$controller->$a();