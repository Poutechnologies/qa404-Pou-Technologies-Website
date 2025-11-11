<?php
session_start();
require '../database/db.php';
try {
    $name = "Admin";
    $last_name = "Prueba";
    $email = "admin@prueba.com";
    $password = password_hash("password", PASSWORD_BCRYPT);
    $role = "admin";
    
    $stmt = $pdo->prepare("INSERT INTO admin_users (name, last_name, email, password, role, is_active, created_at) 
                          VALUES (?, ?, ?, ?, ?, TRUE, NOW())");
    $stmt->execute([$name, $last_name, $email, $password, $role]);
    
    echo "Usuario de prueba creado exitosamente:<br>";
    echo "Email: admin@prueba.com<br>";
    echo "Contraseña: password";
} catch (PDOException $e) {
    echo "Error al crear usuario: " . $e->getMessage();
}