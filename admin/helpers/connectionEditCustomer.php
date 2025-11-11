<?php
session_start();
require_once '../admin/database/conection.php';

// // Verificar permisos
// if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
//     header('Location: login.php');
//     exit();
// }

// Obtener ID del cliente a editar
$customer_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$customer_id) {
    header('Location: dashboardCustomer.php');
    exit();
}

// Obtener datos del cliente
$stmt = $pdo->prepare("SELECT * FROM customers WHERE id = ?");
$stmt->execute([$customer_id]);
$customer = $stmt->fetch();

if (!$customer) {
    header('Location: dashboardCustomer.php');
    exit();
}

// Procesar formulario de actualización
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $website_url = filter_input(INPUT_POST, 'website_url', FILTER_SANITIZE_URL);
    $is_active = isset($_POST['is_active']) ? 1 : 0;

    // Validar datos
    if ($name && $last_name && $email && $website_url) {
        try {
            $stmt = $pdo->prepare("UPDATE customers SET 
                                 name = ?, 
                                 last_name = ?, 
                                 email = ?, 
                                 phone = ?, 
                                 website_url = ?, 
                                 is_active = ? 
                                 WHERE id = ?");
            $stmt->execute([
                $name,
                $last_name,
                $email,
                $phone,
                $website_url,
                $is_active,
                $customer_id
            ]);
            
            $_SESSION['success_message'] = "Cliente actualizado correctamente";
            header('Location: dashboard.php');
            exit();
        } catch (PDOException $e) {
            $error = "Error al actualizar: " . $e->getMessage();
        }
    } else {
        $error = "Por favor complete todos los campos requeridos";
    }
}
//Header
$pageTitle = "Editar Cliente";
include('../includes/headerAdmin.php');
?>