<?php
include "db.php";

if ($_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit();
}

// Đếm tổng số người chơi
$total_users = $conn->query("SELECT COUNT(*) AS count FROM users WHERE role='player'")->fetch_assoc()["count"];

// Đếm tổng số kỳ quay
$total_rounds = $conn->query("SELECT COUNT(*) AS count FROM rounds")->fetch_assoc()["count"];

// Tổng cược của người chơi
$total_bets = $conn->query("SELECT SUM(bet_amount) AS total FROM bets")->fetch_assoc()["total"];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản trị Admin</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <h2>🎛 Trang quản trị Admin</h2>
    <a href="logout.php">Đăng xuất</a>

    <div class="admin-container">
        <div class="admin-box">
            <h3>Tổng số người chơi</h3>
            <p><?= $total_users ?></p>
        </div>
        <div class="admin-box">
            <h3>Tổng số kỳ quay</h3>
            <p><?= $total_rounds ?></p>
        </div>
        <div class="admin-box">
            <h3>Tổng số điểm cược</h3>
            <p><?= number_format($total_bets, 2) ?></p>
        </div>
    </div>

    <div class="admin-links">
        <a href="manage_users.php">Quản lý người chơi</a>
        <a href="manage_rounds.php">Quản lý kỳ quay</a>
        <a href="history.php">Lịch sử cược</a>
    </div>
</body>
</html>
