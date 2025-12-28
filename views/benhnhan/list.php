<?php require __DIR__ . "/../layout/AdminHeader.php"; ?>


<div class="page">

    <!-- TIÊU ĐỀ -->
    <div class="page-head">
        <div>
            <div class="page-title">Danh sách bệnh nhân</div>
            <div class="page-sub">Quản lý hồ sơ bệnh nhân</div>
        </div>
    </div>

    <div class="panel">

        <!-- KHỐI CÔNG CỤ -->
        <div class="page-head">

            <!-- BÊN TRÁI -->
            <div class="actions" style="flex-direction:column;align-items:flex-start">
                <!-- THÊM BỆNH NHÂN -->
                <a href="index.php?c=benhnhan&a=add" class="btn">
                    + Thêm bệnh nhân
                </a>

                <!-- TÌM KIẾM -->
                <form method="get" class="actions">
                    <input type="hidden" name="c" value="benhnhan">
                    <input type="hidden" name="a" value="list">
                    <input class="input" name="q" placeholder="Tìm mã BN / họ tên" value="<?= e($keyword) ?>">
                    <button class="btn-outline">Tìm</button>
                </form>
            </div>

            <!-- BÊN PHẢI -->
            <div class="actions" style="flex-direction:column;align-items:flex-end">

                <!-- XUẤT EXCEL -->
                <a href="index.php?c=benhnhan&a=exportexcel" class="btn-outline">
                    📤 Xuất Excel
                </a>

                <!-- NHẬP EXCEL -->
                <form action="index.php?c=benhnhan&a=importexcel" method="post" enctype="multipart/form-data"
                    class="actions">
                    <input type="file" name="excel" required>
                    <button type="submit" class="btn-outline">
                        📥 Nhập Excel
                    </button>
                </form>

            </div>
        </div>

        <!-- BẢNG DANH SÁCH -->
        <div class="tbl-wrap">
            <table class="tbl">
                <thead>
                    <tr>
                        <th>Mã BN</th>
                        <th>Họ tên</th>
                        <th>Ngày sinh</th>
                        <th>Giới tính</th>
                        <th>CMND</th>
                        <th>BHYT</th>
                        <th>Địa chỉ</th>
                        <th>SĐT người thân</th>
                        <th width="120">Thao tác</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($data as $bn): ?>
                    <tr>
                        <td><?= e($bn['ma_bn']) ?></td>
                        <td><?= e($bn['ho_ten']) ?></td>
                        <td><?= e($bn['ngay_sinh']) ?></td>
                        <td><?= e($bn['gioi_tinh']) ?></td>
                        <td><?= e($bn['so_cmnd']) ?></td>
                        <td><?= e($bn['so_bhyt']) ?></td>
                        <td><?= e($bn['dia_chi']) ?></td>
                        <td><?= e($bn['sdt_nguoi_than']) ?></td>
                        <td class="actions">
                            <a class="btn-outline" href="index.php?c=benhnhan&a=edit&id=<?= $bn['id'] ?>">
                                Sửa
                            </a>
                            <a class="btn-danger" href="index.php?c=benhnhan&a=delete&id=<?= $bn['id'] ?>"
                                onclick="return confirm('Xóa bệnh nhân?')">
                                Xóa
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>