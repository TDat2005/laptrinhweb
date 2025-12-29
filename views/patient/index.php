<?php /** @var array $user */ ?>
<?php $u = current_user(); ?>
<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang bệnh nhân</title>
    <link rel="stylesheet" href="<?= e(base_url('public/css/admin.css')) ?>">
</head>

<body>
    <div class="page" style="max-width:980px;margin:0 auto;">

        <div class="page-head" style="justify-content:flex-start; align-items:flex-start; gap:12px; flex-wrap:wrap;">
            <div>
                <div class="page-title">Xin chào <?= e($u['full_name'] ?? '') ?></div>
                <div class="page-sub">Chọn chức năng bạn muốn sử dụng</div>
            </div>
        </div>

        <div class="grid" style="grid-template-columns:repeat(3, 1fr);">
            <div class="card">
                <div class="label">Lịch hẹn</div>
                <div class="value">Lịch hẹn của tôi</div>
                <a href="<?= e(base_url('index.php?c=lichhen&a=my')) ?>">Mở</a>
            </div>

            <div class="card">
                <div class="label">Hồ sơ</div>
                <div class="value">Thông tin cá nhân</div>
                <a href="<?= e(base_url('index.php?c=patient&a=profile')) ?>">Mở</a>
            </div>

            <div class="card">
                <div class="label">Tài khoản</div>
                <div class="value">Đăng xuất</div>
                <a href="<?= e(base_url('index.php?c=auth&a=logout')) ?>">Thoát</a>
            </div>
        </div>

        <div class="panel" style="margin-top:14px;">
            <div style="font-weight:800;margin-bottom:8px;">Gợi ý</div>
            <div style="color:var(--muted);font-size:13px;">
                Bạn có thể vào “Lịch hẹn của tôi” để xem trạng thái lịch hẹn, hoặc cập nhật hồ sơ cá nhân để đặt lịch
                nhanh hơn.
            </div>
        </div>

    </div>
</body>

</html>