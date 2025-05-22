<?php
include("db.php");
header("Content-Type: application/json");

$sql = "SELECT c.ID, p.NAME, c.QUANTITY, c.CREATED_AT
        FROM CART_ITEMS c
        JOIN products p ON c.PRODUCT_ID = p.ID
        ORDER BY c.CREATED_AT DESC";

$result = $conn->query($sql);

$compras = [];
while ($row = $result->fetch_assoc()) {
  $compras[] = $row;
}

echo json_encode($compras);
?>