<!-- login.php -->
<?php session_start(); ?>


<!-- Header -->
<?php
$pageTitle = "Log in"; // Define el título de la página
include('../includes/header.php');
?>


<section class="login-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4">Log in</h3>

                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger">
                                <?= $_SESSION['error'];
                                unset($_SESSION['error']); ?>
                            </div>
                        <?php endif; ?>

                        <form action="/admin/process/login_process.php" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-envelope-fill"></i>
                                    </span>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock-fill"></i>
                                    </span>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Log In</button>
                        </form>
                    </div>
                </div>
                <p class="text-center text-black mt-3" style="font-size: 0.9rem;">Forgot your password? <a href="#" class="text-warning">recover it here</a></p>
            </div>
        </div>
    </div>
</section>







<!-- Footer-->
<?php include('../includes/footer.php'); ?>