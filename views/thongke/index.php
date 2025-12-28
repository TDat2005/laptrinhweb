<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Thống kê & Báo cáo</title>
    <style>
    body {
        font-family: system-ui, Arial;
        padding: 18px;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 30px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    th {
        background: #f6f7f9;
    }

    .filter-box {
        background: #f9fafb;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .filter-box form {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .filter-box select {
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .filter-box button {
        padding: 8px 20px;
        background: #3b82f6;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .summary-box {
        background: #e0f2fe;
        padding: 15px;
        border: 1px solid #0284c7;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .summary-box h3 {
        margin-top: 0;
    }

    .summary-box p {
        margin: 5px 0;
        font-size: 16px;
    }

    a.btn {
        display: inline-block;
        padding: 8px 10px;
        border: 1px solid #ddd;
        border-radius: 10px;
        text-decoration: none;
        margin-bottom: 20px;
    }

    .empty-message {
        padding: 20px;
        text-align: center;
        color: #666;
        font-style: italic;
    }
    </style>
</head>

<body>

    <h2>Thống kê & Báo cáo</h2>

    <a class="btn" href="<?= e(base_url('index.php')) ?>">← Về dashboard</a>

    <div class="filter-box">
        <form method="GET" action="<?= e(base_url('index.php')) ?>">
            <input type="hidden" name="c" value="thongke">
            <input type="hidden" name="a" value="index">
            <label>Tháng:</label>
            <select name="thang">
                <?php for ($i = 1; $i <= 12; $i++): ?>
                <option value="<?= $i ?>" <?= $thang == $i ? 'selected' : '' ?>>
                    Tháng <?= $i ?>
                </option>
                <?php endfor; ?>
            </select>

            <label>Năm:</label>
            <select name="nam">
                <?php
                $currentYear = (int)date('Y');
                for ($i = $currentYear - 2; $i <= $currentYear + 1; $i++):
                ?>
                <option value="<?= $i ?>" <?= $nam == $i ? 'selected' : '' ?>>
                    <?= $i ?>
                </option>
                <?php endfor; ?>
            </select>

            <button type="submit">Xem thống kê</button>
        </form>
    </div>

    <div class="summary-box">
        <h3>Tổng quan tháng <?= $thang ?>/<?= $nam ?></h3>
        <p><strong>Tổng số bệnh nhân đang điều trị:</strong> <?= number_format($tongDangDieuTri) ?></p>
        <p><strong>Tổng số nhập viện trong tháng:</strong> <?= number_format($tongNhapVien) ?></p>
        <p><strong>Tổng số xuất viện trong tháng:</strong> <?= number_format($tongXuatVien) ?></p>
    </div>

    <h3>Số bệnh nhân đang điều trị theo khoa</h3>
    <?php if (empty($theoKhoa)): ?>
    <div class="empty-message">Không có dữ liệu</div>
    <?php else: ?>
    <table>
        <thead>
            <tr>
                <th style="width: 80px;">ID</th>
                <th>Khoa</th>
                <th style="width: 150px;">Số lượng</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($theoKhoa as $k): ?>
            <tr>
                <td><?= (int)$k['id'] ?></td>
                <td><?= e($k['ten_khoa']) ?></td>
                <td style="text-align: center;"><?= number_format((int)$k['so_luong']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>

    <h3>Thống kê nhập/xuất viện tháng <?= $thang ?>/<?= $nam ?></h3>
    <?php if (empty($theoThang)): ?>
    <div class="empty-message">Không có dữ liệu trong tháng này</div>
    <?php else: ?>
    <table>
        <thead>
            <tr>
                <th style="width: 200px;">Ngày</th>
                <th style="width: 200px;">Số nhập viện</th>
                <th style="width: 200px;">Số xuất viện</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($theoThang as $t): ?>
            <tr>
                <td><?= e($t['ngay']) ?></td>
                <td style="text-align: center;"><?= number_format($t['so_nhap_vien']) ?></td>
                <td style="text-align: center;"><?= number_format($t['so_xuat_vien']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>

</body>

</html>