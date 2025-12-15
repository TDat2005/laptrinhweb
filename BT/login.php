<?php
session_start();

if (isset($_POST['btnLogin'])) {
    $name = $_POST['username'];

    if (!empty($name)) {
        $_SESSION['user'] = $name;
        header("Location: welcome.php");
        exit();
    } else {
        $error = "Vui lòng nhập tên!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-box">
    <h2>Đăng nhập</h2>

    <form method="post">
        <input type="text" name="username" placeholder="Nhập tên...">
        <button type="submit" name="btnLogin">Đăng nhập</button>
    </form>

    <p class="error">
        <?php echo isset($error) ? $error : ""; ?>
    </p>
</div>

</body>
</html>
