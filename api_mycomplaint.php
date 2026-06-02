<?php
header('Content-Type: application/json');
require_once('db.php');

$user_id = $_GET['user_id'] ?? '';

if (empty($user_id)) {
    echo json_encode([]);
    exit;
}

$sql = "SELECT id, name, address, accountnumber, contact, complaint, date, status, remarks, remarks_date FROM complaint WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$user_id]);

$complaints = [];
while ($row = $stmt->fetch()) {
    $complaints[] = [
        'id' => $row['id'],
        'name' => $row['name'],
        'address' => $row['address'],
        'accountnumber' => $row['accountnumber'],
        'complaint' => $row['complaint'],
        'date' => $row['date'],
        'status' => $row['status'],
        'contact' => $row['contact'] ?? '',
        'remarks' => $row['remarks'] ?? '',
        'remarks_date' => $row['remarks_date'] ?? ''
    ];
}

echo json_encode($complaints);
?>