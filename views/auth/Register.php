<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="<?= e(base_url('public/css/admin.css')) ?>">
    <style>
    .auth-wrap {
        max-width: 420px;
        margin: 60px auto;
        padding: 20px
    }

    .auth-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 18px
    }

    .auth-title {
        font-size: 22px;
        font-weight: 900;
        margin-bottom: 6px
    }

    .auth-sub {
        color: #64748b;
        font-size: 13px;
        margin-bottom: 14px
    }

    .auth-row {
        margin: 10px 0
    }

    .auth-row label {
        display: block;
        font-weight: 700;
        margin-bottom: 6px
    }

    .auth-row input {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #e5e7eb;
        border-radius: 12px
    }

    .auth-actions {
        display: flex;
        gap: 10px;
        margin-top: 14px;
        flex-wrap: wrap
    }

    .auth-err {
        padding: 10px 12px;
        border: 1px solid #fecaca;
        background: #fff1f2;
        border-radius: 12px;
        margin-bottom: 12px
    }
    </style>
</head>

<body style="background:#f6f7fb">

    <div class="auth-wrap">
        <div class="auth-card">
            <div class="auth-title">Đăng ký</div>
            <div class="auth-sub">Tạo tài khoản bệnh nhân để đặt lịch khám</div>

            <?php
      $map = [
        'missing' => 'Vui lòng nhập đủ thông tin.',
        'username_short' => 'Username tối thiểu 4 ký tự.',
        'password_short' => 'Mật khẩu tối thiểu 6 ký tự.',
        'confirm' => 'Mật khẩu xác nhận không khớp.',
        'exists' => 'Username đã tồn tại.',
        'db' => 'Không tạo được tài khoản (lỗi DB).',
      ];
      if (!empty($err) && isset($map[$err])): ?>
            <div class="auth-err"><?= e($map[$err]) ?></div>
            <?php endif; ?>

            <form method="post" action="<?= e(base_url('index.php?c=auth&a=handle_register')) ?>">
                <div class="auth-row">
                    <label>Username</label>
                    <input name="username" placeholder="vd: patient01" required>
                </div>

                <div class="auth-row">
                    <label>Họ tên</label>
                    <input name="full_name" placeholder="vd: Nguyễn Văn A" required>
                </div>

                <div class="auth-row">
                    <label>Mật khẩu</label>
                    <input type="password" name="password" required>
                </div>

                <div class="auth-row">
                    <label>Nhập lại mật khẩu</label>
                    <input type="password" name="confirm_password" required>
                </div>

                <div class="auth-actions">
                    <button class="btn" type="submit">Tạo tài khoản</button>
                    <a class="btn btn-outline" href="<?= e(base_url('index.php?c=auth&a=login')) ?>">Đã có tài khoản</a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>