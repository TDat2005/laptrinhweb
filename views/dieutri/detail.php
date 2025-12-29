<?php
/** @var array $user */
/** @var array $hoSo */
/** @var array $dienBien */
/** @var string $msg */

$pageTitle = "Chi tiết hồ sơ điều trị";
$pageSub   = "Xem thông tin hồ sơ và ghi nhận diễn biến điều trị";
require __DIR__ . "/../layout/AdminHeader.php";
?>

<?php if (!empty($msg)): ?>
  <?php if ($msg === 'success'): ?>
    <div class="alert" style="border-color: rgba(16,185,129,.25); background: rgba(16,185,129,.10); color:#065f46;">
      ✅ Ghi nhận diễn biến thành công.
    </div>
  <?php else: ?>
    <div class="alert alert-danger">
      ⚠️ Có lỗi xảy ra. Vui lòng thử lại.
    </div>
  <?php endif; ?>
<?php endif; ?>

<!-- ====== Thông tin hồ sơ ====== -->
<div class="panel">
  <div class="page-head" style="padding:0; margin-bottom:10px;">
    <div>
      <div class="page-title" style="font-size:16px;">Thông tin hồ sơ</div>
      <div class="page-sub">Thông tin nhập viện, khoa/phòng/giường và bác sĩ phụ trách</div>
    </div>
    <div class="actions">
      <a class="btn btn-outline" href="<?= e(base_url('index.php?c=dieutri&a=list')) ?>">← Quay lại danh sách</a>
      <a class="btn btn-outline" href="<?= e(base_url('index.php')) ?>">Về dashboard</a>
    </div>
  </div>

  <div class="tbl-wrap" style="margin-top:10px;">
    <table class="tbl">
      <tbody>
        <tr>
          <th style="width:220px;">Mã hồ sơ</th>
          <td><?= e($hoSo['ma_ho_so']) ?></td>
        </tr>
        <tr>
          <th>Tên bệnh nhân</th>
          <td><?= e($hoSo['ho_ten']) ?></td>
        </tr>
        <tr>
          <th>Khoa</th>
          <td><?= e($hoSo['ten_khoa']) ?></td>
        </tr>
        <tr>
          <th>Phòng</th>
          <td><?= e($hoSo['ten_phong']) ?></td>
        </tr>
        <tr>
          <th>Giường</th>
          <td><?= e($hoSo['ma_giuong']) ?></td>
        </tr>
        <tr>
          <th>Bác sĩ phụ trách</th>
          <td><?= e($hoSo['bac_si'] ?? 'Chưa phân công') ?></td>
        </tr>
        <tr>
          <th>Ngày nhập viện</th>
          <td><?= e($hoSo['ngay_nhap']) ?></td>
        </tr>
        <tr>
          <th>Chẩn đoán ban đầu</th>
          <td><?= e($hoSo['chan_doan_ban_dau'] ?? '') ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!-- ====== Form ghi nhận diễn biến ====== -->
<div class="panel" style="margin-top:14px;">
  <div class="page-title" style="font-size:16px; margin-bottom:6px;">Ghi nhận diễn biến điều trị</div>
  <div class="page-sub" style="margin-bottom:10px;">Nhập nội dung diễn biến mới cho hồ sơ hiện tại</div>

  <form method="POST" action="<?= e(base_url('index.php?c=dieutri&a=add_record')) ?>">
    <input type="hidden" name="id_ho_so" value="<?= (int)$hoSo['id'] ?>">

    <div class="form-grid">
      <div class="field full">
        <label for="noi_dung">Nội dung diễn biến</label>
        <textarea
          class="input"
          id="noi_dung"
          name="noi_dung"
          required
          placeholder="Nhập nội dung diễn biến điều trị..."
          style="min-height:120px;"
        ></textarea>
      </div>

      <div class="full actions" style="justify-content:flex-end;">
        <button class="btn" type="submit">Ghi nhận diễn biến</button>
      </div>
    </div>
  </form>
</div>

<!-- ====== Lịch sử diễn biến ====== -->
<div class="panel" style="margin-top:14px;">
  <div class="page-title" style="font-size:16px; margin-bottom:6px;">Lịch sử diễn biến điều trị</div>
  <div class="page-sub" style="margin-bottom:10px;">Danh sách các diễn biến đã được ghi nhận</div>

  <?php if (empty($dienBien)): ?>
    <div class="alert">
      Chưa có diễn biến nào được ghi nhận.
    </div>
  <?php else: ?>
    <div class="tbl-wrap">
      <table class="tbl">
        <thead>
          <tr>
            <th style="width:200px;">Ngày giờ</th>
            <th>Nội dung</th>
            <th style="width:220px;">Người ghi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($dienBien as $db): ?>
            <tr>
              <td><?= e($db['ngay_gio']) ?></td>
              <td><?= nl2br(e($db['noi_dung'])) ?></td>
              <td><?= e($db['nguoi_ghi'] ?? 'Hệ thống') ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>

<?php require __DIR__ . "/../layout/AdminFooter.php"; ?>
