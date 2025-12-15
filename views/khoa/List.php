<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Quản lý khoa</title>
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
    </style>
</head>

<body>

    <h2>Quản lý khoa</h2>

    <?php if (!empty($msg)): ?>
    <div class="msg">
        <?php
      if ($msg==='created') echo "✅ Thêm khoa thành công.";
      elseif ($msg==='updated') echo "✅ Cập nhật khoa thành công.";
      elseif ($msg==='deleted') echo "✅ Xóa khoa thành công.";
      elseif ($msg==='cannot_delete') echo "⚠️ Không thể xóa khoa vì đang có phòng thuộc khoa này.";
      else echo "✅ Thao tác thành công.";
    ?>
    </div>
    <?php endif; ?>

    <p>
        <a class="btn" href="<?= e(base_url('index.php?c=khoa&a=add')) ?>">+ Thêm khoa</a>
        &nbsp;|&nbsp;
        <a class="btn" href="<?= e(base_url('index.php')) ?>">Về dashboard</a>
    </p>

    <table>
        <thead>
            <tr>
                <th style="width:80px;">ID</th>
                <th style="width:260px;">Tên khoa</th>
                <th>Mô tả</th>
                <th style="width:260px;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($khoas as $k): ?>
            <tr>
                <td><?= (int)$k['id'] ?></td>
                <td><?= e($k['ten_khoa']) ?></td>
                <td><?= e($k['mo_ta'] ?? '') ?></td>
                <td>
                    <a class="btn" href="<?= e(base_url('index.php?c=khoa&a=edit&id='.(int)$k['id'])) ?>">Sửa</a>
                    <a class="btn danger" href="<?= e(base_url('index.php?c=khoa&a=delete&id='.(int)$k['id'])) ?>"
                        onclick="return confirm('Xóa khoa này? (Chỉ xóa được nếu khoa không có phòng)')">
                        Xóa
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>