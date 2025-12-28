<?php
require_once __DIR__ . '/../commons/db.php';

class ThongKe {

    // Số bệnh nhân đang điều trị theo khoa
    public static function soBenhNhanDangDieuTriTheoKhoa(): array {
        $sql = "
        SELECT
            k.id,
            k.ten_khoa,
            COUNT(hs.id) AS so_luong
        FROM khoa k
        LEFT JOIN ho_so_nhap_vien hs ON hs.id_khoa = k.id AND hs.trang_thai = 'dang_dieu_tri'
        GROUP BY k.id, k.ten_khoa
        ORDER BY so_luong DESC, k.ten_khoa
        ";
        $res = DB::conn()->query($sql);
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    // Số bệnh nhân nhập viện theo khoảng thời gian
    public static function soBenhNhanNhapVien(array $filter): array {
        $sql = "
        SELECT
            DATE(hs.ngay_nhap) AS ngay,
            COUNT(hs.id) AS so_luong
        FROM ho_so_nhap_vien hs
        WHERE 1=1
        ";
        $params = [];
        $types = "";

        if (!empty($filter['tu_ngay'])) {
            $sql .= " AND DATE(hs.ngay_nhap) >= ?";
            $types .= "s";
            $params[] = $filter['tu_ngay'];
        }

        if (!empty($filter['den_ngay'])) {
            $sql .= " AND DATE(hs.ngay_nhap) <= ?";
            $types .= "s";
            $params[] = $filter['den_ngay'];
        }

        $sql .= " GROUP BY DATE(hs.ngay_nhap) ORDER BY ngay DESC";

        $stmt = DB::conn()->prepare($sql);
        if ($params) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Số bệnh nhân xuất viện theo khoảng thời gian
    public static function soBenhNhanXuatVien(array $filter): array {
        $sql = "
        SELECT
            DATE(xv.ngay_xuat) AS ngay,
            COUNT(xv.id) AS so_luong
        FROM ho_so_xuat_vien xv
        WHERE 1=1
        ";
        $params = [];
        $types = "";

        if (!empty($filter['tu_ngay'])) {
            $sql .= " AND DATE(xv.ngay_xuat) >= ?";
            $types .= "s";
            $params[] = $filter['tu_ngay'];
        }

        if (!empty($filter['den_ngay'])) {
            $sql .= " AND DATE(xv.ngay_xuat) <= ?";
            $types .= "s";
            $params[] = $filter['den_ngay'];
        }

        $sql .= " GROUP BY DATE(xv.ngay_xuat) ORDER BY ngay DESC";

        $stmt = DB::conn()->prepare($sql);
        if ($params) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Thống kê nhập/xuất viện theo tháng
    public static function thongKeTheoThang(int $thang, int $nam): array {
        $tu_ngay = sprintf('%04d-%02d-01', $nam, $thang);
        $den_ngay = date('Y-m-t', strtotime($tu_ngay)); // Ngày cuối tháng

        $nhapVien = self::soBenhNhanNhapVien([
            'tu_ngay' => $tu_ngay,
            'den_ngay' => $den_ngay
        ]);

        $xuatVien = self::soBenhNhanXuatVien([
            'tu_ngay' => $tu_ngay,
            'den_ngay' => $den_ngay
        ]);

        // Tổng hợp dữ liệu
        $tongHop = [];
        
        // Tạo map cho nhập viện
        $mapNhap = [];
        foreach ($nhapVien as $nv) {
            $mapNhap[$nv['ngay']] = (int)$nv['so_luong'];
        }

        // Tạo map cho xuất viện
        $mapXuat = [];
        foreach ($xuatVien as $xv) {
            $mapXuat[$xv['ngay']] = (int)$xv['so_luong'];
        }

        // Lấy tất cả các ngày có dữ liệu
        $allDates = array_unique(array_merge(array_keys($mapNhap), array_keys($mapXuat)));
        rsort($allDates);

        foreach ($allDates as $ngay) {
            $tongHop[] = [
                'ngay' => $ngay,
                'so_nhap_vien' => $mapNhap[$ngay] ?? 0,
                'so_xuat_vien' => $mapXuat[$ngay] ?? 0
            ];
        }

        return $tongHop;
    }

    // Tổng số bệnh nhân đang điều trị
    public static function tongSoDangDieuTri(): int {
        $sql = "SELECT COUNT(*) AS tong FROM ho_so_nhap_vien WHERE trang_thai = 'dang_dieu_tri'";
        $res = DB::conn()->query($sql);
        $row = $res->fetch_assoc();
        return (int)($row['tong'] ?? 0);
    }

    // Tổng số nhập viện trong tháng
    public static function tongNhapVienThang(int $thang, int $nam): int {
        $tu_ngay = sprintf('%04d-%02d-01', $nam, $thang);
        $den_ngay = date('Y-m-t', strtotime($tu_ngay));
        
        $data = self::soBenhNhanNhapVien(['tu_ngay' => $tu_ngay, 'den_ngay' => $den_ngay]);
        $tong = 0;
        foreach ($data as $d) {
            $tong += (int)$d['so_luong'];
        }
        return $tong;
    }

    // Tổng số xuất viện trong tháng
    public static function tongXuatVienThang(int $thang, int $nam): int {
        $tu_ngay = sprintf('%04d-%02d-01', $nam, $thang);
        $den_ngay = date('Y-m-t', strtotime($tu_ngay));
        
        $data = self::soBenhNhanXuatVien(['tu_ngay' => $tu_ngay, 'den_ngay' => $den_ngay]);
        $tong = 0;
        foreach ($data as $d) {
            $tong += (int)$d['so_luong'];
        }
        return $tong;
    }
}