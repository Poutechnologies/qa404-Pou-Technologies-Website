<?php
require 'database/conection.php';

$name = "Admin";
$email = "admin@miweb.com";
$password = "123456"; // contraseña temporal

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO users (name, email, password, role, must_change_password) VALUES (?, ?, ?, ?, ?)");
$stmt->execute([$name, $email, $hashedPassword, 'admin', 1]);

echo "Usuario creado: $email con contraseña: $password";
