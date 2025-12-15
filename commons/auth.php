<?php
// commons/auth.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function current_user(): ?array {
    return $_SESSION['user'] ?? null;
}

function require_login(): void {
    if (!isset($_SESSION['user'])) {
        redirect(base_url('index.php?c=auth&a=login'));
    }
}

function require_role(array $roles): void {
    require_login();
    $role = $_SESSION['user']['role'] ?? '';
    if (!in_array($role, $roles, true)) {
        http_response_code(403);
        echo "403 - Forbidden";
        exit;
    }
}

function login_user(array $user): void {
    $_SESSION['user'] = [
        'id'        => $user['id'],
        'username'  => $user['username'],
        'full_name' => $user['full_name'],
        'role'      => $user['role'],
    ];
}

function logout_user(): void {
    unset($_SESSION['user']);
    session_destroy();
}