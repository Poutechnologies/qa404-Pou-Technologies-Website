<?php
// Definir el título de la página dinámicamente
$pageTitle = "Título de la entrada 1"; // Esto puede venir de una base de datos o un array
include('../includes/header.php');
?>

<main class="container">
  <div class="row g-5">
    <!-- Contenido de la entrada -->
    <div class="col-md-8">
      <article class="blog-post">
        <!-- Título de la entrada -->
        <h2 class="blog-post-title">Título de la entrada 1</h2>

        <!-- Fecha y autor -->
        <p class="blog-post-meta">12 de noviembre de 2023 por <a href="#">Autor</a></p>

        <!-- Imagen destacada -->
        <img src="https://via.placeholder.com/800x400" class="img-fluid mb-4" alt="Imagen de la entrada 1">

        <!-- Contenido de la entrada -->
        <p>Este es el contenido completo de la entrada 1. Aquí puedes escribir todo lo que desees, incluyendo texto, imágenes, videos, enlaces, etc.</p>

        <h3>Subtítulo 1</h3>
        <p>Este es un párrafo adicional para expandir la información. Puedes usar múltiples párrafos, listas, citas y más.</p>

        <blockquote class="blockquote">
          <p>Una cita interesante relacionada con el contenido de la entrada.</p>
        </blockquote>

        <h3>Subtítulo 2</h3>
        <p>Más contenido para la entrada. Aquí puedes agregar listas, tablas, código, etc.</p>

        <ul>
          <li>Elemento de lista 1</li>
          <li>Elemento de lista 2</li>
          <li>Elemento de lista 3</li>
        </ul>

        <p>Finaliza la entrada con un resumen o una conclusión.</p>
      </article>

      <!-- Navegación entre entradas -->
      <nav class="blog-pagination my-4" aria-label="Navegación entre entradas">
        <a class="btn btn-outline-primary rounded-pill" href="entrada2.php">Entrada anterior</a>
        <a class="btn btn-outline-secondary rounded-pill" href="entrada3.php">Siguiente entrada</a>
      </nav>
    </div>

    <!-- Barra lateral -->
    <div class="col-md-4">
      <div class="position-sticky" style="top: 2rem;">
        <!-- Sobre el autor -->
        <div class="p-4 mb-3 bg-body-tertiary rounded">
          <h4 class="fst-italic">Sobre el autor</h4>
          <p class="mb-0">Información breve sobre el autor de la entrada. Puedes incluir una descripción y enlaces a sus redes sociales.</p>
        </div>

        <!-- Entradas recientes -->
        <div class="p-4">
          <h4 class="fst-italic">Entradas recientes</h4>
          <ul class="list-unstyled mb-0">
            <li><a href="entrada1.php">Título de la entrada 1</a></li>
            <li><a href="entrada2.php">Título de la entrada 2</a></li>
            <li><a href="entrada3.php">Título de la entrada 3</a></li>
          </ul>
        </div>

        <!-- Archivos -->
        <div class="p-4">
          <h4 class="fst-italic">Archivos</h4>
          <ol class="list-unstyled mb-0">
            <li><a href="#">Noviembre 2023</a></li>
            <li><a href="#">Octubre 2023</a></li>
            <li><a href="#">Septiembre 2023</a></li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</main>

<?php
include('../includes/footer.php');
?>