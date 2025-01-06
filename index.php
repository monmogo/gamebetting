<?php
include "db.php";

// Lấy danh sách kỳ quay mới nhất
$rounds = $conn->query("SELECT * FROM rounds WHERE result IS NULL ORDER BY created_at DESC LIMIT 1");
$latest_round = $rounds->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống đặt cược</title>
    <link rel="stylesheet" href="assets/styles.css">
    <script src="assets/scripts.js" defer></script>
</head>
<body>
    <h1>Trò chơi đặt cược</h1>

    <div id="betting-section">
        <h2>Kỳ quay hiện tại: #<?php echo $latest_round['id'] ?? "Chưa có"; ?></h2>
        <p>Hãy chọn một đáp án để đặt cược:</p>
        
        <form id="bet-form">
            <input type="hidden" id="round_id" value="<?php echo $latest_round['id'] ?? ""; ?>">
            <label>Người chơi ID:</label>
            <input type="number" id="user_id" required>
            
            <label>Chọn đáp án:</label>
            <select id="choice">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>

            <label>Điểm cược:</label>
            <input type="number" id="bet_amount" required>
            
            <button type="submit">Đặt cược</button>
        </form>
    </div>

    <div id="result-section">
        <h2>Kết quả kỳ quay</h2>
        <button onclick="fetchResults()">Xem kết quả</button>
        <div id="results"></div>
    </div>

</body>
</html>
