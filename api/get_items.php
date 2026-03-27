<?php
session_start();
include '../config.php';
header('Content-Type: application/json');

// Ha nincs belépve, ne adjunk adatot
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "Nincs bejelentkezve"]);
    exit();
}

try {
    // Itt a tábla neve 'items' kell legyen (amit az SQL-ben létrehoztál)
    $stmt = $conn->query("SELECT * FROM items");
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($items);
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}