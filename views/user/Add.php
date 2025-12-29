<?php /** @var array $errors */ /** @var array $old */
require __DIR__ . "/../layout/AdminHeader.php";
?>
<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm tài khoản</title>
    <link rel="stylesheet" href="<?= e(base_url('public/css/admin.css')) ?>">
</head>

<body>

    <div class="page">
        <div class="page-head">
            <div>
                <div class="page-title">Thêm tài khoản</div>
                <div class="page-sub">Tạo mới người dùng hệ thống</div>
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
            <form method="post" action="<?= e(base_url('index.php?c=user&a=add')) ?>">
                <div class="form-grid">
                    <div class="field">
                        <label>Username</label>
                        <input class="input" name="username" value="<?= e($old['username'] ?? '') ?>" required>
                    </div>

                    <div class="field">
                        <label>Họ tên</label>
                        <input class="input" name="full_name" value="<?= e($old['full_name'] ?? '') ?>" required>
                    </div>

                    <div class="field">
                        <label>Role</label>
                        <select class="select" name="role">
                            <?php
              $roles = ['admin'=>'Admin','doctor'=>'Doctor','patient'=>'Patient'];
              $oldRole = $old['role'] ?? 'reception';
              foreach ($roles as $k=>$v):
            ?>
                            <option value="<?= e($k) ?>" <?= $oldRole===$k?'selected':'' ?>><?= e($v) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="field">
                        <label>Trạng thái</label>
                        <?php $st = (int)($old['status'] ?? 1); ?>
                        <select class="select" name="status">
                            <option value="1" <?= $st===1?'selected':'' ?>>Active</option>
                            <option value="0" <?= $st===0?'selected':'' ?>>Locked</option>
                        </select>
                    </div>

                    <div class="field">
                        <label>Mật khẩu</label>
                        <input class="input" type="password" name="password" required>
                    </div>

                    <div class="field">
                        <label>Xác nhận mật khẩu</label>
                        <input class="input" type="password" name="confirm_password" required>
                    </div>

                    <div class="full actions" style="justify-content:flex-end;margin-top:6px;">
                        <button class="btn" type="submit">Tạo tài khoản</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>

</html>