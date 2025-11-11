
<body class="app sidebar-mini">
    

  <!-- Connection to db -->
    <?php
    include('../admin/helpers/connectionCustomerForm.php');
    ?>
    
    <!-- Header -->
    <?php
    $pageTitle = "Subscriptions"; // Define el título de la página
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
        <h1 class="mb-0"><i class="bi bi-people-fill me-2"></i> Subscriptions</h1>
      </div>
      <button type="button" class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#modalFormCustomer">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"></path>
          <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path>
        </svg>
        
        Add Subscription
        
      </button>
      <?php include ('../admin/modals/modalCustomers.php'); ?>
    </div>
    <p class="mt-2">Manage your Subscriptions from here</p>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
      <li class="breadcrumb-item"><a href="/admin/customersAdmin.php">Subscriptions</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">

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
                                            <a href="../admin/dashboardEditCustomer.php?id=<?= $customer['id'] ?>" class="btn btn-sm btn-outline-primary" title="Edit">
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

                    <!-- <div class="row justify-content-end mt-3">
                        <div class="col-auto">
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                                <i class="bi bi-plus-circle me-1"></i>Add Customer
                            </button>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</main>


 <!-- Footer-->
 <?php include('../includes/footerAdmin.php'); ?>

    <!-- Footer-->
<?php include('../admin/helpers/sweetAlerts.php'); ?>
    