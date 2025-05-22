<?php
include("db.php");
header("Content-Type: application/json");

// Obtener datos del JSON recibido
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['name'], $data['price'], $data['image_url'])) {
  http_response_code(400);
  echo json_encode(["error" => "Missing required fields"]);
  exit;
}

$name = $conn->real_escape_string($data['name']);
$price = floatval($data['price']);
$imageUrl = $conn->real_escape_string($data['image_url']);

// Insertar en la tabla
$sql = "INSERT INTO PRODUCTS (NAME, PRICE, IMAGE_URL) VALUES ('$name', $price, '$imageUrl')";

if ($conn->query($sql) === TRUE) {
  echo json_encode(["status" => "Product added", "id" => $conn->insert_id]);
} else {
  http_response_code(500);
  echo json_encode(["error" => $conn->error]);
}
?>