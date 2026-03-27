<?php
session_start();
header('Content-Type: application/json');

// 1. Megpróbáljuk behozni a configot
try {
    if (!file_exists('../config.php')) {
        throw new Exception("A config.php nem található a megadott útvonalon!");
    }
    include '../config.php';
    
    // Ellenőrizzük, hogy létrejött-e a $conn változó
    if (!isset($conn)) {
        throw new Exception("Az adatbázis kapcsolat ($conn) nem jött létre a config.php-ban!");
    }

    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM felhasznalok WHERE felhasznalonev = ?");
    $stmt->execute([$user]);
    $dbUser = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($dbUser && password_verify($pass, $dbUser['jelszo'])) {
        $_SESSION['user_id'] = $dbUser['id'];
        $_SESSION['username'] = $dbUser['felhasznalonev'];
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Hibás név vagy jelszó!"]);
    }

} catch (Exception $e) {
    // Ha bármi hiba van, azt JSON-ben küldjük vissza, nem sima szövegként!
    echo json_encode(["success" => false, "message" => "Hiba: " . $e->getMessage()]);
}
exit();