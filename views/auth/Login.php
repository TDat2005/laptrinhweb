<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập hệ thống</title>

    <style>
    :root {
        --bg1: #0f172a;
        --bg2: #111827;
        --card: #0b1220cc;
        --border: #1f2937;
        --text: #e5e7eb;
        --muted: #94a3b8;
        --primary: #22c55e;
        --danger: #ef4444;
        --input: #0b1220;
        --ring: rgba(34, 197, 94, .35);
        --shadow: 0 18px 55px rgba(0, 0, 0, .45);
        --radius: 18px;
    }

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        min-height: 100vh;
        font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, "Apple Color Emoji", "Segoe UI Emoji";
        color: var(--text);
        background:
            radial-gradient(1200px 700px at 20% 10%, rgba(34, 197, 94, .18), transparent 60%),
            radial-gradient(900px 600px at 80% 20%, rgba(59, 130, 246, .16), transparent 55%),
            linear-gradient(160deg, var(--bg1), var(--bg2));
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 28px 16px;
    }

    .wrap {
        width: 100%;
        max-width: 980px;
        display: grid;
        grid-template-columns: 1.2fr .9fr;
        gap: 18px;
        align-items: stretch;
    }

    .brand {
        border: 1px solid rgba(255, 255, 255, .06);
        background: linear-gradient(180deg, rgba(255, 255, 255, .06), rgba(255, 255, 255, .02));
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        padding: 26px 26px;
        position: relative;
        overflow: hidden;
    }

    .brand:before {
        content: "";
        position: absolute;
        inset: -2px;
        background:
            radial-gradient(500px 220px at 20% 30%, rgba(34, 197, 94, .18), transparent 70%),
            radial-gradient(500px 220px at 80% 60%, rgba(59, 130, 246, .16), transparent 75%);
        filter: blur(0px);
        pointer-events: none;
    }

    .brand>* {
        position: relative;
        z-index: 1;
    }

    .logo {
        width: 46px;
        height: 46px;
        border-radius: 14px;
        background: rgba(34, 197, 94, .15);
        border: 1px solid rgba(34, 197, 94, .25);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 14px;
    }

    .logo svg {
        width: 26px;
        height: 26px;
        fill: var(--primary);
    }

    .brand h1 {
        margin: 6px 0 8px;
        font-size: 26px;
        letter-spacing: .2px;
    }

    .brand p {
        margin: 0;
        color: var(--muted);
        line-height: 1.55;
        font-size: 14.5px;
        max-width: 46ch;
    }

    .bullets {
        margin-top: 18px;
        display: grid;
        gap: 10px;
    }

    .bullet {
        display: flex;
        gap: 10px;
        align-items: flex-start;
        padding: 10px 12px;
        border-radius: 14px;
        border: 1px solid rgba(255, 255, 255, .06);
        background: rgba(0, 0, 0, .15);
    }

    .dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin-top: 5px;
        background: var(--primary);
        box-shadow: 0 0 0 6px rgba(34, 197, 94, .12);
        flex: 0 0 auto;
    }

    .bullet .t {
        font-size: 13.5px;
        color: var(--text);
        opacity: .92;
        line-height: 1.45;
    }

    .card {
        border: 1px solid rgba(255, 255, 255, .08);
        background: rgba(11, 18, 32, .74);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        padding: 22px 22px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 14px;
        position: relative;
        overflow: hidden;
    }

    .card:before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(255, 255, 255, .06), transparent 55%);
        pointer-events: none;
    }

    .card>* {
        position: relative;
        z-index: 1;
    }

    .title {
        margin: 0;
        font-size: 18px;
        letter-spacing: .2px;
    }

    .subtitle {
        margin: 0;
        color: var(--muted);
        font-size: 13.5px;
        line-height: 1.45;
    }

    .alert {
        border-radius: 14px;
        padding: 10px 12px;
        border: 1px solid rgba(239, 68, 68, .25);
        background: rgba(239, 68, 68, .08);
        color: #fecaca;
        font-size: 13.5px;
        display: flex;
        gap: 10px;
        align-items: flex-start;
    }

    .alert svg {
        width: 18px;
        height: 18px;
        fill: var(--danger);
        flex: 0 0 auto;
        margin-top: 2px;
    }

    .form {
        display: grid;
        gap: 12px;
        margin-top: 6px;
    }

    .field label {
        display: block;
        margin-bottom: 6px;
        font-size: 13px;
        color: #cbd5e1;
    }

    .input {
        width: 100%;
        padding: 12px 12px;
        border-radius: 14px;
        border: 1px solid rgba(255, 255, 255, .10);
        background: rgba(5, 10, 20, .55);
        color: var(--text);
        outline: none;
        transition: .15s ease;
        font-size: 14px;
    }

    .input::placeholder {
        color: rgba(148, 163, 184, .75);
    }

    .input:focus {
        border-color: rgba(34, 197, 94, .55);
        box-shadow: 0 0 0 5px var(--ring);
    }

    .row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-top: 2px;
    }

    .check {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--muted);
        font-size: 13px;
        user-select: none;
    }

    .check input {
        accent-color: var(--primary);
    }

    .btn {
        width: 100%;
        border: 0;
        cursor: pointer;
        padding: 12px 14px;
        border-radius: 14px;
        background: linear-gradient(90deg, rgba(34, 197, 94, 1), rgba(16, 185, 129, 1));
        color: #06240f;
        font-weight: 700;
        font-size: 14px;
        letter-spacing: .2px;
        transition: transform .12s ease, filter .12s ease;
        margin-top: 2px;
    }

    .btn:hover {
        filter: brightness(1.02);
        transform: translateY(-1px);
    }

    .btn:active {
        transform: translateY(0px);
    }

    .footer {
        margin-top: 10px;
        color: rgba(148, 163, 184, .8);
        font-size: 12.5px;
        text-align: center;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 10px;
        border-radius: 999px;
        border: 1px solid rgba(255, 255, 255, .10);
        background: rgba(0, 0, 0, .18);
        color: rgba(229, 231, 235, .9);
        font-size: 12.5px;
    }

    .badge .pill {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--primary);
        box-shadow: 0 0 0 6px rgba(34, 197, 94, .12);
    }

    @media (max-width: 880px) {
        .wrap {
            grid-template-columns: 1fr;
        }

        .brand {
            display: none;
        }
    }
    </style>
</head>

<body>

    <?php
  // $err có thể là: missing | invalid | ...
  $errMsg = '';
  if (!empty($err)) {
    if ($err === 'missing') $errMsg = 'Vui lòng nhập đầy đủ tài khoản và mật khẩu.';
    else $errMsg = 'Tài khoản hoặc mật khẩu không đúng. Vui lòng thử lại.';
  }
?>

    <div class="wrap">

        <!-- Khối giới thiệu (ẩn trên mobile để gọn) -->
        <section class="brand">
            <div class="logo" aria-hidden="true">
                <!-- Icon y tế đơn giản -->
                <svg viewBox="0 0 24 24">
                    <path
                        d="M10 2h4a2 2 0 0 1 2 2v3h3a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-3v3a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2v-3H5a2 2 0 0 1-2-2V11a2 2 0 0 1 2-2h3V4a2 2 0 0 1 2-2Zm0 7H5v6h5v5h4v-5h5V9h-5V4h-4v5Z" />
                </svg>
            </div>

            <div class="badge"><span class="pill"></span> Hệ thống nội bộ bệnh viện</div>

            <h1>Quản lý bệnh nhân nội trú</h1>
            <p>
                Đăng nhập để truy cập các chức năng: quản lý khoa/phòng/giường,
                hồ sơ bệnh nhân, nhập viện – điều trị – xuất viện.
            </p>

            <div class="bullets">
                <div class="bullet">
                    <span class="dot"></span>
                    <div class="t">Phân quyền theo vai trò: Admin / Lễ tân / Bác sĩ / Y tá.</div>
                </div>
                <div class="bullet">
                    <span class="dot"></span>
                    <div class="t">Theo dõi trạng thái giường: trống / đang sử dụng theo thời gian thực.</div>
                </div>
                <div class="bullet">
                    <span class="dot"></span>
                    <div class="t">Quy trình nghiệp vụ rõ ràng: nhập viện → điều trị → xuất viện.</div>
                </div>
            </div>
        </section>

        <!-- Card đăng nhập -->
        <section class="card">
            <h2 class="title">Đăng nhập</h2>
            <p class="subtitle">Vui lòng đăng nhập bằng tài khoản được cấp để tiếp tục.</p>

            <?php if ($errMsg !== ''): ?>
            <div class="alert">
                <svg viewBox="0 0 24 24">
                    <path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20Zm1 13h-2v2h2v-2Zm0-10h-2v8h2V5Z" />
                </svg>
                <div><?= e($errMsg) ?></div>
            </div>
            <?php endif; ?>

            <form class="form" method="post" action="<?= e(base_url('index.php?c=auth&a=handle_login')) ?>"
                autocomplete="on">
                <div class="field">
                    <label for="username">Tên đăng nhập</label>
                    <input class="input" id="username" name="username" placeholder="Ví dụ: admin" required autofocus>
                </div>

                <div class="field">
                    <label for="password">Mật khẩu</label>
                    <input class="input" id="password" type="password" name="password" placeholder="Nhập mật khẩu"
                        required>
                </div>

                <div class="row">
                    <label class="check">
                        <input type="checkbox" name="remember" value="1" disabled>
                        Ghi nhớ đăng nhập (demo)
                    </label>
                    <span class="subtitle" style="font-size:12.5px;">Phiên làm việc nội bộ</span>
                </div>

                <button class="btn" type="submit">Đăng nhập</button>
            </form>

            <div class="footer">
                © <?= date('Y') ?> — Nội trú Hospital System • Chỉ sử dụng nội bộ
            </div>
        </section>

    </div>

</body>

</html>