<?php
header('Content-Type: application/json');
require_once('db.php');

$user_id = $_GET['user_id'] ?? '';

if (empty($user_id)) {
    echo json_encode([]);
    exit;
}

$sql = "SELECT id, fname, lname, address, date, status FROM application WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$user_id]);

$applications = [];
while ($row = $stmt->fetch()) {
    $applications[] = [
        'id' => $row['id'],
        'name' => $row['fname'] . ' ' . $row['lname'],
        'address' => $row['address'],
        'accountnumber' => '',
        'date' => $row['date'],
        'status' => $row['status']
    ];
}

echo json_encode($applications);
?>