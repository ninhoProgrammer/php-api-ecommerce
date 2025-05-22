<?php
// Allow CORS and set JSON header
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Include DB connection
include("db.php");

// Fetch products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

// Check for errors
if (!$result) {
  http_response_code(500);
  echo json_encode(["error" => "Query failed: " . $conn->error]);
  exit;
}

// Store products in array
$products = [];

while ($row = $result->fetch_assoc()) {
  $products[] = [
    "id" => (int)$row["id"],
    "name" => $row["name"],
    "price" => (float)$row["price"],
    "image_url" => $row["image_url"]
  ];
}

// Output as JSON
echo json_encode($products);
?>