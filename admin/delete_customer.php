<?php
session_start();
require_once '../database/db.php';

// // Verificar permisos
// if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
//     header('Location: login.php');
//     exit();
// }

// Obtener ID del cliente a eliminar
$customer_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$customer_id) {
    header('Location: dashboard.php');
    exit();
}

// Verificar si existe el cliente
$stmt = $pdo->prepare("SELECT id FROM customers WHERE id = ?");
$stmt->execute([$customer_id]);
if (!$stmt->fetch()) {
    header('Location: dashboard.php');
    exit();
}

try {
    // Eliminar el cliente
    $stmt = $pdo->prepare("DELETE FROM customers WHERE id = ?");
    $stmt->execute([$customer_id]);
    
    $_SESSION['swal'] = [
        'icon' => 'success',
        'title' => '¡Eliminado!',
        'text' => 'El cliente ha sido eliminado correctamente'
    ];
} catch (PDOException $e) {
    $_SESSION['swal'] = [
        'icon' => 'error',
        'title' => 'Error',
        'text' => 'No se pudo eliminar el cliente: ' . $e->getMessage()
    ];
}

header('Location: dashboard.php');
exit();