<?php
session_start();
require 'conexion.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $newPassword = $_POST['new_password'];
  $confirmPassword = $_POST['confirm_password'];

  if ($newPassword === $confirmPassword && strlen($newPassword) >= 6) {
    $hashed = password_hash($newPassword, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("UPDATE users SET password = ?, must_change_password = 0 WHERE id = ?");
    $stmt->execute([$hashed, $_SESSION['user_id']]);

    $_SESSION['success'] = "Contraseña cambiada con éxito.";
    header("Location: dashboard.php");
    exit;
  } else {
    $error = "Las contraseñas no coinciden o son demasiado cortas.";
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Cambiar contraseña</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <h3 class="text-center mb-4">Cambiar Contraseña</h3>

      <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
      <?php endif; ?>

      <form method="POST">
        <div class="mb-3">
          <label for="new_password" class="form-label">Nueva contraseña</label>
          <input type="password" name="new_password" class="form-control" required minlength="6">
        </div>
        <div class="mb-3">
          <label for="confirm_password" class="form-label">Confirmar contraseña</label>
          <input type="password" name="confirm_password" class="form-control" required minlength="6">
        </div>
        <button type="submit" class="btn btn-success w-100">Guardar</button>
      </form>
    </div>
  </div>
</div>

</body>
</html>
