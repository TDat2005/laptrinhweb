<?php
$errMsg = '';
if (!empty($err)) {
  if ($err === 'missing') $errMsg = 'Vui lòng nhập đầy đủ tài khoản và mật khẩu.';
  elseif ($err === 'wrong_password') $errMsg = 'Sai mật khẩu.';
  elseif ($err === 'invalid') $errMsg = 'Sai tài khoản hoặc tài khoản bị khóa.';
  elseif ($err === 'registered') $errMsg = 'Đăng ký thành công, mời đăng nhập.';
  else $errMsg = 'Có lỗi xảy ra, vui lòng thử lại.';
}
?>

<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập hệ thống</title>
    <link rel="stylesheet" href="<?= e(base_url('public/css/admin.css')) ?>">
</head>

<body>
    <div class="shell" style="justify-content:center;align-items:center;padding:20px;">

        <section class="card" style="width:420px;max-width:100%;">

            <div class="brand" style="margin-bottom:14px;">
                <div class="title">CLINIC ADMIN</div>
                <div class="sub">Quản lý bệnh nhân nội trú</div>
            </div>

            <div class="value" style="font-size:18px;">Đăng nhập</div>
            <div class="label" style="margin-top:6px;">Vui lòng đăng nhập bằng tài khoản được cấp</div>

            <?php if ($errMsg): ?>
            <div class="card" style="margin-top:12px;border-color:#fecaca;background:#fff1f2;">
                <div class="label" style="color:#b91c1c;">Lỗi</div>
                <div class="value" style="font-size:13px;color:#b91c1c;margin-top:6px;">
                    <?= e($errMsg) ?>
                </div>
            </div>
            <?php endif; ?>

            <form method="post" action="<?= e(base_url('index.php?c=auth&a=handle_login')) ?>" style="margin-top:14px;">

                <div class="label">Tên đăng nhập</div>
                <input name="username" required autofocus
                    style="width:100%;margin-top:6px;margin-bottom:12px;padding:10px 12px;border-radius:10px;border:1px solid var(--border);">

                <div class="label">Mật khẩu</div>
                <input type="password" name="password" required
                    style="width:100%;margin-top:6px;margin-bottom:12px;padding:10px 12px;border-radius:10px;border:1px solid var(--border);">

                <button class="btn" style="width:100%;">Đăng nhập</button>
            </form>

            <!-- Quên mật khẩu + Đăng ký -->
            <div style="display:flex;justify-content:space-between;gap:10px;margin-top:12px;">
                <a href="<?= e(base_url('index.php?c=auth&a=forgot')) ?>"
                    style="font-size:13px;color:var(--primary);text-decoration:none;">
                    Quên mật khẩu?
                </a>

                <a href="<?= e(base_url('index.php?c=auth&a=register')) ?>"
                    style="font-size:13px;color:var(--primary);text-decoration:none;">
                    Đăng ký tài khoản
                </a>
            </div>

            <div class="label" style="margin-top:14px;text-align:center;">
                © <?= date('Y') ?> — Nội trú Hospital System
            </div>

        </section>
    </div>
</body>

</html>