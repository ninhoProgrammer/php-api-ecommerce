<?php
require_once(__DIR__ . '/../config/middleware.php');
require_once(__DIR__ . '/../config/db.php');
// Permitir peticiones desde tu frontend
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");


$input = json_decode(file_get_contents("php://input"), true);

// Validar campos
if (!isset($input['name'], $input['description'])) {
    echo json_encode(['error' => 'Missing required fields']);
    http_response_code(422);
    exit;
}

$name = $input['name'];
$description = $input['description'];
$category_id = $input['category_id'];

try {
    $stmt = $pdo->prepare("INSERT INTO CATEGORY (name, description) VALUES (?, ?)");
    $stmt->execute([$name, $description]);

    echo json_encode(['success' => true, 'message' => 'Category added']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}