<?php
include '../config.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Figyelj a változónevekre, hogy egyezzenek a HTML-lel
    $user = $_POST['username'];
    $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);

    try {
        // Átírtuk: "users" helyett "felhasznalok", és a mezőnevek is egyezzenek (felhasznalonev, jelszo)
        $stmt = $conn->prepare("INSERT INTO felhasznalok (felhasznalonev, jelszo) VALUES (?, ?)");
        $stmt->execute([$user, $pass]);
        echo json_encode(["success" => true, "message" => "Sikeres regisztráció!"]);
    } catch (Exception $e) {
        // Ha itt hiba van, most már kiírjuk a pontos SQL hibát is, hogy lásd mi a baj
        echo json_encode(["success" => false, "message" => "Hiba: " . $e->getMessage()]);
    }
}
?>