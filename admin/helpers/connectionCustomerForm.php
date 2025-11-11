<?php
session_start();


// Al inicio del dashboard.php, después de session_start()
if (isset($_SESSION['swal'])) {
    echo "<script>
    Swal.fire({
        icon: '".$_SESSION['swal']['icon']."',
        title: '".$_SESSION['swal']['title']."',
        text: '".$_SESSION['swal']['text']."'
    });
    </script>";
    unset($_SESSION['swal']);
}

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include '../admin/database/conection.php';

// Obtener la información del usuario
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM admin_users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Procesar formulario si se envió
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_customer'])) {
    // Validar y sanitizar los datos
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = $_POST['password'];
    $website_url = filter_input(INPUT_POST, 'website_url', FILTER_SANITIZE_URL);
    $is_active = isset($_POST['is_active']) ? 1 : 0;

    // Validaciones básicas
    if (empty($name) || empty($last_name) || empty($email) || empty($password) || empty($website_url)) {
        $_SESSION['error_message'] = "Todos los campos requeridos deben ser completados";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_message'] = "El email proporcionado no es válido";
    } else {
        try {
            // Hash de la contraseña
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Insertar en la base de datos
            $stmt = $pdo->prepare("INSERT INTO customers 
                                  (name, last_name, email, phone, password, website_url, is_active, created_at) 
                                  VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");

            $stmt->execute([
                $name,
                $last_name,
                $email,
                $phone,
                $hashed_password,
                $website_url,
                $is_active
            ]);

            $_SESSION['success_message'] = "Cliente agregado exitosamente";
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // Error de duplicado (email ya existe)
                $_SESSION['error_message'] = "El email ya está registrado";
            } else {
                $_SESSION['error_message'] = "Error al agregar el cliente: " . $e->getMessage();
            }
        }
    }
}
?>