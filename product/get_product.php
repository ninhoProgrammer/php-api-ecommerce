<?php
require_once(__DIR__ . '/../config/middleware.php');
require_once(__DIR__ . '/../config/db.php');

$id = $_GET['id'] ?? null;
if (!$id) send_json_error("Missing product ID", 400);

$stmt = $pdo->prepare("SELECT * FROM products WHERE ID = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) send_json_error("Product not found", 404);

send_json_success($product);
