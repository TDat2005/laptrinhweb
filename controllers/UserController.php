<?php
class UserController {

    public function list(): void {
        require_role(['admin']);
        $users = User::all();
        $msg = $_GET['msg'] ?? '';
        render('user/list', ['users' => $users, 'msg' => $msg]);
    }

    public function add(): void {
        require_role(['admin']);

        $errors = [];
        $old = ['username'=>'','full_name'=>'','role'=>'reception','status'=>1];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $fullName = trim($_POST['full_name'] ?? '');
            $role     = trim($_POST['role'] ?? 'reception');
            $status   = (int)($_POST['status'] ?? 1);
            $password = trim($_POST['password'] ?? '');
            $confirm  = trim($_POST['confirm_password'] ?? '');

            $old = ['username'=>$username,'full_name'=>$fullName,'role'=>$role,'status'=>$status];

            if ($username === '' || $fullName === '' || $password === '') {
                $errors[] = "Vui lòng nhập đầy đủ Username, Họ tên, Mật khẩu.";
            }

            $validRoles = ['admin','doctor','nurse','reception'];
            if (!in_array($role, $validRoles, true)) {
                $errors[] = "Role không hợp lệ.";
            }

            if ($password !== $confirm) {
                $errors[] = "Mật khẩu xác nhận không khớp.";
            }

            if (User::existsUsername($username)) {
                $errors[] = "Username đã tồn tại.";
            }

            if (empty($errors)) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $ok = User::create($username, $hash, $fullName, $role, $status);
                if ($ok) {
                    redirect(base_url('index.php?c=user&a=list&msg=created'));
                }
                $errors[] = "Tạo tài khoản thất bại (lỗi DB).";
            }
        }

        render('user/add', ['errors' => $errors, 'old' => $old]);
    }

    public function edit(): void {
        require_role(['admin']);

        $id = (int)($_GET['id'] ?? 0);
        $user = User::findById($id);
        if (!$user) {
            http_response_code(404);
            echo "User not found";
            exit;
        }

        $errors = [];
        $old = [
            'username'  => $user['username'],
            'full_name' => $user['full_name'],
            'role'      => $user['role'],
            'status'    => (int)$user['status'],
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $fullName = trim($_POST['full_name'] ?? '');
            $role     = trim($_POST['role'] ?? 'reception');
            $status   = (int)($_POST['status'] ?? 1);

            $old = ['username'=>$username,'full_name'=>$fullName,'role'=>$role,'status'=>$status];

            if ($username === '' || $fullName === '') {
                $errors[] = "Username và Họ tên không được để trống.";
            }

            $validRoles = ['admin','doctor','nurse','reception'];
            if (!in_array($role, $validRoles, true)) {
                $errors[] = "Role không hợp lệ.";
            }

            if (User::existsUsername($username, $id)) {
                $errors[] = "Username đã tồn tại (trùng với user khác).";
            }

            if (empty($errors)) {
                $ok = User::updateInfo($id, $username, $fullName, $role, $status);
                if ($ok) {
                    redirect(base_url('index.php?c=user&a=list&msg=updated'));
                }
                $errors[] = "Cập nhật thất bại (lỗi DB).";
            }
        }

        render('user/edit', ['errors'=>$errors, 'old'=>$old, 'user'=>$user]);
    }

    public function toggle_status(): void {
        require_role(['admin']);
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            User::toggleStatus($id);
        }
        redirect(base_url('index.php?c=user&a=list&msg=status'));
    }

    public function reset_password(): void {
        require_role(['admin']);

        $id = (int)($_GET['id'] ?? 0);
        $user = User::findById($id);
        if (!$user) {
            http_response_code(404);
            echo "User not found";
            exit;
        }

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = trim($_POST['password'] ?? '');
            $confirm  = trim($_POST['confirm_password'] ?? '');

            if ($password === '') $errors[] = "Mật khẩu mới không được để trống.";
            if ($password !== $confirm) $errors[] = "Mật khẩu xác nhận không khớp.";

            if (empty($errors)) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $ok = User::updatePassword($id, $hash);
                if ($ok) {
                    redirect(base_url('index.php?c=user&a=list&msg=reset'));
                }
                $errors[] = "Reset mật khẩu thất bại (lỗi DB).";
            }
        }

        render('user/reset_password', ['user'=>$user, 'errors'=>$errors]);
    }
}