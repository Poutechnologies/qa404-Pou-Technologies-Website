<?php
// Obtener el ID de la entrada desde la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 1; // Si no hay ID, se usa 1 por defecto

// Simulación de datos de entradas (podrían venir de una base de datos)
$entradas = [
    1 => [
        "titulo" => "Título de la entrada 1",
        "fecha" => "12 de noviembre de 2023",
        "autor" => "Autor 1",
        "imagen" => "https://via.placeholder.com/800x400",
        "contenido" => "Este es el contenido completo de la entrada 1..."
    ],
    2 => [
        "titulo" => "Título de la entrada 2",
        "fecha" => "11 de noviembre de 2023",
        "autor" => "Autor 2",
        "imagen" => "https://via.placeholder.com/800x400",
        "contenido" => "Este es el contenido completo de la entrada 2..."
    ]
];

// Verificar si la entrada existe
if (!isset($entradas[$id])) {
    die("Entrada no encontrada.");
}

// Obtener los datos de la entrada
$entrada = $entradas[$id];

// Definir el título de la página
$pageTitle = $entrada["titulo"];
include('../includes/header.php');
?>

<main class="container">
  <div class="row g-5">
    <!-- Contenido de la entrada -->
    <div class="col-md-8">
      <article class="blog-post">
        <!-- Título de la entrada -->
        <h2 class="blog-post-title"><?php echo $entrada["titulo"]; ?></h2>

        <!-- Fecha y autor -->
        <p class="blog-post-meta"><?php echo $entrada["fecha"]; ?> por <a href="#"><?php echo $entrada["autor"]; ?></a></p>

        <!-- Imagen destacada -->
        <img src="<?php echo $entrada["imagen"]; ?>" class="img-fluid mb-4" alt="Imagen de <?php echo $entrada["titulo"]; ?>">

        <!-- Contenido de la entrada -->
        <p><?php echo $entrada["contenido"]; ?></p>
      </article>

      <!-- Navegación entre entradas -->
      <nav class="blog-pagination my-4" aria-label="Navegación entre entradas">
        <a class="btn btn-outline-primary rounded-pill" href="entrada.php?id=<?php echo $id - 1; ?>">Entrada anterior</a>
        <a class="btn btn-outline-secondary rounded-pill" href="entrada.php?id=<?php echo $id + 1; ?>">Siguiente entrada</a>
      </nav>
    </div>

    <!-- Barra lateral -->
    <div class="col-md-4">
      <div class="position-sticky" style="top: 2rem;">
        <!-- Sobre el autor -->
        <div class="p-4 mb-3 bg-body-tertiary rounded">
          <h4 class="fst-italic">Sobre el autor</h4>
          <p class="mb-0">Información breve sobre el autor de la entrada.</p>
        </div>

        <!-- Entradas recientes -->
        <div class="p-4">
          <h4 class="fst-italic">Entradas recientes</h4>
          <ul class="list-unstyled mb-0">
            <li><a href="entrada.php?id=1">Título de la entrada 1</a></li>
            <li><a href="entrada.php?id=2">Título de la entrada 2</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</main>

<?php
include('../includes/footer.php');
?>