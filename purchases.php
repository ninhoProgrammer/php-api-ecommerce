<?php
include("db.php");
header("Content-Type: application/json");

$sql = "SELECT c.id, p.name, c.quantity, c.created_at
        FROM cart_items c
        JOIN products p ON c.product_id = p.id
        ORDER BY c.created_at DESC";

$result = $conn->query($sql);

$purchases = [];
while ($row = $result->fetch_assoc()) {
  $purchases[] = $row;
}

echo json_encode($purchases);
?>