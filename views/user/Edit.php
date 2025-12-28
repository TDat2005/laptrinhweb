<?php /** @var array $errors */ /** @var array $old */ /** @var array $user */ ?>
<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sửa tài khoản</title>
    <link rel="stylesheet" href="<?= e(base_url('public/css/admin.css')) ?>">
</head>

<body>

    <div class="page">
        <div class="page-head">
            <div>
                <div class="page-title">Sửa tài khoản #<?= (int)$user['id'] ?></div>
                <div class="page-sub">Cập nhật thông tin người dùng</div>
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
            <form method="post" action="<?= e(base_url('index.php?c=user&a=edit&id='.(int)$user['id'])) ?>">
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
              $roles = ['admin'=>'Admin','doctor'=>'Doctor','nurse'=>'Nurse','reception'=>'Reception'];
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

                    <div class="full actions" style="justify-content:flex-end;margin-top:6px;">
                        <button class="btn" type="submit">Lưu thay đổi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>

</html>