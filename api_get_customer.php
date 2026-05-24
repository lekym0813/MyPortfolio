<?php
header('Content-Type: application/json');
include('db.php');

$account = $_GET['account'] ?? '';
if (empty($account)) {
  echo json_encode(['error' => 'No account specified']);
  exit();
}

$stmt = $conn->prepare("SELECT * FROM customer WHERE cust_account = ? ORDER BY cust_id DESC LIMIT 1");
$stmt->execute([$account]);

if ($row = $stmt->fetch()) {
  echo json_encode([
    'cust_name' => $row['cust_name'],
    'cust_address' => $row['cust_address'],
    'PrReading' => $row['CReading'],
    'found' => true
  ]);
} else {
  echo json_encode(['found' => false]);
}
?>