<?php require __DIR__ . "/../layout/AdminHeader.php"; ?>

<div class="page">

    <!-- HEADER -->
    <div class="page-head">
        <div>
            <div class="page-title">Danh sách bệnh nhân đang điều trị</div>
            <div class="page-sub">
                Thông tin bệnh nhân nội trú hiện tại theo khoa / phòng
            </div>
        </div>
    </div>

    <!-- PANEL FILTER -->
    <div class="panel">

        <form method="get" class="actions">
            <input type="hidden" name="c" value="dieutri">
            <input type="hidden" name="a" value="list">

            <div class="field">
                <label>Khoa</label>
                <select id="khoa" name="id_khoa" class="select">
                    <option value="">-- Tất cả --</option>
                    <?php foreach ($khoa as $k): ?>
                    <option value="<?= $k['id'] ?>" <?= ($filter['id_khoa'] ?? '') == $k['id'] ? 'selected' : '' ?>>
                        <?= e($k['ten_khoa']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="field">
                <label>Phòng</label>
                <select id="phong" name="id_phong" class="select">
                    <option value="">-- Tất cả --</option>
                </select>
            </div>

            <div style="align-self:flex-end;">
                <button class="btn">Lọc dữ liệu</button>
            </div>
        </form>

    </div>

    <!-- TABLE -->
    <div class="tbl-wrap" style="margin-top:14px;">
        <table class="tbl">
            <thead>
                <tr>
                    <th>Tên bệnh nhân</th>
                    <th>Khoa</th>
                    <th>Phòng</th>
                    <th>Giường</th>
                    <th>Bác sĩ phụ trách</th>
                    <th>Ngày nhập viện</th>
                    <th>Hành động</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($data as $row): ?>
                <tr>
                    <td><?= e($row['ho_ten']) ?></td>
                    <td><?= e($row['ten_khoa']) ?></td>
                    <td><?= e($row['ten_phong']) ?></td>
                    <td><?= e($row['ma_giuong']) ?></td>
                    <td>
                        <?= $row['bac_si']
              ? e($row['bac_si'])
              : '<span class="tag tag-off">Chưa phân công</span>' ?>
                    </td>
                    <td><?= e($row['ngay_nhap']) ?></td>
                    <td>
                        <a class="btn-outline" href="index.php?c=dieutri&a=detail&id=<?= (int)$row['id'] ?>">
                            Chi tiết
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<!-- JS lọc phòng theo khoa (GIỮ NGUYÊN LOGIC) -->
<script>
const phongSelect = document.getElementById('phong');
const khoaSelect = document.getElementById('khoa');
const selectedPhong = "<?= $filter['id_phong'] ?? '' ?>";

khoaSelect.onchange = () => {
    if (!khoaSelect.value) {
        phongSelect.innerHTML = `<option value="">-- Tất cả --</option>`;
        return;
    }

    fetch(`index.php?c=dieutri&a=phong&id_khoa=${khoaSelect.value}`)
        .then(r => r.json())
        .then(data => {
            phongSelect.innerHTML =
                `<option value="">-- Tất cả --</option>` +
                data.map(p =>
                    `<option value="${p.id}" ${p.id == selectedPhong ? 'selected' : ''}>
             ${p.ten_phong}
           </option>`
                ).join('');
        });
};

if (khoaSelect.value) {
    khoaSelect.onchange();
}
</script>