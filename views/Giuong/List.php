<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Quản lý giường</title>
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

    a.btn {
        display: inline-block;
        padding: 8px 10px;
        border: 1px solid #ddd;
        border-radius: 10px;
        text-decoration: none;
    }

    .danger {
        border-color: #fecaca;
    }

    .tag {
        padding: 3px 8px;
        border-radius: 999px;
        font-size: 12px;
        display: inline-block;
    }

    .on {
        background: #e8fff0;
        color: #166534;
    }

    .off {
        background: #fee2e2;
        color: #991b1b;
    }
    </style>
</head>

<body>

    <h2>Quản lý giường</h2>

    <?php if (!empty($msg)): ?>
    <div class="msg">
        <?php
      if ($msg==='created') echo "✅ Thêm giường thành công.";
      elseif ($msg==='updated') echo "✅ Cập nhật giường thành công.";
      elseif ($msg==='deleted') echo "✅ Xóa giường thành công.";
      elseif ($msg==='status') echo "✅ Đã đổi trạng thái giường.";
      elseif ($msg==='cannot_delete') echo "⚠️ Không thể xóa giường (chỉ xóa được khi giường TRỐNG và chưa bị ràng buộc hồ sơ).";
      else echo "✅ Thao tác thành công.";
    ?>
    </div>
    <?php endif; ?>

    <p>
        <a class="btn" href="<?= e(base_url('index.php?c=giuong&a=add')) ?>">+ Thêm giường</a>
        &nbsp;|&nbsp;
        <a class="btn" href="<?= e(base_url('index.php')) ?>">Về dashboard</a>
    </p>

    <table>
        <thead>
            <tr>
                <th style="width:80px;">ID</th>
                <th style="width:140px;">Mã giường</th>
                <th style="width:200px;">Khoa</th>
                <th style="width:160px;">Phòng</th>
                <th style="width:150px;">Trạng thái</th>
                <th>Ghi chú</th>
                <th style="width:300px;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($giuongs as $g): ?>
            <tr>
                <td><?= (int)$g['id'] ?></td>
                <td><?= e($g['ma_giuong']) ?></td>
                <td><?= e($g['ten_khoa']) ?></td>
                <td><?= e($g['ten_phong']) ?></td>
                <td>
                    <?php if (($g['trang_thai'] ?? '') === 'trong'): ?>
                    <span class="tag on">Trống</span>
                    <?php else: ?>
                    <span class="tag off">Đang sử dụng</span>
                    <?php endif; ?>
                </td>
                <td><?= e($g['ghi_chu'] ?? '') ?></td>
                <td>
                    <a class="btn" href="<?= e(base_url('index.php?c=giuong&a=edit&id='.(int)$g['id'])) ?>">Sửa</a>
                    <a class="btn" href="<?= e(base_url('index.php?c=giuong&a=toggle_status&id='.(int)$g['id'])) ?>"
                        onclick="return confirm('Đổi trạng thái giường này?')">
                        Đổi trạng thái
                    </a>
                    <a class="btn danger" href="<?= e(base_url('index.php?c=giuong&a=delete&id='.(int)$g['id'])) ?>"
                        onclick="return confirm('Xóa giường này? (Chỉ xóa khi giường TRỐNG)')">
                        Xóa
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>