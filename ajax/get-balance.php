<?php

session_start();

require_once "../classes/Database.php";

if (!isset($_SESSION["user_id"])) {
    http_response_code(401);
    exit;
}

$database = new Database();
$conn = $database->connect();

$statement = $conn->prepare(
    "SELECT balance
     FROM users
     WHERE id = :user_id"
);

$statement->execute([
    "user_id" => $_SESSION["user_id"]
]);

$user = $statement->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    http_response_code(404);
    exit;
}

header("Content-Type: application/json");

echo json_encode([
    "balance" => $user["balance"]
]);