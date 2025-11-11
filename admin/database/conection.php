<?php


$host = 'localhost';      // Servidor de la base de datos
$dbname = 'db_poutechnologies';  // Nombre de la base de datos
$user = 'root';           // Usuario de la base de datos
$pass = '';               // Contraseña de la base de datos



try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}


?>

