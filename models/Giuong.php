<?php
require_once __DIR__ . '/../commons/db.php';

class Giuong {

    public static function allWithPhongKhoa(): array {
        $conn = DB::conn();
        $sql = "SELECT g.id, g.ma_giuong, g.id_phong, g.trang_thai, g.ghi_chu,
                       p.ten_phong, p.id_khoa,
                       k.ten_khoa
                FROM giuong g
                JOIN phong p ON g.id_phong = p.id
                JOIN khoa  k ON p.id_khoa = k.id
                ORDER BY g.id DESC";
        $res = $conn->query($sql);
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    public static function findById(int $id): ?array {
        $conn = DB::conn();
        $sql = "SELECT id, ma_giuong, id_phong, trang_thai, ghi_chu
                FROM giuong
                WHERE id = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        return $row ?: null;
    }

    public static function existsMaGiuongInPhong(string $maGiuong, int $idPhong, ?int $ignoreId = null): bool {
        $conn = DB::conn();
        if ($ignoreId) {
            $sql = "SELECT 1 FROM giuong WHERE ma_giuong = ? AND id_phong = ? AND id <> ? LIMIT 1";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sii", $maGiuong, $idPhong, $ignoreId);
        } else {
            $sql = "SELECT 1 FROM giuong WHERE ma_giuong = ? AND id_phong = ? LIMIT 1";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $maGiuong, $idPhong);
        }
        $stmt->execute();
        $res = $stmt->get_result();
        return (bool)$res->fetch_row();
    }

    public static function create(string $maGiuong, int $idPhong, string $trangThai, string $ghiChu): bool {
        $conn = DB::conn();
        $sql = "INSERT INTO giuong (ma_giuong, id_phong, trang_thai, ghi_chu)
                VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siss", $maGiuong, $idPhong, $trangThai, $ghiChu);
        return $stmt->execute();
    }

    public static function update(int $id, string $maGiuong, int $idPhong, string $trangThai, string $ghiChu): bool {
        $conn = DB::conn();
        $sql = "UPDATE giuong
                SET ma_giuong = ?, id_phong = ?, trang_thai = ?, ghi_chu = ?
                WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sissi", $maGiuong, $idPhong, $trangThai, $ghiChu, $id);
        return $stmt->execute();
    }

    public static function delete(int $id): bool {
        $row = self::findById($id);
        if (!$row) return false;
        if (($row['trang_thai'] ?? '') !== 'trong') return false;

        $conn = DB::conn();
        $sql = "DELETE FROM giuong WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public static function toggleStatus(int $id): bool {
        $conn = DB::conn();
        $sql = "UPDATE giuong
                SET trang_thai = CASE WHEN trang_thai = 'trong' THEN 'dang_su_dung' ELSE 'trong' END
                WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // ✅ HÀM GIƯỜNG TRỐNG (DB)
    public static function available(int $idKhoa = 0, int $idPhong = 0): array {
        $conn = DB::conn();

        $sql = "SELECT g.id, g.ma_giuong, g.id_phong, g.trang_thai, g.ghi_chu,
                       p.ten_phong, p.id_khoa,
                       k.ten_khoa
                FROM giuong g
                JOIN phong p ON g.id_phong = p.id
                JOIN khoa  k ON p.id_khoa = k.id
                WHERE g.trang_thai = 'trong'";

        $types = "";
        $params = [];

        if ($idKhoa > 0) {
            $sql .= " AND p.id_khoa = ?";
            $types .= "i";
            $params[] = $idKhoa;
        }
        if ($idPhong > 0) {
            $sql .= " AND g.id_phong = ?";
            $types .= "i";
            $params[] = $idPhong;
        }

        $sql .= " ORDER BY k.ten_khoa ASC, p.ten_phong ASC, g.ma_giuong ASC";

        if ($types !== "") {
            $stmt = $conn->prepare($sql);
            $bind = [$types];
            foreach ($params as $i => $v) $bind[] = &$params[$i];
            call_user_func_array([$stmt, 'bind_param'], $bind);
            $stmt->execute();
            $res = $stmt->get_result();
            return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
        }

        $res = $conn->query($sql);
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }
}