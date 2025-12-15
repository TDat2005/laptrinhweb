<?php
class AuthController {

    public function login(): void {
        if (current_user()) {
            redirect(base_url('index.php'));
        }
        $err = $_GET['err'] ?? '';
        render('auth/login', ['err' => $err]);
    }

    public function handle_login(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect(base_url('index.php?c=auth&a=login'));
        }

        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($username === '' || $password === '') {
            redirect(base_url('index.php?c=auth&a=login&err=missing'));
        }

        $user = User::findActiveByUsername($username);
        if (!$user) {
            redirect(base_url('index.php?c=auth&a=login&err=invalid'));
        }

        // Nếu DB đang dùng MD5 cho admin test => check md5
        $ok = false;
        if (strlen($user['password']) === 32) {
            $ok = (md5($password) === $user['password']);
        } else {
            // Trường hợp sau này đổi sang password_hash
            $ok = password_verify($password, $user['password']);
        }

        if (!$ok) {
            redirect(base_url('index.php?c=auth&a=login&err=invalid'));
        }

        login_user($user);
        redirect(base_url('index.php'));
    }

    public function logout(): void {
        logout_user();
        redirect(base_url('index.php?c=auth&a=login'));
    }
}