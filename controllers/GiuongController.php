<?php
class GiuongController {

    public function list(): void {
        require_role(['admin']);
        $giuongs = Giuong::allWithPhongKhoa();
        $msg = $_GET['msg'] ?? '';
        render('giuong/list', ['giuongs'=>$giuongs, 'msg'=>$msg]);
    }

    public function add(): void {
        require_role(['admin']);

        $phongs = Phong::allForSelect();
        $errors = [];
        $old = [
            'ma_giuong' => '',
            'id_phong' => 0,
            'trang_thai' => 'trong',
            'ghi_chu' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ma = trim($_POST['ma_giuong'] ?? '');
            $idPhong = (int)($_POST['id_phong'] ?? 0);
            $trangThai = trim($_POST['trang_thai'] ?? 'trong');
            $ghiChu = trim($_POST['ghi_chu'] ?? '');

            $old = ['ma_giuong'=>$ma,'id_phong'=>$idPhong,'trang_thai'=>$trangThai,'ghi_chu'=>$ghiChu];

            if ($ma === '') $errors[] = "Mã giường không được để trống.";
            if ($idPhong <= 0) $errors[] = "Vui lòng chọn phòng.";
            if (!in_array($trangThai, ['trong','dang_su_dung'], true)) $errors[] = "Trạng thái không hợp lệ.";

            if ($idPhong > 0 && $ma !== '' && Giuong::existsMaGiuongInPhong($ma, $idPhong)) {
                $errors[] = "Mã giường đã tồn tại trong phòng này.";
            }

            if (empty($errors)) {
                $ok = Giuong::create($ma, $idPhong, $trangThai, $ghiChu);
                if ($ok) redirect(base_url('index.php?c=giuong&a=list&msg=created'));
                $errors[] = "Thêm giường thất bại (lỗi DB).";
            }
        }

        render('giuong/add', ['phongs'=>$phongs, 'errors'=>$errors, 'old'=>$old]);
    }

    public function edit(): void {
        require_role(['admin']);

        $id = (int)($_GET['id'] ?? 0);
        $giuong = Giuong::findById($id);
        if (!$giuong) {
            http_response_code(404);
            echo "Giuong not found";
            exit;
        }

        $phongs = Phong::allForSelect();
        $errors = [];
        $old = [
            'ma_giuong' => $giuong['ma_giuong'],
            'id_phong' => (int)$giuong['id_phong'],
            'trang_thai' => $giuong['trang_thai'],
            'ghi_chu' => $giuong['ghi_chu'] ?? ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ma = trim($_POST['ma_giuong'] ?? '');
            $idPhong = (int)($_POST['id_phong'] ?? 0);
            $trangThai = trim($_POST['trang_thai'] ?? 'trong');
            $ghiChu = trim($_POST['ghi_chu'] ?? '');

            $old = ['ma_giuong'=>$ma,'id_phong'=>$idPhong,'trang_thai'=>$trangThai,'ghi_chu'=>$ghiChu];

            if ($ma === '') $errors[] = "Mã giường không được để trống.";
            if ($idPhong <= 0) $errors[] = "Vui lòng chọn phòng.";
            if (!in_array($trangThai, ['trong','dang_su_dung'], true)) $errors[] = "Trạng thái không hợp lệ.";

            if ($idPhong > 0 && $ma !== '' && Giuong::existsMaGiuongInPhong($ma, $idPhong, $id)) {
                $errors[] = "Mã giường đã tồn tại trong phòng này.";
            }

            if (empty($errors)) {
                $ok = Giuong::update($id, $ma, $idPhong, $trangThai, $ghiChu);
                if ($ok) redirect(base_url('index.php?c=giuong&a=list&msg=updated'));
                $errors[] = "Cập nhật giường thất bại (lỗi DB).";
            }
        }

        render('giuong/edit', ['phongs'=>$phongs, 'errors'=>$errors, 'old'=>$old, 'giuong'=>$giuong]);
    }

    public function delete(): void {
        require_role(['admin']);

        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) redirect(base_url('index.php?c=giuong&a=list'));

        $ok = Giuong::delete($id);
        if (!$ok) {
            redirect(base_url('index.php?c=giuong&a=list&msg=cannot_delete'));
        }
        redirect(base_url('index.php?c=giuong&a=list&msg=deleted'));
    }

    public function toggle_status(): void {
        require_role(['admin']);

        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) Giuong::toggleStatus($id);

        redirect(base_url('index.php?c=giuong&a=list&msg=status'));
    }
    public function available(): void {
    require_role(['admin']);

    $idKhoa  = (int)($_GET['id_khoa'] ?? 0);
    $idPhong = (int)($_GET['id_phong'] ?? 0);

    $khoas  = Khoa::all();
    $phongs = ($idKhoa > 0) ? Phong::byKhoa($idKhoa) : [];

    if ($idKhoa <= 0) $idPhong = 0;

    $giuongs = Giuong::available($idKhoa, $idPhong);

    render('giuong/available', [
        'khoas'   => $khoas,
        'phongs'  => $phongs,
        'giuongs' => $giuongs,
        'idKhoa'  => $idKhoa,
        'idPhong' => $idPhong
    ]);
}

}