<?php
require_once __DIR__ . '/../commons/db.php';

class XuatVien {

    // Lấy danh sách hồ sơ đang điều trị
    public static function getDanhSachDangDieuTri(): array {
        $sql = "
        SELECT
            hs.id,
            hs.ma_ho_so,
            bn.ho_ten,
            k.ten_khoa,
            p.ten_phong,
            g.ma_giuong,
            hs.ngay_nhap
        FROM ho_so_nhap_vien hs
        JOIN benh_nhan bn ON bn.id = hs.id_benh_nhan
        JOIN khoa k ON k.id = hs.id_khoa
        JOIN phong p ON p.id = hs.id_phong
        JOIN giuong g ON g.id = hs.id_giuong
        WHERE hs.trang_thai = 'dang_dieu_tri'
        ORDER BY hs.ngay_nhap DESC
        ";
        $res = DB::conn()->query($sql);
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    // Lấy chi tiết hồ sơ nhập viện
    public static function getHoSoDetail(int $id_ho_so): ?array {
        $sql = "
        SELECT
            hs.id,
            hs.ma_ho_so,
            hs.id_giuong,
            bn.ho_ten,
            k.ten_khoa,
            p.ten_phong,
            g.ma_giuong,
            hs.ngay_nhap,
            hs.chan_doan_ban_dau
        FROM ho_so_nhap_vien hs
        JOIN benh_nhan bn ON bn.id = hs.id_benh_nhan
        JOIN khoa k ON k.id = hs.id_khoa
        JOIN phong p ON p.id = hs.id_phong
        JOIN giuong g ON g.id = hs.id_giuong
        WHERE hs.id = ? AND hs.trang_thai = 'dang_dieu_tri'
        LIMIT 1
        ";
        $stmt = DB::conn()->prepare($sql);
        $stmt->bind_param("i", $id_ho_so);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result ?: null;
    }

    // Kiểm tra hồ sơ đã xuất viện chưa
    public static function isDaXuatVien(int $id_ho_so): bool {
        $sql = "SELECT 1 FROM ho_so_xuat_vien WHERE id_ho_so = ? LIMIT 1";
        $stmt = DB::conn()->prepare($sql);
        $stmt->bind_param("i", $id_ho_so);
        $stmt->execute();
        $result = $stmt->get_result();
        return (bool)$result->fetch_row();
    }

    // Tạo hồ sơ xuất viện (với transaction)
    public static function create(array $data): bool {
        $db = DB::conn();
        $db->begin_transaction();

        try {
            // 1. INSERT vào ho_so_xuat_vien
            $sql1 = "INSERT INTO ho_so_xuat_vien 
                    (id_ho_so, ngay_xuat, chan_doan_cuoi, ket_luan, ghi_chu) 
                    VALUES (?, ?, ?, ?, ?)";
            $stmt1 = $db->prepare($sql1);
            $stmt1->bind_param(
                "issss",
                $data['id_ho_so'],
                $data['ngay_xuat'],
                $data['chan_doan_cuoi'],
                $data['ket_luan'],
                $data['ghi_chu']
            );
            $stmt1->execute();

            // 2. UPDATE ho_so_nhap_vien -> da_xuat_vien
            $sql2 = "UPDATE ho_so_nhap_vien SET trang_thai = 'da_xuat_vien' WHERE id = ?";
            $stmt2 = $db->prepare($sql2);
            $stmt2->bind_param("i", $data['id_ho_so']);
            $stmt2->execute();

            // 3. UPDATE giuong -> trong
            $sql3 = "UPDATE giuong SET trang_thai = 'trong' WHERE id = ?";
            $stmt3 = $db->prepare($sql3);
            $stmt3->bind_param("i", $data['id_giuong']);
            $stmt3->execute();

            $db->commit();
            return true;
        } catch (Exception $e) {
            $db->rollback();
            return false;
        }
    }
}