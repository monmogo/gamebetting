<?php
include "db.php";

if ($_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit();
}

$users = $conn->query("SELECT * FROM users WHERE role='player'");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["user_id"];
    $new_points = $_POST["points"];
    $conn->query("UPDATE users SET points = $new_points WHERE id = $user_id");
    echo "<script>alert('Cập nhật thành công!'); window.location.reload();</script>";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý người chơi</title>
</head>
<body>
    <h2>Quản lý người chơi</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Điểm cược</th>
            <th>Cập nhật</th>
        </tr>
        <?php while ($user = $users->fetch_assoc()) { ?>
        <tr>
            <td><?= $user["id"] ?></td>
            <td><?= $user["name"] ?></td>
            <td>
                <form method="POST">
                    <input type="hidden" name="user_id" value="<?= $user["id"] ?>">
                    <input type="number" name="points" value="<?= $user["points"] ?>">
                    <button type="submit">Cập nhật</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
