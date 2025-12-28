<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Bác sĩ - Hồ sơ đang điều trị</title>
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
        vertical-align: top;
    }

    th {
        background: #f6f7f9;
    }

    a.btn {
        display: inline-block;
        padding: 8px 10px;
        border: 1px solid #ddd;
        border-radius: 10px;
        text-decoration: none;
    }
    </style>
</head>

<body>

    <h2><?= $isAdmin ? 'Hồ sơ đang điều trị (Admin xem tất cả)' : 'Hồ sơ đang điều trị của tôi' ?></h2>

    <p>
        <a class="btn" href="<?= e(base_url('index.php')) ?>">Dashboard</a>
    </p>

    <table>
        <thead>
            <tr>
                <th>Mã hồ sơ</th>
                <th>Bệnh nhân</th>
                <th>Khoa</th>
                <th>Phòng</th>
                <th>Giường</th>
                <th>Ngày nhập</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($list)): ?>
            <tr>
                <td colspan="7">Chưa có hồ sơ nào.</td>
            </tr>
            <?php else: ?>
            <?php foreach ($list as $r): ?>
            <tr>
                <td><?= e($r['ma_ho_so']) ?></td>
                <td><?= e($r['ma_bn']) ?> - <?= e($r['ho_ten']) ?></td>
                <td><?= e($r['ten_khoa']) ?></td>
                <td><?= e($r['ten_phong']) ?></td>
                <td><?= e($r['ma_giuong']) ?></td>
                <td><?= e($r['ngay_nhap']) ?></td>
                <td>
                    <a class="btn" href="<?= e(base_url('index.php?c=bacsi&a=detail&id_ho_so='.(int)$r['id'])) ?>">Xem /
                        Ghi diễn biến</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</body>

</html>