<?php
$host = "localhost";
$dbname = "inventory_db";
$user = "root";
$pass = ""; // XAMPP-nál alapértelmezetten üres

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Itt ne legyen echo! Csak dobjunk egy hibát, amit az API elkap.
    throw new Exception("Kapcsolódási hiba: " . $e->getMessage());
}