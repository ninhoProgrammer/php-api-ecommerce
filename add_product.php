<?php
require_once 'middleware.php';
require_once 'db.php';
// Permitir peticiones desde tu frontend
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");

// Leer el cuerpo del JSON
$input = json_decode(file_get_contents("php://input"), true);

// Validar campos
if (!isset($input['name'], $input['price'], $input['image'])) {
    echo json_encode(['error' => 'Missing required fields']);
    http_response_code(422);
    exit;
}

$name = $input['name'];
$price = $input['price'];
$image = $input['image'];

try {
    $stmt = $pdo->prepare("INSERT INTO products (name, price, image) VALUES (?, ?, ?)");
    $stmt->execute([$name, $price, $image]);

    echo json_encode(['success' => true, 'message' => 'Product added']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}