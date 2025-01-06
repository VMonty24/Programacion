<?php
if (isset($_SESSION['mensaje'])) {
  echo '<script>
    alert("' . htmlspecialchars($_SESSION['mensaje']) . '");
    </script>';
  unset($_SESSION['mensaje']);
}
?>

<!-- BANNER -->
<div class="banner">
  <h1 class="title"><b>SUSHI ONE</b></h1>
</div>

<!-- PRODUCTOS CARRUSEL -->
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <!-- Primer slide -->
    <div class="carousel-item active">
      <div class="card">
        <div class="img-wrapper">
          <img src="view/images/publicidad/carrousel_1.webp" alt="Imagen carrousel 1">
        </div>
      </div>
    </div>
    
    <!-- Segundo slide -->
    <div class="carousel-item">
      <div class="card">
        <div class="img-wrapper">
          <img src="view/images/publicidad/carrousel_2.webp" alt="Imagen carrousel 2">
        </div>
      </div>
    </div>

    <!-- Tercer slide -->
    <div class="carousel-item">
      <div class="card">
        <div class="img-wrapper">
          <img src="view/images/publicidad/carrousel_3.webp" alt="Imagen carrousel 3">
        </div>
      </div>
    </div>
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <div class="hexagono-borde-l">
      <img class="icono-flecha-l" src="view/images/iconos/icono_flecha_blanco.webp" alt="...">
      <span class="visually-hidden">Previous</span>
    </div>
  </button>

  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <div class="hexagono-borde-r">
      <img class="icono-flecha-r" src="view/images/iconos/icono_flecha_blanco.webp" alt="...">
      <span class="visually-hidden">Next</span>
    </div>
  </button>
</div>

<!-- PUESTO DE VENTA -->
<div class="container-fluid justify-content-start puesto-venta">
  <div>
    <h2 class="sushi-text">ENCUENTRE SU<br>PUESTO DE VENTA</h2>
  </div>

  <a href="https://www.google.com/maps/search/SushiOne/@41.5851511,-3.3973894,6z/data=!3m1!4b1?entry=ttu&g_ep=EgoyMDI0MTIxMS4wIKXMDSoASAFQAw%3D%3D">
    <div class="icon-container">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50.464 58.271">
        <g stroke-width="1.5" transform="translate(-1624 -187.923)">
          <path 
            d="M50.464 43.992L25.732 58.271 1 43.992V15.434L25.732 1.155l24.732 14.279z" 
            transform="translate(1623.5 187.345)" 
            class="hexagon"></path>
          <path 
            class="icon" 
            d="M0 0l7.432 5.674L14.864 0" 
            transform="rotate(-90 935.432 -711.068)"></path>
        </g>
      </svg>
    </div>
  </a>
</div>

<!-- OFERTAS -->
<div class="container offerts">
  <div class="row offer-top">
    <h3 class="offer-title">OFERTAS</h3>
    <h3 class="restaurant-name">SUSHI ONE WORLD</h3>
  </div>

  <div class="offer row container">
    <div class="offer-background col-6">
      <hp class="offer-discount">-10%</hp>
    </div>
    <div class="col-6 offer-description">
      <h3>OFERTA DISPONIBLE LOS JUEVES</h3>
      <a href="?controller=usuarios&action=redirectOfertas" class="btn-2">CONSEGUIR</a>
    </div>
  </div>

  <div class="offer row container">
    <div class="offer-background col-6">
      <p class="offer-discount">-25%</p>
    </div>
    <div class="col-6 offer-description">
      <h3>OFERTA EXCLUSIVA PARA NUEVOS USUARIOS EN SU PRIMER PEDIDO</h3>
      <a href="?controller=usuarios&action=redirectOfertas" class="btn-2">CONSEGUIR</a>
    </div>
  </div>
</div>
