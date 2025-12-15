<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Quản lý tài khoản</title>
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
    }

    th {
        background: #f6f7f9;
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
    </style>
</head>

<body>

    <h2>Quản lý tài khoản người dùng</h2>

    <?php if (!empty($msg)): ?>
    <div class="msg">
        <?php
      if ($msg==='created') echo "✅ Tạo tài khoản thành công.";
      elseif ($msg==='updated') echo "✅ Cập nhật tài khoản thành công.";
      elseif ($msg==='status') echo "✅ Đã đổi trạng thái tài khoản.";
      elseif ($msg==='reset') echo "✅ Đã reset mật khẩu.";
      else echo "✅ Thao tác thành công.";
    ?>
    </div>
    <?php endif; ?>

    <p>
        <a class="btn" href="<?= e(base_url('index.php?c=user&a=add')) ?>">+ Thêm tài khoản</a>
        &nbsp;|&nbsp;
        <a class="btn" href="<?= e(base_url('index.php')) ?>">Về dashboard</a>
    </p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Họ tên</th>
                <th>Role</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $u): ?>
            <tr>
                <td><?= (int)$u['id'] ?></td>
                <td><?= e($u['username']) ?></td>
                <td><?= e($u['full_name']) ?></td>
                <td><?= e($u['role']) ?></td>
                <td>
                    <?php if ((int)$u['status']===1): ?>
                    <span class="tag on">Active</span>
                    <?php else: ?>
                    <span class="tag off">Locked</span>
                    <?php endif; ?>
                </td>
                <td><?= e($u['created_at'] ?? '') ?></td>
                <td>
                    <a class="btn" href="<?= e(base_url('index.php?c=user&a=edit&id='.(int)$u['id'])) ?>">Sửa</a>
                    <a class="btn" href="<?= e(base_url('index.php?c=user&a=reset_password&id='.(int)$u['id'])) ?>">Đổi
                        MK</a>
                    <a class="btn" href="<?= e(base_url('index.php?c=user&a=toggle_status&id='.(int)$u['id'])) ?>"
                        onclick="return confirm('Đổi trạng thái tài khoản này?')">
                        Khóa/Mở
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>