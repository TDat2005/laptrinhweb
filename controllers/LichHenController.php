<?php
require_once __DIR__ . '/../models/LichHen.php';

class LichHenController {

  public function create(): void {
    require_role(['patient','admin']); // demo: admin cũng đặt được
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') { echo "Method not allowed"; return; }

    $patientId = (int)($_SESSION['user']['id'] ?? 0);
    if ($patientId <= 0) { echo "Chưa đăng nhập"; return; }

    $p = [
      'patient_id' => $patientId,
      'doctor_id'  => (int)($_POST['doctor_id'] ?? 0),
      'ngay'       => trim($_POST['ngay'] ?? ''),
      'slot'       => trim($_POST['slot'] ?? ''),
      'ho_ten'     => trim($_POST['ho_ten'] ?? ''),
      'sdt'        => trim($_POST['sdt'] ?? ''),
      'email'      => trim($_POST['email'] ?? ''),
      'dia_chi'    => trim($_POST['dia_chi'] ?? ''),
      'ly_do_kham' => trim($_POST['ly_do_kham'] ?? ''),
      'ngay_sinh'  => trim($_POST['ngay_sinh'] ?? ''),
      'gioi_tinh'  => trim($_POST['gioi_tinh'] ?? 'nam'),
    ];

    if ($p['doctor_id']<=0 || $p['ngay']==='' || $p['slot']==='' || $p['ho_ten']==='' || $p['sdt']==='') {
      $_SESSION['flash_error'] = "Vui lòng nhập đủ thông tin bắt buộc.";
      header("Location: index.php?c=bacsi&a=detail&id={$p['doctor_id']}&ngay={$p['ngay']}");
      exit;
    }

    try {
      $ok = LichHen::create($p);
      $_SESSION['flash_success'] = $ok ? "Đặt lịch thành công (chờ xác nhận)." : "Đặt lịch thất bại.";
    } catch (Throwable $e) {
      // lỗi trùng slot (UNIQUE uq_book)
      $_SESSION['flash_error'] = "Slot này đã có người đặt. Chọn slot khác.";
    }

    header("Location: index.php?c=bacsi&a=detail&id={$p['doctor_id']}&ngay={$p['ngay']}");
    exit;
  }
  public function my(): void {
    require_role(['patient','admin']);
    $patientId = (int)($_SESSION['user']['id'] ?? 0);
    if ($patientId <= 0) { echo "Chưa đăng nhập"; return; }

    $title = "Lịch hẹn của tôi";
    $list = LichHen::my($patientId);

    render('lichhen/my', [
        'title' => $title,
        'list'  => $list
    ]);
}
public function cancel(): void {
    require_role(['patient','admin']);
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') { echo "Method not allowed"; return; }

    $patientId = (int)($_SESSION['user']['id'] ?? 0);
    $id = (int)($_POST['id'] ?? 0);

    if ($id <= 0 || $patientId <= 0) { echo "Thiếu dữ liệu"; return; }

    $ok = LichHen::cancelByPatient($id, $patientId);
    $_SESSION['flash_success'] = $ok ? "Đã hủy lịch hẹn." : "Không thể hủy (có thể đã hủy/đã khám).";

    header("Location: index.php?c=lichhen&a=my");
    exit;
}

public function manage(): void {
    require_role(['admin','doctor']);

    $me = $_SESSION['user'] ?? null;
    if (!$me) { echo "Chưa đăng nhập"; return; }

    if (($me['role'] ?? '') === 'doctor') {
        $list = LichHen::listForDoctor((int)$me['id']);
        $title = "Lịch hẹn của bác sĩ";
    } else {
        $list = LichHen::listAll();
        $title = "Quản lý lịch hẹn";
    }

    render('lichhen/manage', [
        'title' => $title,
        'list'  => $list,
        'me'    => $me
    ]);
}

public function update(): void {
    require_role(['admin','doctor']);
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') { echo "Method not allowed"; return; }

    $id = (int)($_POST['id'] ?? 0);
    $status = trim($_POST['status'] ?? '');

    if ($id <= 0) { echo "Thiếu id"; return; }

    // doctor chỉ được update lịch của chính mình
    $me = $_SESSION['user'] ?? null;
    if (($me['role'] ?? '') === 'doctor') {
        $row = LichHen::findById($id);
        if (!$row || (int)$row['doctor_id'] !== (int)$me['id']) {
            echo "Không có quyền"; return;
        }
    }

    $ok = LichHen::updateStatus($id, $status);
    $_SESSION['flash_success'] = $ok ? "Đã cập nhật trạng thái." : "Cập nhật thất bại.";

    header("Location: index.php?c=lichhen&a=manage");
    exit;
}

}