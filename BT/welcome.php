<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="welcome-box">
    <h2>Xin chào, <?php echo $_SESSION['user']; ?>!</h2>

    <a class="logout-btn" href="logout.php">Đăng xuất</a>
</div>

</body>
</html>
