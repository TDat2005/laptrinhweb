<?php /** @var array $users */ /** @var string $msg */ /** @var string $q */
require __DIR__ . "/../layout/AdminHeader.php";
?>

<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý tài khoản</title>
    <link rel="stylesheet" href="<?= e(base_url('public/css/admin.css')) ?>">
</head>

<body>

    <div class="page">
        <div class="page-head">
            <div>
                <div class="page-title">Quản lý tài khoản người dùng</div>
                <div class="page-sub">Danh sách user, phân quyền và trạng thái</div>
            </div>

            <div class="actions" style="display:flex; gap:10px; flex-wrap:wrap; align-items:center;">
                <form method="get" action="<?= e(base_url('index.php')) ?>"
                    style="display:flex; gap:10px; align-items:center;">
                    <input type="hidden" name="c" value="user">
                    <input type="hidden" name="a" value="list">

                    <input class="input" name="q" value="<?= e($q ?? '') ?>"
                        placeholder="Tìm username / họ tên / role / id / active / locked..." style="width:320px;">

                    <button class="btn btn-outline" type="submit">Tìm</button>

                    <?php if(!empty($q)): ?>
                    <a class="btn btn-outline" href="<?= e(base_url('index.php?c=user&a=list')) ?>">X</a>
                    <?php endif; ?>
                </form>

                <a class="btn" href="<?= e(base_url('index.php?c=user&a=add')) ?>">+ Thêm tài khoản</a>
                <a class="btn btn-outline" href="<?= e(base_url('index.php')) ?>">Về dashboard</a>
            </div>


        </div>

        <?php if (!empty($msg)): ?>
        <div class="alert">
            <?php
        if ($msg==='created') echo "✅ Tạo tài khoản thành công.";
        elseif ($msg==='updated') echo "✅ Cập nhật tài khoản thành công.";
        elseif ($msg==='status') echo "✅ Đã đổi trạng thái tài khoản.";
        elseif ($msg==='reset') echo "✅ Đã reset mật khẩu.";
        else echo "✅ Thao tác thành công.";
      ?>
        </div>
        <?php endif; ?>

        <div class="tbl-wrap">
            <table class="tbl">
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
                            <span class="tag tag-on">Active</span>
                            <?php else: ?>
                            <span class="tag tag-off">Locked</span>
                            <?php endif; ?>
                        </td>
                        <td><?= e($u['created_at'] ?? '') ?></td>
                        <td>
                            <div class="actions">
                                <a class="btn btn-outline"
                                    href="<?= e(base_url('index.php?c=user&a=edit&id='.(int)$u['id'])) ?>">Sửa</a>
                                <a class="btn btn-outline"
                                    href="<?= e(base_url('index.php?c=user&a=reset_password&id='.(int)$u['id'])) ?>">Đổi
                                    MK</a>
                                <a class="btn btn-danger"
                                    href="<?= e(base_url('index.php?c=user&a=toggle_status&id='.(int)$u['id'])) ?>"
                                    onclick="return confirm('Đổi trạng thái tài khoản này?')">
                                    Khóa/Mở
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
<?php require __DIR__ . "/../layout/AdminFooter.php"; ?>