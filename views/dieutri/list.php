<h2>DANH SÁCH BỆNH NHÂN ĐANG ĐIỀU TRỊ</h2>

<form method="get">
    <input type="hidden" name="c" value="dieutri">
    <input type="hidden" name="a" value="list">

    Khoa:
    <select id="khoa" name="id_khoa">
        <option value="">-- Tất cả --</option>
        <?php foreach ($khoa as $k): ?>
        <option value="<?= $k['id'] ?>"
            <?= ($filter['id_khoa'] ?? '') == $k['id'] ? 'selected' : '' ?>>
            <?= e($k['ten_khoa']) ?>
        </option>
        <?php endforeach; ?>
    </select>

    Phòng:
    <select id="phong" name="id_phong">
        <option value="">-- Tất cả --</option>
    </select>

    <button>Lọc</button>
</form>

<br>

<table border="1" cellpadding="6">
<tr>
    <th>Tên bệnh nhân</th>
    <th>Khoa</th>
    <th>Phòng</th>
    <th>Giường</th>
    <th>Bác sĩ phụ trách</th>
    <th>Ngày nhập viện</th>
    <th>Hành động</th>
</tr>

<?php foreach ($data as $row): ?>
<tr>
    <td><?= e($row['ho_ten']) ?></td>
    <td><?= e($row['ten_khoa']) ?></td>
    <td><?= e($row['ten_phong']) ?></td>
    <td><?= e($row['ma_giuong']) ?></td>
    <td><?= e($row['bac_si'] ?? 'Chưa phân công') ?></td>
    <td><?= e($row['ngay_nhap']) ?></td>
    <td>
        <a href="index.php?c=dieutri&a=detail&id=<?= (int)$row['id'] ?>">Xem chi tiết</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

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
            phongSelect.innerHTML = `<option value="">-- Tất cả --</option>` +
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
