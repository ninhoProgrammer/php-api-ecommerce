<?php
require_once 'middleware.php';
require_once 'db.php';

$stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

send_json_success($products);
