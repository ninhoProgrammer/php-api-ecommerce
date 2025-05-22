<?php
    require_once __DIR__ . '/vendor/autoload.php';
    use Dotenv\Dotenv;

    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $host = $_ENV['DB_HOST'];
    $db = $_ENV['DB_NAME'];
    $user = $_ENV['DB_USER'];
    $pass = $_ENV['DB_PASS'];

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
?>

