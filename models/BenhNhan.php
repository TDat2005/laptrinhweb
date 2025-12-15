<?php
require_once __DIR__ . '/../commons/db.php';
class BenhNhan {

    // Lấy danh sách + tìm kiếm
    public static function all(string $keyword = ''): array {
        $db = DB::conn();

        if ($keyword !== '') {
            $sql = "SELECT * FROM benh_nhan
                    WHERE ma_bn LIKE ?
                       OR ho_ten LIKE ?
                    ORDER BY id DESC";
            $stmt = $db->prepare($sql);
            $kw = "%$keyword%";
            $stmt->bind_param("ss", $kw, $kw);
        } else {
            $sql = "SELECT * FROM benh_nhan ORDER BY id DESC";
            $stmt = $db->prepare($sql);
        }

        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Lấy 1 bệnh nhân
    public static function find(int $id): ?array {
        $stmt = DB::conn()->prepare(
            "SELECT * FROM benh_nhan WHERE id=?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc() ?: null;
    }

    // Thêm mới
    public static function create(array $data): bool {
        $sql = "INSERT INTO benh_nhan
            (ma_bn, ho_ten, ngay_sinh, gioi_tinh,
             so_cmnd, so_bhyt, dia_chi, sdt_nguoi_than)
            VALUES (?,?,?,?,?,?,?,?)";

        $stmt = DB::conn()->prepare($sql);
        $stmt->bind_param(
            "ssssssss",
            $data['ma_bn'],
            $data['ho_ten'],
            $data['ngay_sinh'],
            $data['gioi_tinh'],
            $data['so_cmnd'],
            $data['so_bhyt'],
            $data['dia_chi'],
            $data['sdt_nguoi_than']
        );
        return $stmt->execute();
    }

    // Cập nhật
    public static function update(int $id, array $data): bool {
        $sql = "UPDATE benh_nhan SET
                ho_ten=?, ngay_sinh=?, gioi_tinh=?,
                so_cmnd=?, so_bhyt=?, dia_chi=?, sdt_nguoi_than=?
                WHERE id=?";

        $stmt = DB::conn()->prepare($sql);
        $stmt->bind_param(
            "sssssssi",
            $data['ho_ten'],
            $data['ngay_sinh'],
            $data['gioi_tinh'],
            $data['so_cmnd'],
            $data['so_bhyt'],
            $data['dia_chi'],
            $data['sdt_nguoi_than'],
            $id
        );
        return $stmt->execute();
    }

    // Kiểm tra có hồ sơ nhập viện chưa
    public static function hasNhapVien(int $id): bool {
        $stmt = DB::conn()->prepare(
            "SELECT COUNT(*) FROM ho_so_nhap_vien WHERE id_benh_nhan=?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_row()[0] > 0;
    }

    // Xóa (có kiểm tra)
    public static function delete(int $id): bool {
        if (self::hasNhapVien($id)) {
            return false;
        }
        $stmt = DB::conn()->prepare(
            "DELETE FROM benh_nhan WHERE id=?"
        );
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
