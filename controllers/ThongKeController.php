<?php
class ThongKeController {

    // Trang thống kê
    public function index(): void {
        require_role(['admin']);

        // Lấy tháng/năm từ GET, mặc định tháng/năm hiện tại
        $thang = isset($_GET['thang']) ? (int)$_GET['thang'] : (int)date('m');
        $nam = isset($_GET['nam']) ? (int)$_GET['nam'] : (int)date('Y');

        // Validate
        if ($thang < 1 || $thang > 12) {
            $thang = (int)date('m');
        }
        if ($nam < 2000 || $nam > 2100) {
            $nam = (int)date('Y');
        }

        // Lấy dữ liệu thống kê
        $theoKhoa = ThongKe::soBenhNhanDangDieuTriTheoKhoa();
        $theoThang = ThongKe::thongKeTheoThang($thang, $nam);
        $tongDangDieuTri = ThongKe::tongSoDangDieuTri();
        $tongNhapVien = ThongKe::tongNhapVienThang($thang, $nam);
        $tongXuatVien = ThongKe::tongXuatVienThang($thang, $nam);

        render('thongke/index', [
            'thang' => $thang,
            'nam' => $nam,
            'theoKhoa' => $theoKhoa,
            'theoThang' => $theoThang,
            'tongDangDieuTri' => $tongDangDieuTri,
            'tongNhapVien' => $tongNhapVien,
            'tongXuatVien' => $tongXuatVien
        ]);
    }
}