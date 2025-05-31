<?php
require_once(__DIR__ . '/../config/middleware.php');
require_once(__DIR__ . '/../config/db.php');


$input = json_decode(file_get_contents('php://input'), true);
$id = $_GET['id'] ?? null;

if (
    !$id ||
    !isset($input['name'], $input['description'])
) {
    send_json_error("Missing category ID or data", 422);
}

$stmt = $pdo->prepare("UPDATE categories SET name = ?, description = ? WHERE id = ?");
$stmt->execute([
    $input['name'],
    $input['description'],
    $id
]);

send_json_success(["message" => "Category updated"]);