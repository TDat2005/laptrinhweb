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
        $user = User::findActiveByUsername($username);
if (!$user) {
    redirect(base_url('index.php?c=auth&a=login&err=invalid'));
}

// check pass (md5 legacy / password_hash)
$ok = false;
if (strlen($user['password']) === 32) {
    $ok = (md5($password) === $user['password']);
} else {
    $ok = password_verify($password, $user['password']);
}

if (!$ok) {
    redirect(base_url('index.php?c=auth&a=login&err=wrong_password'));
}

login_user($user);
redirect(base_url('index.php'));

    }

    public function logout(): void {
        logout_user();
        redirect(base_url('index.php?c=auth&a=login'));
    }
    public function register(): void {
    // đã login thì đá về trang chính
    if (current_user()) {
        redirect(base_url('index.php'));
    }

    $err = $_GET['err'] ?? '';
    render('auth/register', ['err' => $err]);
}

public function handle_register(): void {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        redirect(base_url('index.php?c=auth&a=register'));
    }

    $username = trim($_POST['username'] ?? '');
    $fullName = trim($_POST['full_name'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm  = trim($_POST['confirm_password'] ?? '');

    // validate
    if ($username === '' || $fullName === '' || $password === '') {
        redirect(base_url('index.php?c=auth&a=register&err=missing'));
    }

    if (strlen($username) < 4) {
        redirect(base_url('index.php?c=auth&a=register&err=username_short'));
    }

    if (strlen($password) < 6) {
        redirect(base_url('index.php?c=auth&a=register&err=password_short'));
    }

    if ($password !== $confirm) {
        redirect(base_url('index.php?c=auth&a=register&err=confirm'));
    }

    // username unique
    if (User::existsUsername($username)) {
        redirect(base_url('index.php?c=auth&a=register&err=exists'));
    }

    // tạo user role patient mặc định
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $ok = User::create($username, $hash, $fullName, 'patient', 1);

    if (!$ok) {
        redirect(base_url('index.php?c=auth&a=register&err=db'));
    }

    // có thể auto-login luôn hoặc chuyển sang login
    redirect(base_url('index.php?c=auth&a=login&err=registered'));
}

}