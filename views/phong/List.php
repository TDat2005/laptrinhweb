<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Quản lý phòng</title>
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

    <h2>Quản lý phòng</h2>

    <?php if (!empty($msg)): ?>
    <div class="msg">
        <?php
      if ($msg==='created') echo "✅ Thêm phòng thành công.";
      elseif ($msg==='updated') echo "✅ Cập nhật phòng thành công.";
      elseif ($msg==='deleted') echo "✅ Xóa phòng thành công.";
      elseif ($msg==='cannot_delete') echo "⚠️ Không thể xóa phòng vì phòng đang có giường.";
      else echo "✅ Thao tác thành công.";
    ?>
    </div>
    <?php endif; ?>

    <p>
        <a class="btn" href="<?= e(base_url('index.php?c=phong&a=add')) ?>">+ Thêm phòng</a>
        &nbsp;|&nbsp;
        <a class="btn" href="<?= e(base_url('index.php')) ?>">Về dashboard</a>
    </p>

    <table>
        <thead>
            <tr>
                <th style="width:80px;">ID</th>
                <th style="width:200px;">Tên phòng</th>
                <th style="width:200px;">Khoa</th>
                <th style="width:160px;">Loại phòng</th>
                <th>Ghi chú</th>
                <th style="width:240px;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($phongs as $p): ?>
            <tr>
                <td><?= (int)$p['id'] ?></td>
                <td><?= e($p['ten_phong']) ?></td>
                <td><?= e($p['ten_khoa']) ?></td>
                <td><?= e($p['loai_phong'] ?? '') ?></td>
                <td><?= e($p['ghi_chu'] ?? '') ?></td>
                <td>
                    <a class="btn" href="<?= e(base_url('index.php?c=phong&a=edit&id='.(int)$p['id'])) ?>">Sửa</a>
                    <a class="btn danger" href="<?= e(base_url('index.php?c=phong&a=delete&id='.(int)$p['id'])) ?>"
                        onclick="return confirm('Xóa phòng này? (Chỉ xóa được nếu phòng chưa có giường)')">
                        Xóa
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>