<?php
require_once __DIR__ . '/../commons/db.php';
class DieuTri {

    // Danh sách bệnh nhân đang điều trị + lọc
    public static function list(array $filter = []): array {
        $sql = "
        SELECT
            hs.id,
            bn.ho_ten,
            k.ten_khoa,
            p.ten_phong,
            g.ma_giuong,
            u.full_name AS bac_si,
            hs.ngay_nhap
        FROM ho_so_nhap_vien hs
        JOIN benh_nhan bn ON bn.id = hs.id_benh_nhan
        JOIN khoa k ON k.id = hs.id_khoa
        JOIN phong p ON p.id = hs.id_phong
        JOIN giuong g ON g.id = hs.id_giuong
        LEFT JOIN users u ON u.id = hs.bac_si_phu_trach
        WHERE hs.trang_thai = 'dang_dieu_tri'
        ";

        $params = [];
        $types = "";

        if (!empty($filter['id_khoa'])) {
            $sql .= " AND hs.id_khoa = ?";
            $types .= "i";
            $params[] = $filter['id_khoa'];
        }

        if (!empty($filter['id_phong'])) {
            $sql .= " AND hs.id_phong = ?";
            $types .= "i";
            $params[] = $filter['id_phong'];
        }

        $sql .= " ORDER BY hs.ngay_nhap DESC";

        $stmt = DB::conn()->prepare($sql);

        if ($params) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public static function khoa(): array {
        return DB::conn()->query("SELECT * FROM khoa")->fetch_all(MYSQLI_ASSOC);
    }

    public static function phongByKhoa(int $id_khoa): array {
        $stmt = DB::conn()->prepare(
            "SELECT * FROM phong WHERE id_khoa=?"
        );
        $stmt->bind_param("i", $id_khoa);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
