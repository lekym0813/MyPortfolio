<?php
require_once 'db_config.php';

$user_id = $_GET['user_id'] ?? '';

if (empty($user_id)) {
    echo json_encode([]);
    exit();
}

$stmt = $conn->prepare("SELECT id, name, address, accountnumber, complaint, date, status, remarks, remarks_date FROM public.complaint WHERE user_id = ? ORDER BY date DESC");
$stmt->execute([$user_id]);

$complaints = [];
while ($row = $stmt->fetch()) {
    $complaints[] = [
        "id" => (string)$row['id'],
        "name" => $row['name'],
        "address" => $row['address'],
        "accountnumber" => $row['accountnumber'],
        "complaint" => $row['complaint'],
        "date" => $row['date'],
        "status" => $row['status'],
        "remarks" => $row['remarks'],
        "remarks_date" => $row['remarks_date']
    ];
}

echo json_encode($complaints);

$stmt = null;
$conn = null;
?>
