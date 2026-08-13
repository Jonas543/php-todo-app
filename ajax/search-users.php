<?php

session_start();

require_once "../classes/Database.php";

if (!isset($_SESSION["user_id"])) {
    exit;
}

$search = trim($_GET["search"] ?? "");

if (strlen($search) < 2) {
    echo json_encode([]);
    exit;
}

$database = new Database();
$conn = $database->connect();

$statement = $conn->prepare(
    "SELECT id, username
     FROM users
     WHERE username LIKE :search
     AND id != :user_id
     ORDER BY username ASC
     LIMIT 10"
);

$statement->execute([
    "search" => $search . "%",
    "user_id" => $_SESSION["user_id"]
]);

$users = $statement->fetchAll(PDO::FETCH_ASSOC);

header("Content-Type: application/json");

echo json_encode($users);