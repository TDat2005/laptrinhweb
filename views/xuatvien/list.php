<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Danh sách xuất viện</title>
    <style>
    body {
        font-family: system-ui, Arial;
        padding: 18px;
    }

    table {
        border-collapse: collapse;
        width: 100%;
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
    </style>
</head>

<body>

    <h2>Danh sách bệnh nhân đang điều trị (Xuất viện)</h2>

    <?php if (!empty($msg)): ?>
    <div class="msg <?= $msg === 'success' ? 'success' : 'error' ?>">
        <?php
        if ($msg === 'success') echo "✅ Xuất viện thành công.";
        elseif ($msg === 'already_discharged') echo "⚠️ Hồ sơ này đã được xuất viện.";
        elseif ($msg === 'not_found') echo "⚠️ Không tìm thấy hồ sơ.";
        else echo "⚠️ Có lỗi xảy ra.";
        ?>
    </div>
    <?php endif; ?>

    <p>
        <a class="btn" href="<?= e(base_url('index.php')) ?>">← Về dashboard</a>
    </p>

    <?php if (empty($danhSach)): ?>
    <p>Không có bệnh nhân nào đang điều trị.</p>
    <?php else: ?>
    <table>
        <thead>
            <tr>
                <th style="width: 150px;">Mã hồ sơ</th>
                <th>Tên bệnh nhân</th>
                <th>Khoa</th>
                <th>Phòng</th>
                <th>Giường</th>
                <th>Ngày nhập viện</th>
                <th style="width: 150px;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($danhSach as $hs): ?>
            <tr>
                <td><?= e($hs['ma_ho_so']) ?></td>
                <td><?= e($hs['ho_ten']) ?></td>
                <td><?= e($hs['ten_khoa']) ?></td>
                <td><?= e($hs['ten_phong']) ?></td>
                <td><?= e($hs['ma_giuong']) ?></td>
                <td><?= e($hs['ngay_nhap']) ?></td>
                <td>
                    <a class="btn" href="<?= e(base_url('index.php?c=xuatvien&a=add&id=' . (int)$hs['id'])) ?>">
                        Xuất viện
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>

</body>

</html>