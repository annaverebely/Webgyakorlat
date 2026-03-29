<?php
session_start(); // Elindítjuk, hogy elérjük a jelenlegi munkamenetet
session_unset(); // Töröljük a változókat
session_destroy(); // Teljesen megsemmisítjük a munkamenetet

// Visszaküldjük a felhasználót a bejelentkező oldalra
header("Location: login.php");
exit();
?>