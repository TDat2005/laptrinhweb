<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Chi tiết hồ sơ</title>
    <style>
    body {
        font-family: system-ui, Arial;
        padding: 18px;
    }

    .box {
        border: 1px solid #ddd;
        border-radius: 12px;
        padding: 14px;
        margin-bottom: 12px;
        background: #fafafa;
    }

    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 10px;
        min-height: 100px;
    }

    label {
        display: block;
        margin: 10px 0 6px;
    }

    button {
        padding: 10px 12px;
        border: 0;
        border-radius: 10px;
        background: #3b82f6;
        color: #06122b;
        font-weight: 700;
        cursor: pointer;
    }

    a.btn {
        display: inline-block;
        padding: 8px 10px;
        border: 1px solid #ddd;
        border-radius: 10px;
        text-decoration: none;
    }

    .err {
        padding: 10px;
        border: 1px solid #fecaca;
        background: #fff1f2;
        border-radius: 10px;
        margin-bottom: 12px;
    }

    .note {
        border: 1px solid #ddd;
        border-radius: 12px;
        padding: 12px;
        margin: 10px 0;
        background: white;
    }

    small {
        color: #64748b;
    }
    </style>
</head>

<body>

    <h2>Chi tiết hồ sơ: <?= e($hoso['ma_ho_so']) ?></h2>

    <div class="box">
        <b>Bệnh nhân:</b> <?= e($hoso['ma_bn'].' - '.$hoso['ho_ten']) ?><br>
        <b>Khoa/Phòng/Giường:</b> <?= e($hoso['ten_khoa']) ?> / <?= e($hoso['ten_phong']) ?> /
        <?= e($hoso['ma_giuong']) ?><br>
        <b>Bác sĩ phụ trách:</b> <?= e($hoso['ten_bac_si'] ?? '') ?><br>
        <small>Ngày nhập: <?= e($hoso['ngay_nhap']) ?></small>
        <?php if (!empty($hoso['chan_doan_ban_dau'])): ?>
        <div style="margin-top:8px"><b>Chẩn đoán ban đầu:</b><br><?= nl2br(e($hoso['chan_doan_ban_dau'])) ?></div>
        <?php endif; ?>
    </div>

    <?php if (!empty($errors)): ?>
    <div class="err">
        <b>Lỗi:</b>
        <ul><?php foreach($errors as $e): ?><li><?= e($e) ?></li><?php endforeach; ?></ul>
    </div>
    <?php endif; ?>

    <div class="box">
        <form method="post" action="<?= e(base_url('index.php?c=bacsi&a=detail&id_ho_so='.(int)$hoso['id'])) ?>">
            <label>Ghi diễn biến điều trị</label>
            <textarea name="noi_dung" required placeholder="VD: BN đỡ sốt, mạch..., huyết áp..., xử trí..."></textarea>
            <br><br>
            <button type="submit">Lưu diễn biến</button>
            &nbsp; <a class="btn" href="<?= e(base_url('index.php?c=bacsi&a=my')) ?>">Quay lại</a>
        </form>
    </div>

    <h3>Lịch sử diễn biến</h3>
    <?php if (empty($notes)): ?>
    <p>Chưa có diễn biến.</p>
    <?php else: ?>
    <?php foreach ($notes as $n): ?>
    <div class="note">
        <b><?= e($n['ngay_gio']) ?></b>
        <small> — <?= e($n['ten_nguoi_cap_nhat'] ?? '') ?></small>
        <div style="margin-top:8px"><?= nl2br(e($n['noi_dung'])) ?></div>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>

</body>

</html>