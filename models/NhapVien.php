<?php
require_once __DIR__ . '/../commons/db.php';

class NhapVien {

    // Bệnh nhân chưa nhập viện
    public static function benhNhanChuaNhapVien(): array {
        $sql = "
        SELECT bn.*
        FROM benh_nhan bn
        LEFT JOIN ho_so_nhap_vien hs
            ON bn.id = hs.id_benh_nhan
            AND hs.trang_thai = 'dang_dieu_tri'
        WHERE hs.id IS NULL
        ";
        $res = DB::conn()->query($sql);
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    public static function khoa(): array {
        $res = DB::conn()->query("SELECT * FROM khoa");
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    public static function phongByKhoa(int $id_khoa): array {
        $stmt = DB::conn()->prepare("SELECT * FROM phong WHERE id_khoa=?");
        $stmt->bind_param("i", $id_khoa);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    public static function giuongTrong(int $id_phong): array {
        $stmt = DB::conn()->prepare(
            "SELECT * FROM giuong WHERE id_phong=? AND trang_thai='trong'"
        );
        $stmt->bind_param("i", $id_phong);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    public static function bacSi(): array {
        $res = DB::conn()->query(
            "SELECT id, full_name FROM users WHERE role='doctor'"
        );
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    // Lưu hồ sơ nhập viện
    public static function create(array $data): bool {
        $db = DB::conn();
        $db->begin_transaction();

        try {
            $sql = "INSERT INTO ho_so_nhap_vien
            (ma_ho_so, id_benh_nhan, ngay_nhap,
             id_khoa, id_phong, id_giuong,
             chan_doan_ban_dau, bac_si_phu_trach)
            VALUES (?,?,?,?,?,?,?,?)";

            $stmt = $db->prepare($sql);
            $stmt->bind_param(
                "sisiiisi",
                $data['ma_ho_so'],
                $data['id_benh_nhan'],
                $data['ngay_nhap'],
                $data['id_khoa'],
                $data['id_phong'],
                $data['id_giuong'],
                $data['chan_doan_ban_dau'],
                $data['bac_si_phu_trach']
            );
            $stmt->execute();

            // cập nhật giường
            $stmt2 = $db->prepare(
                "UPDATE giuong SET trang_thai='dang_su_dung' WHERE id=?"
            );
            $stmt2->bind_param("i", $data['id_giuong']);
            $stmt2->execute();

            $db->commit();
            return true;
        } catch (Exception $e) {
            $db->rollback();
            return false;
        }
    }
}