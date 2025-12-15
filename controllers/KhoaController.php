<?php
class KhoaController {

    public function list(): void {
        require_role(['admin']);
        $khoas = Khoa::all();
        $msg = $_GET['msg'] ?? '';
        render('khoa/list', ['khoas' => $khoas, 'msg' => $msg]);
    }

    public function add(): void {
        require_role(['admin']);

        $errors = [];
        $old = ['ten_khoa'=>'', 'mo_ta'=>''];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tenKhoa = trim($_POST['ten_khoa'] ?? '');
            $moTa    = trim($_POST['mo_ta'] ?? '');

            $old = ['ten_khoa'=>$tenKhoa, 'mo_ta'=>$moTa];

            if ($tenKhoa === '') $errors[] = "Tên khoa không được để trống.";
            if (Khoa::existsName($tenKhoa)) $errors[] = "Tên khoa đã tồn tại.";

            if (empty($errors)) {
                $ok = Khoa::create($tenKhoa, $moTa);
                if ($ok) redirect(base_url('index.php?c=khoa&a=list&msg=created'));
                $errors[] = "Thêm khoa thất bại (lỗi DB).";
            }
        }

        render('khoa/add', ['errors'=>$errors, 'old'=>$old]);
    }

    public function edit(): void {
        require_role(['admin']);

        $id = (int)($_GET['id'] ?? 0);
        $khoa = Khoa::findById($id);
        if (!$khoa) {
            http_response_code(404);
            echo "Khoa not found";
            exit;
        }

        $errors = [];
        $old = ['ten_khoa'=>$khoa['ten_khoa'], 'mo_ta'=>$khoa['mo_ta'] ?? ''];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tenKhoa = trim($_POST['ten_khoa'] ?? '');
            $moTa    = trim($_POST['mo_ta'] ?? '');
            $old = ['ten_khoa'=>$tenKhoa, 'mo_ta'=>$moTa];

            if ($tenKhoa === '') $errors[] = "Tên khoa không được để trống.";
            if (Khoa::existsName($tenKhoa, $id)) $errors[] = "Tên khoa đã tồn tại (trùng khoa khác).";

            if (empty($errors)) {
                $ok = Khoa::update($id, $tenKhoa, $moTa);
                if ($ok) redirect(base_url('index.php?c=khoa&a=list&msg=updated'));
                $errors[] = "Cập nhật thất bại (lỗi DB).";
            }
        }

        render('khoa/edit', ['errors'=>$errors, 'old'=>$old, 'khoa'=>$khoa]);
    }

    public function delete(): void {
        require_role(['admin']);

        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) redirect(base_url('index.php?c=khoa&a=list'));

        $ok = Khoa::delete($id);
        if (!$ok) {
            // Không xóa được vì có phòng thuộc khoa (hoặc lỗi DB)
            redirect(base_url('index.php?c=khoa&a=list&msg=cannot_delete'));
        }

        redirect(base_url('index.php?c=khoa&a=list&msg=deleted'));
    }
}