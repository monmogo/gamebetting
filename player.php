<?php
include "db.php";

if ($_SESSION["role"] !== "player") {
    header("Location: admin.php");
    exit();
}

$latest_round = $conn->query("SELECT * FROM rounds WHERE result IS NULL ORDER BY created_at DESC LIMIT 1")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION["user_id"];
    $round_id = $_POST["round_id"];
    $choice = $_POST["choice"];
    $bet_amount = $_POST["bet_amount"];

    $conn->query("INSERT INTO bets (user_id, round_id, choice, bet_amount) VALUES ($user_id, $round_id, '$choice', $bet_amount)");
    echo "<script>alert('Đặt cược thành công!');</script>";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Người chơi</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <h2>Chào, <?= $_SESSION["user_name"] ?></h2>
    <a href="logout.php">Đăng xuất</a>

    <h3>Đặt cược</h3>
    <form method="POST">
        <input type="hidden" name="round_id" value="<?= $latest_round['id'] ?? '' ?>">
        <label>Chọn đáp án:</label>
        <select name="choice">
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
        </select>
        
        <label>Điểm cược:</label>
        <input type="number" name="bet_amount" required>
        
        <button type="submit">Đặt cược</button>
    </form>
</body>
</html>
