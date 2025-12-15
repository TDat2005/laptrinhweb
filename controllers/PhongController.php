<?php
class PhongController {

    public function list(): void {
        require_role(['admin']);
        $phongs = Phong::allWithKhoa();
        $msg = $_GET['msg'] ?? '';
        render('phong/list', ['phongs'=>$phongs, 'msg'=>$msg]);
    }

    public function add(): void {
        require_role(['admin']);

        $khoas = Khoa::all();
        $errors = [];
        $old = [
            'ten_phong' => '',
            'loai_phong' => '',
            'id_khoa' => 0,
            'ghi_chu' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tenPhong = trim($_POST['ten_phong'] ?? '');
            $loaiPhong = trim($_POST['loai_phong'] ?? '');
            $idKhoa = (int)($_POST['id_khoa'] ?? 0);
            $ghiChu = trim($_POST['ghi_chu'] ?? '');

            $old = [
                'ten_phong'=>$tenPhong,
                'loai_phong'=>$loaiPhong,
                'id_khoa'=>$idKhoa,
                'ghi_chu'=>$ghiChu
            ];

            if ($tenPhong === '') $errors[] = "Tên phòng không được để trống.";
            if ($idKhoa <= 0) $errors[] = "Vui lòng chọn khoa.";

            if (empty($errors)) {
                $ok = Phong::create($tenPhong, $loaiPhong, $idKhoa, $ghiChu);
                if ($ok) redirect(base_url('index.php?c=phong&a=list&msg=created'));
                $errors[] = "Thêm phòng thất bại (lỗi DB).";
            }
        }

        render('phong/add', ['khoas'=>$khoas, 'errors'=>$errors, 'old'=>$old]);
    }

    public function edit(): void {
        require_role(['admin']);

        $id = (int)($_GET['id'] ?? 0);
        $phong = Phong::findById($id);
        if (!$phong) {
            http_response_code(404);
            echo "Phong not found";
            exit;
        }

        $khoas = Khoa::all();
        $errors = [];
        $old = [
            'ten_phong' => $phong['ten_phong'],
            'loai_phong' => $phong['loai_phong'] ?? '',
            'id_khoa' => (int)$phong['id_khoa'],
            'ghi_chu' => $phong['ghi_chu'] ?? ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tenPhong = trim($_POST['ten_phong'] ?? '');
            $loaiPhong = trim($_POST['loai_phong'] ?? '');
            $idKhoa = (int)($_POST['id_khoa'] ?? 0);
            $ghiChu = trim($_POST['ghi_chu'] ?? '');

            $old = [
                'ten_phong'=>$tenPhong,
                'loai_phong'=>$loaiPhong,
                'id_khoa'=>$idKhoa,
                'ghi_chu'=>$ghiChu
            ];

            if ($tenPhong === '') $errors[] = "Tên phòng không được để trống.";
            if ($idKhoa <= 0) $errors[] = "Vui lòng chọn khoa.";

            if (empty($errors)) {
                $ok = Phong::update($id, $tenPhong, $loaiPhong, $idKhoa, $ghiChu);
                if ($ok) redirect(base_url('index.php?c=phong&a=list&msg=updated'));
                $errors[] = "Cập nhật phòng thất bại (lỗi DB).";
            }
        }

        render('phong/edit', ['khoas'=>$khoas, 'errors'=>$errors, 'old'=>$old, 'phong'=>$phong]);
    }

    public function delete(): void {
        require_role(['admin']);

        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) redirect(base_url('index.php?c=phong&a=list'));

        $ok = Phong::delete($id);
        if (!$ok) {
            redirect(base_url('index.php?c=phong&a=list&msg=cannot_delete'));
        }

        redirect(base_url('index.php?c=phong&a=list&msg=deleted'));
    }
}