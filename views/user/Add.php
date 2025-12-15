<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Thêm tài khoản</title>
    <style>
    body {
        font-family: system-ui, Arial;
        padding: 18px;
    }

    .box {
        max-width: 520px;
        border: 1px solid #ddd;
        border-radius: 12px;
        padding: 16px;
    }

    input,
    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 10px;
    }

    label {
        display: block;
        margin: 10px 0 6px;
    }

    .err {
        padding: 10px;
        border: 1px solid #fecaca;
        background: #fff1f2;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    button {
        padding: 10px 12px;
        border: 0;
        border-radius: 10px;
        background: #22c55e;
        color: #052e12;
        font-weight: 700;
        cursor: pointer;
    }

    a {
        color: #2563eb;
        text-decoration: none;
    }
    </style>
</head>

<body>

    <h2>Thêm tài khoản</h2>

    <div class="box">
        <?php if (!empty($errors)): ?>
        <div class="err">
            <b>Lỗi:</b>
            <ul>
                <?php foreach ($errors as $e): ?><li><?= e($e) ?></li><?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <form method="post" action="<?= e(base_url('index.php?c=user&a=add')) ?>">
            <label>Username</label>
            <input name="username" value="<?= e($old['username']) ?>" required>

            <label>Họ tên</label>
            <input name="full_name" value="<?= e($old['full_name']) ?>" required>

            <label>Role</label>
            <select name="role">
                <?php
        $roles = ['admin'=>'Admin','doctor'=>'Doctor','nurse'=>'Nurse','reception'=>'Reception'];
        foreach ($roles as $k=>$v):
      ?>
                <option value="<?= e($k) ?>" <?= $old['role']===$k?'selected':'' ?>><?= e($v) ?></option>
                <?php endforeach; ?>
            </select>

            <label>Trạng thái</label>
            <select name="status">
                <option value="1" <?= (int)$old['status']===1?'selected':'' ?>>Active</option>
                <option value="0" <?= (int)$old['status']===0?'selected':'' ?>>Locked</option>
            </select>

            <label>Mật khẩu</label>
            <input type="password" name="password" required>

            <label>Xác nhận mật khẩu</label>
            <input type="password" name="confirm_password" required>

            <br><br>
            <button type="submit">Tạo tài khoản</button>
            &nbsp; <a href="<?= e(base_url('index.php?c=user&a=list')) ?>">Quay lại</a>
        </form>
    </div>

</body>

</html>