## 📦 PHP Product API with Vue Frontend (XAMPP)
This is a simple e-commerce backend using:

🐘 PHP + MySQL (XAMPP)

⚙️ REST API

🛍️ Frontend in Vue (with Astro)

📬 Communication using fetch or Postman

## 📁 Project Structure
bash

/php-api-ecommerce
  ├── db.php
  ├── add_product.php
  ├── get_products.php
  ├── cart.php
/frontend
  ├── components/
  │   └── AddProduct.vue
  ├── pages/
      └── admin.astro

## 🧰 Requirements
XAMPP

Astro with Vue integration

Apache & MySQL running

## 🛠️ Setup Instructions

1. Create the Database
Go to phpMyAdmin or use the terminal and run:

sql

CREATE DATABASE ecommerce_db;

USE ecommerce_db;

CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  image_url VARCHAR(255) NOT NULL
);

2. db.php Connection File
php

<?php
$conn = new mysqli("localhost", "root", "", "ecommerce_db");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>

Place this in /php-api-ecommerce/db.php.

## 🚀 Add Product Endpoint

🔗 URL

nginx

POST http://localhost/php-api-ecommerce/add_product.php

## 🧪 Use with Postman

Set method to POST

Enter the URL above

Go to Body → raw → JSON and paste:

json

{
  "name": "Sample Product",
  "price": 12.99,
  "image_url": "/images/sample.jpg"
}
✅ Sample Response

json

{
  "status": "Product added",
  "id": 5
}

## 🌐 Use with Fetch (Frontend)

js

fetch('http://localhost/php-api-ecommerce/add_product.php', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json'
  },
  body: JSON.stringify({
    name: 'Product ABC',
    price: 19.99,
    image_url: '/images/abc.jpg'
  })
})
  .then(res => res.json())
  .then(data => console.log('Success:', data))
  .catch(err => console.error('Error:', err))

## 📄 Get Products Endpoint
Create get_products.php:

php
<?php
include("db.php");
header("Content-Type: application/json");

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

$products = [];
while ($row = $result->fetch_assoc()) {
  $products[] = $row;
}

echo json_encode($products);
?>

Call this with:

nginx

GET http://localhost/php-api-ecommerce/get_products.php

## 🛒 Submit Cart Data

cart.php (you can extend this):

json

{
  "items": [
    { "product": { "id": 1, "name": "Product 1", "price": 10.99 }, "quantity": 2 }
  ]
}
Use POST to send the full cart.

## 🧪 Admin Panel (Vue)

Use the AddProduct.vue component to visually submit new products:

vue

<AddProduct client:load />
Place it in a page like admin.astro.

##🟢 How to Run
Start XAMPP and enable Apache + MySQL

Put /php-api-ecommerce inside C:/xampp/htdocs/

Start Astro frontend:

bash
Copiar
Editar
npm run dev
Access:

Backend via Postman or fetch

Frontend at http://localhost:4321/admin

## Licence
This project is licensed under the terms of the MIT License. See the [MIT License](LICENSE)

