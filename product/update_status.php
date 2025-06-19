<?php
require_once '../config/db.php';

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'] ?? null;
$is_active = $data['is_active'] ?? null;

if (is_null($id) || is_null($is_active)) {
    echo json_encode(['success' => false, 'error' => 'Missing parameters']);
    exit;
}

$query = $pdo->prepare("UPDATE PRODUCTS SET IS_ACTIVE = :active WHERE ID = :id");
$success = $query->execute(['active' => $is_active, 'id' => $id]);

echo json_encode(['success' => $success]);
?>
