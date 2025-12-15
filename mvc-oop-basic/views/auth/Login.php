<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Đăng nhập</title>
</head>

<body>
    <h2>Đăng nhập hệ thống</h2>

    <?php if (!empty($err)): ?>
    <p style="color:red;">
        <?php
        if ($err === 'missing') echo "Vui lòng nhập đầy đủ thông tin.";
        else echo "Sai tài khoản hoặc mật khẩu.";
      ?>
    </p>
    <?php endif; ?>

    <form method="post" action="<?= e(base_url('index.php?c=auth&a=handle_login')) ?>">
        <div>
            <label>Username</label><br>
            <input name="username" required>
        </div>
        <br>
        <div>
            <label>Password</label><br>
            <input type="password" name="password" required>
        </div>
        <br>
        <button type="submit">Đăng nhập</button>
    </form>
</body>

</html>