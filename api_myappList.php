<?php
require_once 'db_config.php';

$user_id = $_GET['user_id'] ?? '';

if (empty($user_id)) {
    echo json_encode([]);
    exit();
}

$stmt = $conn->prepare("SELECT id, fname, lname, address, contact, occupation, bday, class, conntype, date, status FROM public.application WHERE user_id = ? ORDER BY date DESC");
$stmt->execute([$user_id]);

$apps = [];
while ($row = $stmt->fetch()) {
    $apps[] = [
        "id" => (string)$row['id'],
        "name" => $row['fname'] . ($row['lname'] ? ' ' . $row['lname'] : ''),
        "address" => $row['address'],
        "contact" => $row['contact'] ?? '',
        "occupation" => $row['occupation'] ?? '',
        "bday" => $row['bday'] ?? '',
        "classification" => $row['class'] ?? '',
        "connection" => $row['conntype'] ?? '',
        "accountnumber" => '',
        "date" => $row['date'],
        "status" => $row['status']
    ];
}

echo json_encode($apps);

$stmt = null;
$conn = null;
?>