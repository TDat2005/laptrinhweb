<?php
include "connect.php";

$matg = $_GET['matg'] ?? '';

if (empty($matg)) {
    die("Không có mã tác giả để xóa!");
}

// Kiểm tra xem tác giả có tồn tại không
$check = mysqli_query($conn, "SELECT * FROM tacgia WHERE matacgia = '$matg'");

if (mysqli_num_rows($check) == 0) {
    die("Tác giả không tồn tại!");
}

// Tiến hành xóa
$sql = "DELETE FROM tacgia WHERE matacgia = '$matg'";

if (mysqli_query($conn, $sql)) {
    header("Location: find_tacgia.php?msg=deleted");
    exit();
} else {
    echo "Lỗi khi xóa!";
}
?>
