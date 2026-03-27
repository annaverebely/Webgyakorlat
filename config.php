<?php
$host = "localhost";
$dbname = "inventory_db"; 
$username = "root";       
$password = "";           

try {
    // A DSN-ben adjuk meg a charset=utf8-at
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Ez biztosítja, hogy a magyar ékezetek ne "krix-kraxok" legyenek
    $conn->exec("set names utf8"); 
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Sikerült a csatlakozás!"; 
} catch(PDOException $e) {
    die("Hiba: " . $e->getMessage());
}
?>