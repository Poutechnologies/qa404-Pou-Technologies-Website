<!-- Header -->
<?php
$pageTitle = "Photo and Video"; // Define el título de la página
include('../includes/header.php');
?>

<style>
    .navbar-brand {
        font-weight: bold;
        font-size: 1.5rem;
    }

    .hero-section {
        background-image: url('../images/webSiteImages/bgSeo.svg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: white;
        padding: 100px 0;
        text-align: end;
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <h1 class="text-secondary">Discover Digital Marketing</h1>
        <p class="lead text-secondary">Digital Marketing Strategies that Generate Real Results</p>
    </div>
</section>

<!-- What is marketing Section -->
<section class="what-is-section py-5">
    <div class="container">
        <h2 class="text-muted" style="font-weight: normal">What We Do</h2>
        <p>
            Our <strong>photo and video production</strong> services are designed to help businesses capture attention
            and stand out online. Whether it’s product photography, promotional videos, or coverage for events — we bring
            your brand to life with a professional touch.
        </p>
        <p>
            We work with local businesses and professionals to deliver high-quality visuals optimized for websites,
            social media, and digital marketing campaigns.
        </p>
    </div>
</section>

<!-- Benefits Section -->
<section class="bg-light py-5">
  <div class="container">
    <h2 class="text-center mb-4 text-muted" style="font-weight: normal;">
      Why Invest in Professional Photo & Video?
    </h2>
    <div class="row g-4">

      <!-- Card 1 -->
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm p-3 text-center">
          <img src="../images/webSiteImages/stronger.png" alt="Stronger First Impression"
               class="img-fluid rounded mb-3 benefit-img">
          <h5 class="text-secondary">✅ Stronger First Impression</h5>
          <p>Professional visuals make your brand look trustworthy and increase customer engagement.</p>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm p-3 text-center">
          <img src="../images/webSiteImages/sales.png" alt="More Sales Opportunities"
               class="img-fluid rounded mb-3 benefit-img">
          <h5 class="text-secondary">🎥 More Sales Opportunities</h5>
          <p>Videos and quality photos can boost conversion rates and attract attention on social media.</p>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm p-3 text-center">
          <img src="../images/webSiteImages/digital.png" alt="Better Digital Performance"
               class="img-fluid rounded mb-3 benefit-img">
          <h5 class="text-secondary">📈 Better Digital Performance</h5>
          <p>Optimized content performs better in marketing campaigns, increasing visibility and clicks.</p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Optional CSS -->
<style>
  .benefit-img {
    width: 100%;
    max-height: 240px;
    object-fit: cover;
    border-radius: 10px;
    transition: transform 0.3s ease;
  }

  .benefit-img:hover {
    transform: scale(1.05);
  }

  .card p {
    font-size: 0.95rem;
  }
</style>


<!-- photo-video.php -->
<?php
$trabajos = [
    [
        'tipo' => 'foto',
        'titulo' => 'Sesión en exteriores',
        'imagen' => '/images/photoAndVideo/photo/3lo1.jpg',
        'descripcion' => 'Sesión de fotos en la ciudad.'
    ],
    [
        'tipo' => 'foto',
        'titulo' => 'Retrato profesional',
        'imagen' => '/images/photoAndVideo/photo/3lo2.jpg',
        'descripcion' => 'Fotografía de estudio profesional.'
    ],
    [
        'tipo' => 'video',
        'titulo' => 'Video promocional',
        'video' => '/images/photoAndVideo/video/3loVideo.mp4',
        'thumbnail' => '/images/photoAndVideo/video/3loTumbnail.png',
        'descripcion' => 'Video para campaña de marketing.'
    ],
    [
        'tipo' => 'video',
        'titulo' => 'Evento corporativo',
        'video' => 'videos/video2.mp4',
        'thumbnail' => 'images/thumbs/video2.jpg',
        'descripcion' => 'Cobertura de evento empresarial.'
    ],
];
?>

<?php $urlActual = "https://tusitio.com/photo-video.php"; ?>

<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4">Nuestros Trabajos</h2>

        <!-- Botones de filtro -->
        <div class="text-center mb-4">
            <button class="btn btn-outline-dark me-2 filter-btn active" data-filter="all">Todos</button>
            <button class="btn btn-outline-dark me-2 filter-btn" data-filter="foto">Fotos</button>
            <button class="btn btn-outline-dark filter-btn" data-filter="video">Videos</button>
        </div>

        <!-- Masonry -->
        <div id="gallery" class="masonry">
            <?php foreach ($trabajos as $index => $trabajo): ?>
                <div class="masonry-item gallery-item" data-type="<?= $trabajo['tipo'] ?>">
                    <div class="card border-0 shadow-sm">
                        <?php if ($trabajo['tipo'] === 'foto'): ?>
                            <!-- Foto con modal -->
                            <img src="<?= $trabajo['imagen'] ?>" class="card-img-top" alt="<?= $trabajo['titulo'] ?>"
                                data-bs-toggle="modal" data-bs-target="#photoModal<?= $index ?>"
                                style="cursor:pointer;">
                        <?php else: ?>
                            <!-- Contenedor con botón de play -->
                            <div class="video-container position-relative">
                                <img src="<?= $trabajo['thumbnail'] ?>" class="card-img-top video-thumb"
                                    alt="<?= $trabajo['titulo'] ?>"
                                    data-bs-toggle="modal"
                                    data-bs-target="#videoModal<?= $index ?>"
                                    style="cursor:pointer;">
                                <div class="play-button">
                                    <i class="bi bi-play-circle-fill"></i>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Card Body con botones de compartir -->
                        <div class="card-body text-center">
                            <h6 class="card-title mb-1"><?= $trabajo['titulo'] ?></h6>
                            <small class="text-muted"><?= $trabajo['descripcion'] ?></small>

                            <!-- Dropdown con ícono de compartir -->
                            <div class="mt-2 dropdown">
                                <button class="btn btn-outline-secondary p-2" type="button" id="shareDropdown<?= $index ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-share"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="shareDropdown<?= $index ?>">
                                    <li>
                                        <a class="dropdown-item" href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($urlActual) ?>" target="_blank">
                                            Facebook
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="https://twitter.com/intent/tweet?url=<?= urlencode($urlActual) ?>&text=<?= urlencode($trabajo['titulo']) ?>" target="_blank">
                                            Twitter
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="https://api.whatsapp.com/send?text=<?= urlencode($trabajo['titulo'] . ' ' . $urlActual) ?>" target="_blank">
                                            WhatsApp
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Modal para foto -->
                <?php if ($trabajo['tipo'] === 'foto'): ?>
                    <div class="modal fade" id="photoModal<?= $index ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content bg-transparent border-0">
                                <div class="modal-body p-0">
                                    <img src="<?= $trabajo['imagen'] ?>" class="img-fluid rounded" alt="<?= $trabajo['titulo'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Modal para video -->
                <?php if ($trabajo['tipo'] === 'video'): ?>
                    <div class="modal fade" id="videoModal<?= $index ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <video controls autoplay class="w-100">
                                        <source src="<?= $trabajo['video'] ?>" type="video/mp4">
                                        Tu navegador no soporta video.
                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>



<!-- JS para el filtrado -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const filterBtns = document.querySelectorAll(".filter-btn");
        const items = document.querySelectorAll(".gallery-item");

        filterBtns.forEach(btn => {
            btn.addEventListener("click", () => {
                filterBtns.forEach(b => b.classList.remove("active"));
                btn.classList.add("active");

                const filter = btn.getAttribute("data-filter");

                items.forEach(item => {
                    if (filter === "all" || item.dataset.type === filter) {
                        item.style.display = "inline-block";
                    } else {
                        item.style.display = "none";
                    }
                });
            });
        });
    });
</script>

<!-- Masonry CSS -->
<style>
    .masonry {
        column-count: 1;
        column-gap: 1rem;
    }

    @media(min-width: 576px) {
        .masonry {
            column-count: 2;
        }
    }

    @media(min-width: 992px) {
        .masonry {
            column-count: 3;
        }
    }

    @media(min-width: 1200px) {
        .masonry {
            column-count: 4;
        }
    }

    .masonry-item {
        display: inline-block;
        margin-bottom: 1rem;
        width: 100%;
    }

    .card-img-top {
        width: 100%;
        border-radius: 0.5rem;
        transition: transform 0.3s ease;
    }

    .card-img-top:hover {
        transform: scale(1.05);
    }
</style>

<!-- CONTACT -->
<section class="py-5 text-center container" style="margin-top: 100px; background-image: url('images/webSiteImages/'); background-size: cover; background-position: center;">
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h2 class="text-muted mt-n5">Ready to get Started?</h2>
            <div class="justify-content-center py-3">
                <a href="contact.html">
                    <button id="colora" class="btn btn-outline-secondary" type="button">Let's Talk About Your Project</button>
                </a>
            </div>
        </div>
    </div>
</section>

<?php include('../includes/footer.php'); ?>