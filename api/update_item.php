<?php
session_start();
include '../config.php';
header('Content-Type: application/json');

// Alapértelmezett válasz
$response = ["success" => false, "message" => "Ismeretlen hiba"];

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Adatok begyűjtése
        $id = $_POST['id'] ?? null;
        $name = $_POST['name'] ?? '';
        $cat = $_POST['category'] ?? '';
        $qty = $_POST['quantity'] ?? 0;

        // Ellenőrzés
        if (!$id) {
            throw new Exception("Hiányzó azonosító (ID)!");
        }

        if (empty($name)) {
            throw new Exception("Az eszköz neve nem lehet üres!");
        }

        // Adatbázis módosítás
        $stmt = $conn->prepare("UPDATE items SET name = ?, category = ?, quantity = ? WHERE id = ?");
        $result = $stmt->execute([$name, $cat, $qty, $id]);

        if ($result) {
            $response = ["success" => true, "message" => "Sikeres frissítés!"];
        } else {
            throw new Exception("Nem sikerült az adatbázis frissítése.");
        }
    } else {
        throw new Exception("Érvénytelen kérés metódus.");
    }
} catch (Exception $e) {
    $response = ["success" => false, "message" => "Szerver hiba: " . $e->getMessage()];
}

// Mindig küldünk JSON választ
echo json_encode($response);
exit();
?>