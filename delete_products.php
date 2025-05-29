<?php
require_once 'middleware.php';
require_once 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) send_json_error("Missing product ID", 422);

$stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
$stmt->execute([$id]);

send_json_success(["message" => "Product deleted"]);
