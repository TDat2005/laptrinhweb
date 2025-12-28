<?php /** @var array $errors */ /** @var array $user */ 
require __DIR__ . "/../layout/AdminHeader.php";
?>
<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đổi mật khẩu</title>
    <link rel="stylesheet" href="<?= e(base_url('public/css/admin.css')) ?>">
</head>

<body>

    <div class="page">
        <div class="page-head">
            <div>
                <div class="page-title">Đổi mật khẩu</div>
                <div class="page-sub">Tài khoản: <?= e($user['username']) ?></div>
            </div>
            <div class="actions">
                <a class="btn btn-outline" href="<?= e(base_url('index.php?c=user&a=list')) ?>">Quay lại</a>
            </div>
        </div>

        <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <b>Lỗi:</b>
            <ul style="margin:8px 0 0 18px;">
                <?php foreach ($errors as $e): ?><li><?= e($e) ?></li><?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <div class="panel">
            <form method="post" action="<?= e(base_url('index.php?c=user&a=reset_password&id='.(int)$user['id'])) ?>">
                <div class="form-grid">
                    <div class="field">
                        <label>Mật khẩu mới</label>
                        <input class="input" type="password" name="password" required>
                    </div>

                    <div class="field">
                        <label>Xác nhận mật khẩu</label>
                        <input class="input" type="password" name="confirm_password" required>
                    </div>

                    <div class="full actions" style="justify-content:flex-end;margin-top:6px;">
                        <button class="btn" type="submit">Cập nhật mật khẩu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>

</html>