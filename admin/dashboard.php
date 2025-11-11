
<body class="app sidebar-mini">
    

  <!-- Connection to db -->
    <?php
    include('../admin/helpers/connection.php');
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
    