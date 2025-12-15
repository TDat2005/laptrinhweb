<?php
include "connect.php";
?>

<style>
.search-box {
    background: #f9f9f9;
    padding: 15px;
    width: 650px;
    margin: 20px auto;
    border-radius: 10px;
    box-shadow: 0px 0px 8px #ccc;
}

.search-box h3 {
    margin: 0 0 12px 0;
    text-align: center;
}

.search-row {
    display: flex;
    gap: 20px;
}

.search-col {
    flex: 1;
}

.search-col input {
    width: 100%;
    padding: 10px;
    border: 1px solid #aaa;
    border-radius: 6px;
}

.search-btn {
    width: 100%;
    margin-top: 15px;
    padding: 10px;
    background: #007bff;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
}

.search-btn:hover {
    background: #0066d4;
}

.action-btn a {
    padding: 6px 10px;
    border-radius: 6px;
    text-decoration: none;
    color: white;
}

.btn-edit { background: #28a745; }
.btn-edit:hover { background: #1e7e34; }

.btn-del { background: #dc3545; }
.btn-del:hover { background: #b52a37; }
</style>

<div class="search-box">
    <h3>Tìm kiếm tác giả</h3>

    <form method="GET">
        <div class="search-row">
            <div class="search-col">
                <label>Mã tác giả</label>
                <input type="text" name="search_matg" placeholder="Nhập mã..." value="<?= $_GET['search_matg'] ?? '' ?>">
            </div>

            <div class="search-col">
                <label>Tên tác giả</label>
                <input type="text" name="search_tentg" placeholder="Nhập tên..." value="<?= $_GET['search_tentg'] ?? '' ?>">
            </div>
        </div>

        <button type="submit" class="search-btn">Tìm kiếm</button>
    </form>
</div>

<?php
$search_matg = $_GET["search_matg"] ?? '';
$search_tentg = $_GET["search_tentg"] ?? '';

$sql = "SELECT * FROM tacgia WHERE 1";

if (!empty($search_matg)) {
    $sql .= " AND matacgia LIKE '%$search_matg%'";
}

if (!empty($search_tentg)) {
    $sql .= " AND tentacgia LIKE '%$search_tentg%'";
}

$result = mysqli_query($conn, $sql);
?>

<?php
if (isset($_GET["msg"]) && $_GET["msg"] == "updated") {
    echo "<p style='color:green; text-align:center;'>Đã cập nhật thông tin tác giả!</p>";
}
?>

<table border="1" cellpadding="8" cellspacing="0" 
       style="border-collapse: collapse; width: 100%; margin-top: 20px;">
    <tr style="background: #ffe8b5;">
        <th>Mã tác giả</th>
        <th>Tên tác giả</th>
        <th>Ngày sinh</th>
        <th>Giới tính</th>
        <th>Điện thoại</th>
        <th>Email</th>
        <th>Địa chỉ</th>
        <th>Hành động</th>
    </tr>

    <?php
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['matacgia']}</td>
                    <td>{$row['tentacgia']}</td>
                    <td>{$row['ngaysinh']}</td>
                    <td>{$row['gioitinh']}</td>
                    <td>{$row['dienthoai']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['diachi']}</td>

                    <td class='action-btn'>
                        <a class='btn-edit' href='edit_tacgia.php?matg={$row['matacgia']}'>Sửa</a>
                        <a class='btn-del' href='delete_tacgia.php?matg={$row['matacgia']}' 
                           onclick='return confirm(\"Bạn có chắc muốn xóa?\")'>Xóa</a>
                    </td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='8' style='color:red; text-align:center;'>Không tìm thấy dữ liệu</td></tr>";
    }
    ?>
</table>
<a href="export_tacgia.php">
    <button style="padding:10px; background:green; color:white; border:none; border-radius:5px; cursor:pointer;">
        Xuất Excel
    </button>
</a>
