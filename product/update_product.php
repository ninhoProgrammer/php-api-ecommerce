<?php
require_once(__DIR__ . '/../config/middleware.php');
require_once(__DIR__ . '/../config/db.php');


$input = json_decode(file_get_contents('php://input'), true);
$id = $_GET['id'] ?? null;

if (
    !$id ||
    !isset($input['name'], $input['price'], $input['image'], $input['description'], $input['category_id'])
) {
    send_json_error("Missing product ID or data", 422);
}

$stmt = $pdo->prepare("UPDATE products SET name = ?, price = ?, image = ?, description = ?, category_id = ? WHERE id = ?");
$stmt->execute([
    $input['name'],
    $input['price'],
    $input['image'],
    $input['description'],
    $input['category_id'],
    $id
]);

send_json_success(["message" => "Product updated"]);
