<?php
session_start();
header('Content-Type: application/json');
include '../config.php';

$response = ["success" => false, "message" => "Ismeretlen hiba"];

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "Nincs bejelentkezve!"]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fontos: a JS 'id' néven küldi az adatot!
    $id = $_POST['id'] ?? null;

    if ($id) {
        try {
            $stmt = $conn->prepare("DELETE FROM items WHERE id = ?");
            $stmt->execute([$id]);
            $response = ["success" => true, "message" => "Sikeres törlés"];
        } catch (Exception $e) {
            $response = ["success" => false, "message" => "Adatbázis hiba: " . $e->getMessage()];
        }
    } else {
        $response = ["success" => false, "message" => "Hiányzó azonosító!"];
    }
}

echo json_encode($response);
exit();