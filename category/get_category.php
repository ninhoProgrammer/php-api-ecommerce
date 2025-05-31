<?php
require_once(__DIR__ . '/../config/middleware.php');
require_once(__DIR__ . '/../config/db.php');

$id = $_GET['id'] ?? null;
if (!$id) send_json_error("Missing product ID", 400);

$stmt = $pdo->prepare("SELECT * FROM categories WHERE ID = ?");
$stmt->execute([$id]);
$category = $stmt->fetch();

if (!$category) send_json_error("Category not found", 404);

send_json_success($category);