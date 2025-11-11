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

include '../database/db.php';

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

<?php
$pageTitle = "Dashboard"; // Define el título de la página
include('../includes/headerAdmin.php');
?>

<!-- Elimina el container que envuelve toda la sección -->
<div class="main-content-wrapper px-3 py-2">
    <h3 class="mb-4">Welcome to Webspere, <?php echo $user['name'] . ' ' . $user['last_name']; ?></h3>

    <div class="row g-4">
        <!-- Card 1: Información de Usuario -->
        <div class="col-lg-4 col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title d-flex align-items-center">
                        <i class="bi bi-person-circle me-2"></i> User Profile
                    </h5>
                    <div class="card-text">
                        <p><strong><i class="bi bi-person me-2"></i>Name:</strong> <?php echo $user['name']; ?></p>
                        <p><strong><i class="bi bi-person-badge me-2"></i>Last Name:</strong> <?php echo $user['last_name']; ?></p>
                        <p><strong><i class="bi bi-envelope me-2"></i>Email:</strong> <?php echo $user['email']; ?></p>
                        <p><strong><i class="bi bi-shield-lock me-2"></i>Role:</strong>
                            <span class="badge bg-primary"><?php echo $user['role']; ?></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Estadísticas -->
        <div class="col-lg-4 col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title d-flex align-items-center">
                        <i class="bi bi-bar-chart-line me-2"></i> Statistics
                    </h5>
                    <div class="card-text">
                        <p class="d-flex justify-content-between align-items-center mb-3">
                            <span><i class="bi bi-people me-2"></i>Registered customers:</span>
                            <span class="badge bg-success rounded-pill p-2">
                                <?php
                                $stmt = $pdo->query("SELECT COUNT(*) FROM customers");
                                echo $stmt->fetchColumn();
                                ?>
                            </span>
                        </p>
                        <p class="d-flex justify-content-between align-items-center">
                            <span><i class="bi bi-globe me-2"></i>Sitios web activos:</span>
                            <span class="badge bg-info rounded-pill p-2">
                                <?php
                                $stmt = $pdo->query("SELECT COUNT(*) FROM customers WHERE is_active = 1");
                                echo $stmt->fetchColumn();
                                ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: Reloj y Clima -->
        <div class="col-lg-4 col-md-12">
            <div class="card h-100 weather-card">
                <div class="card-body text-center">
                    <!-- Reloj -->
                    <div class="mb-3">
                        <div class="clock fs-3 fw-bold" id="clock">00:00:00</div>
                        <div class="date text-muted small" id="date">Lunes, 1 de enero 2023</div>
                    </div>

                    <!-- Temperatura -->
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <i class="bi bi-cloud-sun weather-icon text-warning me-3"></i>
                        <div>
                            <div class="temperature fs-2 fw-bold" id="temperature">24°C</div>
                            <small class="text-muted">Soleado</small>
                        </div>
                    </div>

                    <!-- Ubicación -->
                    <div class="text-muted small">
                        <i class="bi bi-geo-alt"></i>
                        <span id="location">Ciudad, País</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de clientes -->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title d-flex align-items-center">
                <i class="bi bi-people-fill me-2"></i> Customer List
            </h5>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Website</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $pdo->query("SELECT * FROM customers ORDER BY created_at DESC");
                        while ($customer = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?= $customer['id'] ?></td>
                                <td><?= htmlspecialchars($customer['name'] . ' ' . $customer['last_name']) ?></td>
                                <td><?= htmlspecialchars($customer['email']) ?></td>
                                <td>
                                    <a href="<?= htmlspecialchars($customer['website_url']) ?>" target="_blank">
                                        <?= parse_url($customer['website_url'], PHP_URL_HOST) ?>
                                    </a>
                                </td>
                                <td>
                                    <span class="badge <?= $customer['is_active'] ? 'bg-success' : 'bg-secondary' ?>">
                                        <?= $customer['is_active'] ? 'Active' : 'Inactive' ?>
                                    </span>
                                </td>
                                <td>
                                    <!-- Botón Editar -->
                                    <a href="../admin/edit_customer.php?id=<?= $customer['id'] ?>" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <!-- Botón Eliminar con SweetAlert -->
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-danger delete-btn" 
                                            title="Delete" 
                                            data-id="<?= $customer['id'] ?>">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <div class="row justify-content-end mt-3">
                <div class="col-auto">
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                        <i class="bi bi-plus-circle me-1"></i>Add Customer
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para agregar cliente -->
<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCustomerModalLabel">Add New Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" required>
                            <button class="btn btn-outline-secondary" type="button" id="generatePassword">
                                <i class="bi bi-arrow-repeat"></i> Generate
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="website_url" class="form-label">Website URL</label>
                        <input type="url" class="form-control" id="website_url" name="website_url" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked>
                        <label class="form-check-label" for="is_active">Active Account</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add_customer" class="btn btn-primary">Save Customer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Script to sweet alert -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Selecciona todos los botones de eliminar
    const deleteButtons = document.querySelectorAll('.delete-btn');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const customerId = this.getAttribute('data-id');
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to reverse this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, remove it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirige para eliminar si se confirma
                    window.location.href = `../admin/delete_customer.php?id=${customerId}`;

                    Swal.fire({
                    title: "Removed!",
                    icon: "success",
                    draggable: true
                    });
                    
                    // Opcional: Mostrar mensaje de éxito (se ejecutará después de la redirección)
                    // En delete_customer.php deberás manejar esto con sesiones
                }
            });
        });
    });
});
</script>

<!-- Script para el reloj y clima -->
<script>
    function updateClock() {
        const now = new Date();
        const time = now.toLocaleTimeString();
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        const date = now.toLocaleDateString('en-EN', options);

        document.getElementById('clock').textContent = time;
        document.getElementById('date').textContent = date;
    }

    setInterval(updateClock, 1000);
    updateClock();

    function updateWeather() {
        // Simulación - reemplazar con API real
        const temp = Math.floor(Math.random() * 10) + 20;
        document.getElementById('temperature').textContent = `${temp}°C`;
        document.getElementById('location').textContent = "Charlottetown, Canada";
    }

    updateWeather();

    // Generar contraseña aleatoria
    document.getElementById('generatePassword').addEventListener('click', function() {
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*';
        let password = '';
        for (let i = 0; i < 12; i++) {
            password += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        document.getElementById('password').value = password;
        document.getElementById('password').type = 'text';
    });
</script>

<!-- Footer-->
<?php include('../includes/footerAdmin.php'); ?>

