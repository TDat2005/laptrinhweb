<?php
// commons/helpers.php

function base_url(string $path = ''): string {
    // tự lấy base theo thư mục chứa index.php
    $scriptName = $_SERVER['SCRIPT_NAME'];          // /project/index.php
    $base = str_replace('/index.php', '', $scriptName); // /project
    return rtrim($base, '/') . '/' . ltrim($path, '/');
}

function redirect(string $url): void {
    header("Location: $url");
    exit;
}

function e(string $str): string {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

/**
 * render('auth/login') -> views/auth/login.php
 */
function render(string $viewPath, array $data = []): void {
    extract($data, EXTR_SKIP);
    $file = __DIR__ . '/../views/' . $viewPath . '.php';
    if (!file_exists($file)) {
        http_response_code(500);
        echo "View not found: " . e($viewPath);
        exit;
    }
    require $file;
}