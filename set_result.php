<?php
include "db.php";

if ($_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit();
}

$rounds = $conn->query("SELECT * FROM rounds WHERE result IS NULL");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $round_id = $_POST["round_id"];
    $result = $_POST["result"];
    $conn->query("UPDATE rounds SET result = '$result' WHERE id = $round_id");
    echo "<script>alert('Đã đặt kết quả!');</script>";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đặt kết quả kỳ quay</title>
</head>
<body>
    <h2>Đặt kết quả kỳ quay</h2>
    <form method="POST">
        <label>Kỳ quay:</label>
        <select name="round_id">
            <?php while ($round = $rounds->fetch_assoc()) { ?>
                <option value="<?= $round["id"] ?>">Kỳ #<?= $round["id"] ?></option>
            <?php } ?>
        </select>

        <label>Kết quả:</label>
        <select name="result">
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
        </select>

        <button type="submit">Xác nhận</button>
    </form>
</body>
</html>
