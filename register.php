<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $password = md5($_POST["password"]);

    $conn->query("INSERT INTO users (name, password) VALUES ('$name', '$password')");
    echo "<script>alert('Đăng ký thành công!'); window.location='login.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký</title>
</head>
<body>
    <h2>Đăng ký tài khoản</h2>
    <form method="POST">
        <label>Tên đăng nhập:</label>
        <input type="text" name="name" required>
        <label>Mật khẩu:</label>
        <input type="password" name="password" required>
        <button type="submit">Đăng ký</button>
    </form>
</body>
</html>
