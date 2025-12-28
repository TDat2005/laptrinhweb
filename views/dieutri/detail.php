<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Chi tiết hồ sơ điều trị</title>
    <style>
    body {
        font-family: system-ui, Arial;
        padding: 18px;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 20px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
        vertical-align: top;
    }

    th {
        background: #f6f7f9;
    }

    .msg {
        padding: 10px;
        border: 1px solid #ddd;
        background: #f9fafb;
        border-radius: 10px;
        margin-bottom: 12px;
    }

    .msg.success {
        background: #d1fae5;
        border-color: #10b981;
    }

    .msg.error {
        background: #fee2e2;
        border-color: #ef4444;
    }

    a.btn {
        display: inline-block;
        padding: 8px 10px;
        border: 1px solid #ddd;
        border-radius: 10px;
        text-decoration: none;
        margin-right: 5px;
    }

    .info-box {
        background: #f9fafb;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-group textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-family: inherit;
        min-height: 100px;
    }

    button {
        padding: 10px 20px;
        background: #3b82f6;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background: #2563eb;
    }
    </style>
</head>

<body>

    <h2>Chi tiết hồ sơ điều trị</h2>

    <?php if (!empty($msg)): ?>
    <div class="msg <?= $msg === 'success' ? 'success' : 'error' ?>">
        <?php
        if ($msg === 'success') echo "✅ Ghi nhận diễn biến thành công.";
        elseif ($msg === 'error') echo "⚠️ Có lỗi xảy ra. Vui lòng thử lại.";
        ?>
    </div>
    <?php endif; ?>

    <div class="info-box">
        <h3>Thông tin hồ sơ</h3>
        <table>
            <tr>
                <th style="width: 200px;">Mã hồ sơ</th>
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
        </table>
    </div>

    <h3>Ghi nhận diễn biến điều trị</h3>
    <form method="POST" action="<?= e(base_url('index.php?c=dieutri&a=add_record')) ?>">
        <input type="hidden" name="id_ho_so" value="<?= (int)$hoSo['id'] ?>">
        <div class="form-group">
            <label for="noi_dung">Nội dung diễn biến:</label>
            <textarea id="noi_dung" name="noi_dung" required
                placeholder="Nhập nội dung diễn biến điều trị..."></textarea>
        </div>
        <button type="submit">Ghi nhận diễn biến</button>
    </form>

    <h3>Lịch sử diễn biến điều trị</h3>
    <?php if (empty($dienBien)): ?>
    <p>Chưa có diễn biến nào được ghi nhận.</p>
    <?php else: ?>
    <table>
        <thead>
            <tr>
                <th style="width: 180px;">Ngày giờ</th>
                <th>Nội dung</th>
                <th style="width: 200px;">Người ghi</th>
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
    <?php endif; ?>

    <p style="margin-top: 20px;">
        <a class="btn" href="<?= e(base_url('index.php?c=dieutri&a=list')) ?>">← Quay lại danh sách</a>
        <a class="btn" href="<?= e(base_url('index.php')) ?>">Về dashboard</a>
    </p>

</body>

</html>