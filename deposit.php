<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION["user_id"];
    $amount = $_POST["amount"];

    $conn->query("INSERT INTO deposits (user_id, amount) VALUES ($user_id, $amount)");
    $conn->query("UPDATE users SET points = points + $amount WHERE id = $user_id");

    echo "<script>alert('Nạp điểm thành công!');</script>";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Nạp điểm</title>
</head>
<body>
    <h2>Nạp điểm cược</h2>
    <form method="POST">
        <label>Số điểm:</label>
        <input type="number" name="amount" required>
        <button type="submit">Nạp điểm</button>
    </form>
</body>
</html>
