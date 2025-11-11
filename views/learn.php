<!-- Header -->
<?php
$pageTitle = "Learning sphere"; // Define el título de la página
include('../includes/header.php');
?>

<style>
    .navbar-brand {
        font-weight: bold;
        font-size: 1.5rem;
    }

    .hero-section {
        background-image: url('../images/webSiteImages/bgSeo.png');
        /* Ruta de la imagen */
        background-size: cover;
        /* Ajusta la imagen para cubrir toda la sección */
        background-position: center;
        /* Centra la imagen */
        background-repeat: no-repeat;
        /* Evita que la imagen se repita */
        color: white;
        /* Color del texto */
        padding: 100px 0;
        /* Espaciado interno */
        text-align: end;

    }

    .section-title {
        font-size: 2rem;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .section-content {
        font-size: 1.1rem;
        line-height: 1.8;
    }



    /*DETAILS BUTTON */
    .details-btn {
        display: none;
        transition: opacity 0.3s ease-in-out;
    }

    .feature-box:hover .details-btn {
        display: inline-block;
        opacity: 1;
    }


    .info-icon {
        color: #6c757d;
        margin-left: 5px;
        font-size: 0.9em;
    }

    .sub-features {
        margin-top: 5px;
        margin-left: 20px;
        font-size: 0.9em;
        color: #6c757d;
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <h1 class="text-secondary">Welcome to learning sphere</h1>
        <p class="lead text-secondary">The space where information is free</p>
    </div>
</section>


<!-- What is WebSphere Section -->
<section class="what-is-section py-5">
    <div class="container">
        <h2 class="text-muted" style="font-weight: normal">What is WebSphere</h2>
        <p>
            WebSphere is an all-in-one digital platform designed to help businesses build, optimize, and grow their online presence.
            From professional web design to advanced SEO strategies, we provide the tools and expertise you need to succeed in the digital world.
            Whether you're a small business or a large enterprise, WebSphere is your partner in achieving online success.
        </p>
    </div>
</section>




        <section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-5">🔍 Do you want to learn about technology and how your website works?</h2>
    <div class="row g-4">
      
      <!-- Cómo funciona un sitio web -->
      <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title">🧠 ¿Cómo funciona un sitio web?</h5>
            <p class="card-text">Un sitio web combina dominio, hosting y diseño. Es como tu tienda abierta 24/7: el dominio es la dirección, el hosting es el local y el diseño es cómo se ve por dentro.</p>
          </div>
        </div>
      </div>

      <!-- Qué es el SEO -->
      <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title">🔍 ¿Qué es el SEO?</h5>
            <p class="card-text">El SEO te ayuda a aparecer en Google. Con buena velocidad, contenido relevante y palabras clave correctas, atraes más visitas orgánicas a tu sitio.</p>
          </div>
        </div>
      </div>

      <!-- Qué es el Scam -->
      <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title">🛡️ ¿Qué es el Scam?</h5>
            <p class="card-text">El scam digital incluye fraudes como phishing, sitios falsos o suplantación. Protege tu sitio con SSL, contraseñas seguras y buenas prácticas.</p>
          </div>
        </div>
      </div>

      <!-- Qué son los Analytics -->
      <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title">📈 ¿Qué son los Analytics?</h5>
            <p class="card-text">Con herramientas como Google Analytics sabrás cuántas personas te visitan, desde dónde y qué hacen en tu web. Ideal para tomar decisiones con datos.</p>
          </div>
        </div>
      </div>

      <!-- Tecnología y buenas prácticas -->
      <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title">⚙️ Buenas prácticas web</h5>
            <p class="card-text">Diseño adaptable a móviles, carga rápida, accesibilidad y mantenimiento continuo son claves para un sitio profesional y efectivo.</p>
          </div>
        </div>
      </div>

    </div>

    <div class="text-center mt-5">
      <p class="lead fw-bold">Cuando entiendes cómo funciona tu sitio, entiendes cómo hacer crecer tu negocio.</p>
    </div>
  </div>
</section>



<section class="container py-5">
  <h1 class="text-center mb-4">Blog</h1>
  <div class="row g-4">
    <?php foreach ($posts as $p): ?>
      <div class="col-md-4">
        <article class="card h-100 shadow-sm border-0">
          <img src="<?= htmlspecialchars($p['cover_img']) ?>" class="card-img-top"
               alt="<?= htmlspecialchars($p['title']) ?>">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($p['title']) ?></h5>
            <p class="card-text"><?= nl2br(htmlspecialchars($p['teaser'])) ?></p>
            <a class="btn btn-primary" href="/blog/<?= $p['slug'] ?>">Leer más</a>
          </div>
        </article>
      </div>
    <?php endforeach ?>
  </div>

  <!-- Pagination -->
  <nav class="mt-5">
    <ul class="pagination justify-content-center">
    <?php for ($i=1;$i<=$pages;$i++): ?>
      <li class="page-item <?= $i==$page?'active':'' ?>">
         <a class="page-link" href="?p=<?= $i ?>"><?= $i ?></a>
      </li>
    <?php endfor ?>
    </ul>
  </nav>
</section>





        <!-- Required for Bootstrap tooltips -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            });
        </script>



        <!-- Footer -->
        <?php
        include('../includes/footer.php');
        ?>