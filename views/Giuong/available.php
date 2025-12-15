<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Giường trống</title>
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

    .box {
        border: 1px solid #ddd;
        border-radius: 12px;
        padding: 14px;
        margin-bottom: 12px;
        background: #fafafa;
    }

    .row {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    select {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 10px;
        min-width: 260px;
    }

    .btn {
        display: inline-block;
        padding: 9px 12px;
        border: 1px solid #ddd;
        border-radius: 10px;
        text-decoration: none;
        background: white;
    }

    .hint {
        color: #64748b;
        font-size: 13px;
        margin-top: 6px;
    }

    .tag {
        padding: 3px 8px;
        border-radius: 999px;
        font-size: 12px;
        display: inline-block;
        background: #e8fff0;
        color: #166534;
    }
    </style>
</head>

<body>

    <h2>Danh sách giường trống</h2>

    <div class="box">
        <form method="get" action="<?= e(base_url('index.php')) ?>">
            <input type="hidden" name="c" value="giuong">
            <input type="hidden" name="a" value="available">

            <div class="row">
                <div>
                    <div><b>Lọc theo khoa</b></div>
                    <select name="id_khoa" onchange="this.form.submit()">
                        <option value="0">-- Tất cả khoa --</option>
                        <?php foreach ($khoas as $k): ?>
                        <option value="<?= (int)$k['id'] ?>" <?= ((int)$idKhoa===(int)$k['id'])?'selected':'' ?>>
                            <?= e($k['ten_khoa']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="hint">Chọn khoa để hiện danh sách phòng tương ứng.</div>
                </div>

                <div>
                    <div><b>Lọc theo phòng</b></div>
                    <select name="id_phong" <?= ($idKhoa>0 ? '' : 'disabled') ?> onchange="this.form.submit()">
                        <option value="0">-- Tất cả phòng --</option>
                        <?php foreach ($phongs as $p): ?>
                        <option value="<?= (int)$p['id'] ?>" <?= ((int)$idPhong===(int)$p['id'])?'selected':'' ?>>
                            <?= e($p['ten_phong']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="hint">
                        <?= $idKhoa>0 ? 'Chọn phòng để lọc sâu hơn.' : 'Chọn khoa trước.' ?>
                    </div>
                </div>

                <div style="display:flex;align-items:flex-end;gap:10px;">
                    <a class="btn" href="<?= e(base_url('index.php?c=giuong&a=available')) ?>">Reset lọc</a>
                    <a class="btn" href="<?= e(base_url('index.php')) ?>">Về dashboard</a>
                    <a class="btn" href="<?= e(base_url('index.php?c=giuong&a=list')) ?>">Quản lý giường</a>
                </div>
            </div>
        </form>
    </div>

    <p>
        Tổng giường trống: <b><?= count($giuongs) ?></b>
    </p>

    <table>
        <thead>
            <tr>
                <th style="width:90px;">ID</th>
                <th style="width:140px;">Mã giường</th>
                <th style="width:220px;">Khoa</th>
                <th style="width:180px;">Phòng</th>
                <th>Ghi chú</th>
                <th style="width:160px;">Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($giuongs)): ?>
            <tr>
                <td colspan="6">Không có giường trống theo bộ lọc hiện tại.</td>
            </tr>
            <?php else: ?>
            <?php foreach ($giuongs as $g): ?>
            <tr>
                <td><?= (int)$g['id'] ?></td>
                <td><?= e($g['ma_giuong']) ?></td>
                <td><?= e($g['ten_khoa']) ?></td>
                <td><?= e($g['ten_phong']) ?></td>
                <td><?= e($g['ghi_chu'] ?? '') ?></td>
                <td><span class="tag">Trống</span></td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</body>

</html>