<?php
class NhapVienController {

    public function add() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $_POST['ma_ho_so'] = 'HS' . time();

            if (NhapVien::create($_POST)) {
                header("Location: index.php?c=dieutri&a=list");
                exit;
            }

            echo "❌ Lỗi khi lưu hồ sơ nhập viện";
            return;
        }

        $benhnhan = NhapVien::benhNhanChuaNhapVien();
        $khoa = NhapVien::khoa();
        $bacsi = NhapVien::bacSi();

        require 'views/nhapvien/add.php';
    }

    // AJAX
    public function phong() {
        $id_khoa = (int)$_GET['id_khoa'];
        echo json_encode(NhapVien::phongByKhoa($id_khoa));
    }

    public function giuong() {
        $id_phong = (int)$_GET['id_phong'];
        echo json_encode(NhapVien::giuongTrong($id_phong));
    }
}