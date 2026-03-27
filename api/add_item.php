<?php
session_start();
header('Content-Type: application/json');

// 1. Hibák elkapása, hogy ne rontsák el a JSON-t
try {
    // 2. Kapcsolódás
    if (!file_exists('../config.php')) {
        throw new Exception("A config.php nem található!");
    }
    include '../config.php';

    // 3. Adatok begyűjtése
    $name = $_POST['name'] ?? '';
    $cat  = $_POST['category'] ?? '';
    $qty  = $_POST['quantity'] ?? 0;

    if (empty($name)) {
        throw new Exception("Az eszköz neve nem lehet üres!");
    }

    // 4. Mentés az adatbázisba (Ellenőrizd: 'items' a tábla neve?)
    $stmt = $conn->prepare("INSERT INTO items (name, category, quantity) VALUES (?, ?, ?)");
    $success = $stmt->execute([$name, $cat, $qty]);

    if ($success) {
        echo json_encode(["success" => true, "message" => "Sikeres mentés!"]);
    } else {
        throw new Exception("Nem sikerült a mentés az adatbázisba.");
    }

} catch (Exception $e) {
    // Ha bármi elromlik, JSON formátumban küldjük vissza a hibaüzenetet!
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
exit();