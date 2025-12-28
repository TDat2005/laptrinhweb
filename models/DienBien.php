<?php
require_once __DIR__ . '/../commons/db.php';

class DienBien {

    public static function listByHoSo(int $idHoSo): array {
        $conn = DB::conn();
        $sql = "SELECT db.id, db.id_ho_so, db.ngay_gio, db.noi_dung, db.nguoi_cap_nhat,
                       u.full_name AS ten_nguoi_cap_nhat
                FROM dien_bien_dieu_tri db
                LEFT JOIN users u ON db.nguoi_cap_nhat = u.id
                WHERE db.id_ho_so = ?
                ORDER BY db.ngay_gio DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idHoSo);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    public static function create(int $idHoSo, string $noiDung, ?int $uid): bool {
        $conn = DB::conn();
        $sql = "INSERT INTO dien_bien_dieu_tri (id_ho_so, noi_dung, nguoi_cap_nhat)
                VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        // nếu uid null thì bind_param vẫn cần int -> set 0
        $uid = $uid ?? 0;
        $stmt->bind_param("isi", $idHoSo, $noiDung, $uid);
        return $stmt->execute();
    }
}