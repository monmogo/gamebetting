<?php
include "db.php";

$sql = "SELECT r.id, g.name AS game_name, r.result, r.created_at 
        FROM rounds r 
        JOIN games g ON r.game_id = g.id
        WHERE r.result IS NOT NULL
        ORDER BY r.created_at DESC";

$result = $conn->query($sql);
$history = [];

while ($row = $result->fetch_assoc()) {
    $history[] = $row;
}

echo json_encode($history);
?>
