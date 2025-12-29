<?php
require_once __DIR__ . '/../models/BacSi.php';
require_once __DIR__ . '/../models/BacSiSchedule.php';
require_once __DIR__ . '/../models/LichHen.php';

class BacSiController {

  public function list(): void {
    $title = "Bác sĩ";
    $list = BacSi::all();
    render('bacsi/list', ['title'=>$title, 'list'=>$list]);
  }

  public function detail(): void {
    $id = (int)($_GET['id'] ?? 0);
    $bs = BacSi::find($id);
    if (!$bs) { echo "Không tìm thấy bác sĩ"; return; }

    $ngay = $_GET['ngay'] ?? date('Y-m-d');

    $activeSlots = BacSiSchedule::activeSlots($id, $ngay);
    $bookedSlots = LichHen::bookedSlots($id, $ngay);

    render('bacsi/detail', [
      'bs'=>$bs,
      'ngay'=>$ngay,
      'activeSlots'=>$activeSlots,
      'bookedSlots'=>$bookedSlots
    ]);
  }

  // AJAX: trả JSON slot khả dụng theo ngày
  public function slots(): void {
    $doctorId = (int)($_GET['id'] ?? 0);
    $ngay = $_GET['ngay'] ?? date('Y-m-d');

    $activeSlots = BacSiSchedule::activeSlots($doctorId, $ngay);
    $bookedSlots = LichHen::bookedSlots($doctorId, $ngay);

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
      'ngay' => $ngay,
      'active' => $activeSlots,
      'booked' => $bookedSlots
    ]);
  }
  public function manage(): void {
    require_role(['admin']);

    $list = BacSi::all(); // hoặc User::allDoctors() tùy mày đang lấy ds bác sĩ kiểu gì
    render('bacsi/manage', ['list' => $list]);
}
    public function edit(): void {
    require_role(['admin']);

    $id = (int)($_GET['id'] ?? 0);
    $bs = BacSi::find($id);

    if (!$bs) {
        echo "Không tìm thấy bác sĩ";
        return;
    }

    render('bacsi/edit', ['bs' => $bs]);
}

public function update(): void {
    require_role(['admin']);

    $id = (int)($_POST['user_id'] ?? 0);

    $data = [
        'chuyen_khoa'      => $_POST['chuyen_khoa'] ?? '',
        'gia_kham'         => (int)($_POST['gia_kham'] ?? 0),
        'benh_vien'        => $_POST['benh_vien'] ?? null,
        'phong_kham'       => $_POST['phong_kham'] ?? null,
        'tinh_thanh'       => $_POST['tinh_thanh'] ?? null,
        'phuong_thuc_tt'   => $_POST['phuong_thuc_tt'] ?? null,
        'gioi_thieu_ngan'  => $_POST['gioi_thieu_ngan'] ?? null,
        'mo_ta_chi_tiet'   => $_POST['mo_ta_chi_tiet'] ?? null,
        'anh_dai_dien'     => $_POST['anh_dai_dien'] ?? null,
    ];

    BacSi::updateProfile($id, $data);

    header("Location: index.php?c=bacsi&a=manage");
}
public function profile(): void {
  require_role(['doctor']);

  $me = current_user();
  $doctorId = (int)($me['id'] ?? 0);
  if ($doctorId <= 0) { echo "Chưa đăng nhập"; return; }

  // reuse hàm find có sẵn: lấy theo users.id
  $bs = BacSi::find($doctorId);
  if (!$bs) { echo "Chưa có hồ sơ bác sĩ"; return; }

  $ngay = $_GET['ngay'] ?? date('Y-m-d');
  $activeSlots = BacSiSchedule::activeSlots($doctorId, $ngay);
  $bookedSlots = LichHen::bookedSlots($doctorId, $ngay);

  render('bacsi/profile', [
    'bs' => $bs,
    'ngay' => $ngay,
    'activeSlots' => $activeSlots,
    'bookedSlots' => $bookedSlots,
    'title' => 'Hồ sơ bác sĩ của tôi'
  ]);
}
public function edit_my(): void {
    require_role(['doctor']);

    $me = current_user();
    $doctorId = (int)$me['id'];

    $bs = BacSi::find($doctorId);
    if (!$bs) {
        echo "Không tìm thấy hồ sơ bác sĩ";
        return;
    }

    render('bacsi/edit_my', [
        'bs' => $bs
    ]);
}
public function update_my(): void {
    require_role(['doctor']);

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo "Method not allowed";
        return;
    }

    $me = current_user();
    $doctorId = (int)$me['id'];

    // ❗ KHÔNG lấy user_id từ POST (tránh hack)
    $data = [
        'chuyen_khoa'      => $_POST['chuyen_khoa'] ?? '',
        'gia_kham'         => (int)($_POST['gia_kham'] ?? 0),
        'benh_vien'        => $_POST['benh_vien'] ?? null,
        'phong_kham'       => $_POST['phong_kham'] ?? null,
        'tinh_thanh'       => $_POST['tinh_thanh'] ?? null,
        'phuong_thuc_tt'   => $_POST['phuong_thuc_tt'] ?? null,
        'gioi_thieu_ngan'  => $_POST['gioi_thieu_ngan'] ?? null,
        'mo_ta_chi_tiet'   => $_POST['mo_ta_chi_tiet'] ?? null,
        'anh_dai_dien'     => $_POST['anh_dai_dien'] ?? null,
    ];

    BacSi::updateProfile($doctorId, $data);

    $_SESSION['flash_success'] = "Đã cập nhật hồ sơ của bạn";
    header("Location: index.php?c=bacsi&a=profile");
    exit;
}


}