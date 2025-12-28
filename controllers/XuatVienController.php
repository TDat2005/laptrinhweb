<?php
class XuatVienController {

    // Danh sách bệnh nhân đang điều trị (để chọn xuất viện)
    public function list(): void {
        require_role(['doctor', 'nurse', 'admin']);

        $danhSach = XuatVien::getDanhSachDangDieuTri();
        $msg = $_GET['msg'] ?? '';

        render('xuatvien/list', [
            'danhSach' => $danhSach,
            'msg' => $msg
        ]);
    }

    // Form nhập thông tin xuất viện
    public function add(): void {
        require_role(['doctor', 'nurse', 'admin']);

        $id_ho_so = (int)($_GET['id'] ?? 0);
        if ($id_ho_so <= 0) {
            redirect(base_url('index.php?c=xuatvien&a=list'));
        }

        // Kiểm tra hồ sơ đã xuất viện chưa
        if (XuatVien::isDaXuatVien($id_ho_so)) {
            redirect(base_url('index.php?c=xuatvien&a=list&msg=already_discharged'));
        }

        $hoSo = XuatVien::getHoSoDetail($id_ho_so);
        if (!$hoSo) {
            redirect(base_url('index.php?c=xuatvien&a=list&msg=not_found'));
        }

        render('xuatvien/add', ['hoSo' => $hoSo]);
    }

    // Xử lý POST để lưu xuất viện
    public function handle_add(): void {
        require_role(['doctor', 'nurse', 'admin']);

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect(base_url('index.php?c=xuatvien&a=list'));
        }

        $id_ho_so = (int)($_POST['id_ho_so'] ?? 0);
        $ngay_xuat = trim($_POST['ngay_xuat'] ?? '');
        $chan_doan_cuoi = trim($_POST['chan_doan_cuoi'] ?? '');
        $ket_luan = trim($_POST['ket_luan'] ?? '');
        $ghi_chu = trim($_POST['ghi_chu'] ?? '');

        if ($id_ho_so <= 0 || $ngay_xuat === '') {
            redirect(base_url('index.php?c=xuatvien&a=add&id=' . $id_ho_so . '&msg=error'));
        }

        // Kiểm tra hồ sơ chưa xuất viện
        if (XuatVien::isDaXuatVien($id_ho_so)) {
            redirect(base_url('index.php?c=xuatvien&a=list&msg=already_discharged'));
        }

        // Lấy id_giuong từ hồ sơ
        $hoSo = XuatVien::getHoSoDetail($id_ho_so);
        if (!$hoSo) {
            redirect(base_url('index.php?c=xuatvien&a=list&msg=not_found'));
        }

        $data = [
            'id_ho_so' => $id_ho_so,
            'id_giuong' => $hoSo['id_giuong'],
            'ngay_xuat' => $ngay_xuat,
            'chan_doan_cuoi' => $chan_doan_cuoi,
            'ket_luan' => $ket_luan,
            'ghi_chu' => $ghi_chu
        ];

        $success = XuatVien::create($data);
        if ($success) {
            redirect(base_url('index.php?c=xuatvien&a=list&msg=success'));
        } else {
            redirect(base_url('index.php?c=xuatvien&a=add&id=' . $id_ho_so . '&msg=error'));
        }
    }
}