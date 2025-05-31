<?php
require_once(__DIR__ . '/../config/middleware.php');
require_once(__DIR__ . '/../config/db.php');

$stmt = $pdo->query("SELECT * FROM categories ORDER BY id DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

send_json_success($products);
