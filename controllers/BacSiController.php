<?php
require_once __DIR__ . '/../commons/db.php';
require_once __DIR__ . '/../models/DienBien.php';

// nếu base mày không auto include helpers/auth thì mở comment:
// require_once __DIR__ . '/../commons/helpers.php';
// require_once __DIR__ . '/../commons/auth.php';

class BacSiController {

    // DS hồ sơ đang điều trị theo bác sĩ (admin xem hết)
    public function my(): void {
        require_role(['doctor','admin']);

        $uid = (int)($_SESSION['user']['id'] ?? 0);
        $isAdmin = (($_SESSION['user']['role'] ?? '') === 'admin');
        $filterUid = $isAdmin ? 0 : $uid;

        $conn = DB::conn();

        $sql = "SELECT hs.id, hs.ma_ho_so, hs.ngay_nhap, hs.trang_thai,
                       bn.ma_bn, bn.ho_ten,
                       k.ten_khoa, p.ten_phong, g.ma_giuong
                FROM ho_so_nhap_vien hs
                JOIN benh_nhan bn ON hs.id_benh_nhan = bn.id
                JOIN khoa k ON hs.id_khoa = k.id
                JOIN phong p ON hs.id_phong = p.id
                JOIN giuong g ON hs.id_giuong = g.id
                WHERE hs.trang_thai='dang_dieu_tri'
                  AND (hs.bac_si_phu_trach = ? OR ?=0)
                ORDER BY hs.ngay_nhap DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $filterUid, $filterUid);
        $stmt->execute();
        $list = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        render('bacsi/my', ['list'=>$list, 'isAdmin'=>$isAdmin]);
    }

    // Chi tiết hồ sơ + ghi diễn biến
    public function detail(): void {
        require_role(['doctor','admin']);

        $idHoSo = (int)($_GET['id_ho_so'] ?? 0);
        if ($idHoSo <= 0) { echo "Thiếu id_ho_so"; exit; }

        $conn = DB::conn();

        // lấy hồ sơ
        $sql = "SELECT hs.id, hs.ma_ho_so, hs.ngay_nhap, hs.chan_doan_ban_dau, hs.ghi_chu,
                       bn.ma_bn, bn.ho_ten,
                       k.ten_khoa, p.ten_phong, g.ma_giuong,
                       u.full_name AS ten_bac_si
                FROM ho_so_nhap_vien hs
                JOIN benh_nhan bn ON hs.id_benh_nhan = bn.id
                JOIN khoa k ON hs.id_khoa = k.id
                JOIN phong p ON hs.id_phong = p.id
                JOIN giuong g ON hs.id_giuong = g.id
                LEFT JOIN users u ON hs.bac_si_phu_trach = u.id
                WHERE hs.id=? LIMIT 1";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idHoSo);
        $stmt->execute();
        $hoso = $stmt->get_result()->fetch_assoc();

        if (!$hoso) { http_response_code(404); echo "Hồ sơ không tồn tại"; exit; }

        // doctor chỉ được xem hồ sơ của mình (admin thì xem hết)
        $isAdmin = (($_SESSION['user']['role'] ?? '') === 'admin');
        $uid = (int)($_SESSION['user']['id'] ?? 0);
        if (!$isAdmin) {
            // check quyền
            $stmt2 = $conn->prepare("SELECT bac_si_phu_trach FROM ho_so_nhap_vien WHERE id=? LIMIT 1");
            $stmt2->bind_param("i", $idHoSo);
            $stmt2->execute();
            $row = $stmt2->get_result()->fetch_assoc();
            $bs = (int)($row['bac_si_phu_trach'] ?? 0);
            if ($bs !== $uid) { http_response_code(403); echo "Bạn không có quyền xem hồ sơ này"; exit; }
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $noiDung = trim($_POST['noi_dung'] ?? '');

            if ($noiDung === '') $errors[] = "Nội dung diễn biến không được để trống.";

            if (empty($errors)) {
                $ok = DienBien::create($idHoSo, $noiDung, $uid ?: null);
                if ($ok) redirect(base_url('index.php?c=bacsi&a=detail&id_ho_so='.$idHoSo));
                $errors[] = "Ghi diễn biến thất bại (DB).";
            }
        }

        $notes = DienBien::listByHoSo($idHoSo);

        render('bacsi/detail', [
            'hoso'=>$hoso,
            'notes'=>$notes,
            'errors'=>$errors,
            'isAdmin'=>$isAdmin
        ]);
    }
}