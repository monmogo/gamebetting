<?php
include "db.php";

if ($_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit();
}

$rounds = $conn->query("SELECT * FROM rounds");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn->query("INSERT INTO rounds (game_id) VALUES (1)");
    echo "<script>alert('Tạo kỳ quay mới thành công!'); window.location.reload();</script>";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý kỳ quay</title>
</head>
<body>
    <h2>Quản lý kỳ quay</h2>
    <form method="POST">
        <button type="submit">Tạo kỳ quay mới</button>
    </form>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Kết quả</th>
            <th>Thời gian</th>
        </tr>
        <?php while ($round = $rounds->fetch_assoc()) { ?>
        <tr>
            <td><?= $round["id"] ?></td>
            <td><?= $round["result"] ?? "Chưa có" ?></td>
            <td><?= $round["created_at"] ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
