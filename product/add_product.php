<?php
require_once(__DIR__ . '/../config/middleware.php');
require_once(__DIR__ . '/../config/db.php');

// Permitir peticiones desde tu frontend
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");

// Leer el cuerpo del JSON
$input = json_decode(file_get_contents("php://input"), true);

// Validar campos
if (!isset($input['name'], $input['description'], $input['price'], $input['stock'], $input['image'], $input['category_id'])) {
    echo json_encode(['error' => 'Missing required fields']);
    http_response_code(422);
    exit;
}

$name = $input['name'];
$description = $input['description'];
$price = $input['price'];
$stock = $input['stock'] ?? 0; // Default stock to 0 if not provided
$image = $input['image'];
$category_id = $input['category_id'];

try {
    $stmt = $pdo->prepare("INSERT INTO PRODUCTS (name, description, price, stock, image, category_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $description, $price, $stock, $image, $category_id]);

    echo json_encode(['success' => true, 'message' => 'Product added']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}