<?php
require_once(__DIR__ . '/../config/middleware.php');
require_once(__DIR__ . '/../config/db.php');

$id = $_GET['id'] ?? null;
if (!$id) send_json_error("Missing category ID", 422);

$stmt = $pdo->prepare("DELETE FROM categories WHERE id = ?");
$stmt->execute([$id]);

send_json_success(["message" => "Category deleted"]);