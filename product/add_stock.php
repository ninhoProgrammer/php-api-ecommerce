<?php
require_once '../config/db.php';

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'] ?? null;
$quantity = $data['quantity'] ?? 0;

if (!$id || !$quantity) {
    echo json_encode(['success' => false, 'error' => 'Missing data']);
    exit;
}

$query = $pdo->prepare("UPDATE PRODUCTS SET STOCK = STOCK + :qty WHERE ID = :id");
$success = $query->execute(['qty' => $quantity, 'id' => $id]);

echo json_encode(['success' => $success]);
?>