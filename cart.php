<?php
    include("db.php");
    header("Content-Type: application/json");

    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['items'])) {
        http_response_code(400);
        echo json_encode(["error" => "Missing items"]);
        exit;
    }

    foreach ($data['items'] as $item) {
        $productId = intval($item['product']['id']);
        $quantity = intval($item['quantity']);

        $stmt = $conn->prepare("INSERT INTO CART_ITEMS (product_id, quantity) VALUES (?, ?)");
        $stmt->bind_param("ii", $productId, $quantity);
        $stmt->execute();
    }

    echo json_encode(["status" => "ok"]);
?>
