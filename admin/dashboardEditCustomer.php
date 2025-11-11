<body class="app sidebar-mini">


    <!-- Connection to db -->
    <?php
    include('../admin/helpers/connectionEditCustomer.php');
    ?>

    <!-- Header -->
    <?php
    $pageTitle = "Customers"; // Define el título de la página
    include('../includes/headerAdmin.php');
    ?>

    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <!-- Nav Admin-->
    <?php include('../includes/navAdmin.php'); ?>

    <main class="app-content">
        <div class="app-title">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <h1 class="mb-0"><i class="bi bi-people-fill me-2"></i>Welcome to WebSphere</h1>
                </div>


            </div>
            <!-- <p class="mt-2">Manage your clients from here</p> -->
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
                <li class="breadcrumb-item"><a href="/admin/customers.php">WebSphere</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">

                    <!-- Edit customer -->
                    <section class="container mt-4">
                        <div class="row justify-content-center">
                            <div class="col-lg-8 col-md-10">
                                <div class="card shadow-sm border-0">
                                    <div class="card-header bg-primary text-white">
                                        <h2 class="h4 mb-0"><i class="bi bi-person-gear me-2"></i>Edit Customer</h2>
                                    </div>

                                    <div class="card-body p-4">
                                        <?php if (isset($error)): ?>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <?= $error ?>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        <?php endif; ?>

                                        <form method="POST" class="needs-validation" novalidate>
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="name" name="name"
                                                            value="<?= htmlspecialchars($customer['name']) ?>" required
                                                            placeholder="Nombre">
                                                        <label for="name" class="form-label">Name</label>
                                                        <div class="invalid-feedback">
                                                            Please enter the customer's name.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                                            value="<?= htmlspecialchars($customer['last_name']) ?>" required
                                                            placeholder="Last Name">
                                                        <label for="last_name" class="form-label">Last Name</label>
                                                        <div class="invalid-feedback">
                                                            Please enter the customer's last name.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="email" class="form-control" id="email" name="email"
                                                            value="<?= htmlspecialchars($customer['email']) ?>" required
                                                            placeholder="correo@ejemplo.com">
                                                        <label for="email" class="form-label">Email</label>
                                                        <div class="invalid-feedback">
                                                            Please enter a valid email address.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="tel" class="form-control" id="phone" name="phone"
                                                            value="<?= htmlspecialchars($customer['phone']) ?>"
                                                            placeholder="Teléfono">
                                                        <label for="phone" class="form-label">Phone</label>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="url" class="form-control" id="website_url" name="website_url"
                                                            value="<?= htmlspecialchars($customer['website_url']) ?>" required
                                                            placeholder="https://ejemplo.com">
                                                        <label for="website_url" class="form-label">Website</label>
                                                        <div class="invalid-feedback">
                                                            Please enter a valid URL (including http:// or https://).
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-check form-switch mb-4">
                                                        <input class="form-check-input" type="checkbox" role="switch"
                                                            id="is_active" name="is_active" value="1"
                                                            <?= $customer['is_active'] ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="is_active">Active account</label>
                                                    </div>
                                                </div>

                                                <div class="col-12 d-flex justify-content-between mt-4">
                                                    <a href="dashboard.php" class="btn btn-outline-secondary px-4">
                                                        <i class="bi bi-arrow-left me-2"></i>Cancel
                                                    </a>
                                                    <button type="submit" class="btn btn-primary px-4">
                                                        <i class="bi bi-save me-2"></i>Save
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Agrega este script para la validación del formulario -->
                    <script>
                        // Ejemplo de JavaScript para deshabilitar el envío de formularios si hay campos no válidos
                        (() => {
                            'use strict'

                            // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap personalizados
                            const forms = document.querySelectorAll('.needs-validation')

                            // Bucle sobre ellos y evitar el envío
                            Array.from(forms).forEach(form => {
                                form.addEventListener('submit', event => {
                                    if (!form.checkValidity()) {
                                        event.preventDefault()
                                        event.stopPropagation()
                                    }

                                    form.classList.add('was-validated')
                                }, false)
                            })
                        })()
                    </script>


                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
    </main>

    <!-- Footer-->
    <?php include('../includes/footerAdmin.php'); ?>