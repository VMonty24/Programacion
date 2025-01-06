<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sushi One</title>
    <link rel="stylesheet" href="view/css/styles.css">
    <!--BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- TIPOGRACFIA ROBOT -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

<!-- NAVEGADOR -->
<nav class="navbar navbar-expand-md nav">
    <div class="container-fluid d-flex align-items-center">
        <!-- Logo -->
        <a class="col-1" href="?controller=producto">
            <img src="view/images/logo_black.svg" class="logo" alt="Sushi one logo">
        </a>

        <!-- Menú de navegación -->
        <ul class="navbar-nav ms-4 col-md-5 d-flex flex-row align-items-center">
            <li class="nav-item me-4">
                <a class="nav-link" href="?controller=producto">INICIO</a>
            </li>
            <li class="nav-item me-4">
                <a class="nav-link" href="?controller=producto&action=carta">CARTA</a>
            </li>
            <li class="nav-item me-4">
                <a class="nav-link" href="https://www.google.com/maps/search/SushiOne/@41.5851511,-3.3973894,6z/data=!3m1!4b1?entry=ttu&g_ep=EgoyMDI0MTIxMS4wIKXMDSoASAFQAw%3D%3D">LOCALES</a>
            </li>
        </ul>

        <!-- Botón de pedido -->
        <div class="col-md-2 d-flex flex-end justify-content-end align-items-center col-2">
            <a href="?controller=producto&action=carta" class="btn-1">EMPEZAR PEDIDO</a>
        </div>

        <!-- Iconos -->
        <div class="col-md-4 d-flex justify-content-end align-items-center icon-nav">
            <a class="nav-item me-4" href="?controller=producto&action=carrito">
                <img src="view/images/iconos/icono_carrito_blanco.png" class="icono" alt="carrito">
            </a>
            <a class="nav-item me-4" href="?controller=usuarios&action=userDetails">
                <img src="view/images/iconos/icono_session_blanco.png" class="icono" alt="user">
            </a>
            <a class="nav-item me-4" href="?controller=usuarios&action=logout">
                <img src="view/images/iconos/icono_cerrar_blanco.png" class="icono" alt="logout">
            </a>
        </div>
    </div>
</nav>

<?php include_once $views?>

<!-- FOOTER -->
<footer class="container-fluid css-1r8ynqq">
    <div class="content no-gutters row">
        <div class="col-xl-10 offset-xl-1">
            <div class="row">
                <div class="order-0 mb-3 mb-md-5 col">
                    <ul class="footer-menu text-uppercase">
                        <li class="col-6 col-md-auto mr-md-4 mr-lg-5">
                            <a href="https://www.lamborghini.com/es-en">EMPRESA</a>
                        </li>
                        <li class="col-6 col-md-auto mr-md-4 mr-lg-5">
                            <a href="https://www.lamborghini.com/es-en">Financials</a>
                        </li>
                        <li class="col-6 col-md-auto mr-md-4 mr-lg-5">
                            <a href="https://www.lamborghini.com/es-en">EMPLEO</a>
                        </li>
                        <li class="col-6 col-md-auto mr-md-4 mr-lg-5">
                            <a href="https://www.lamborghini.com/es-en">CONTACTO</a>
                        </li>
                        <li class="col-6 col-md-auto mr-md-4 mr-lg-5">
                            <a href="https://www.lamborghini.com/es-en">Sostenibilidad</a>
                        </li>
                        <li class="col-6 col-md-auto mr-md-4 mr-lg-5">
                            <a href="https://media.lamborghini.com/english">Media Center</a>
                        </li>
                        <li class="col-6 col-md-auto mr-md-4 mr-lg-5">
                            <a href="https://www.lamborghini.com/es-en">AVISO LEGAL Y PRIVACIDAD</a>
                        </li>
                        <li class="col-6 col-md-auto mr-md-4 mr-lg-5">
                            <a href="https://www.lamborghini.com/es-en">Configuración de cookies</a>
                        </li>
                        <li class="col-6 col-md-auto mr-md-4 mr-lg-5">
                            <a href="https://www.lamborghini.com/es-en">MAPA DEL SITIO</a>
                        </li>
                        <li class="col-6 col-md-auto mr-md-4 mr-lg-5">
                            <a href="https://newsletter.lamborghini.com/en">Newsletter</a>
                        </li>
                        <li class="col-6 col-md-auto mr-md-4 mr-lg-5">
                            <a href="https://www.lamborghini.com/es-en">Accesibilidad</a>
                        </li>
                    </ul>
                </div>
                <div class="order-4 order-md-1 ml-md-auto col-md-auto">
                    <div class="social mt-5 mt-md-0 justify-content-md-end">
                        <div class="col-2 col-md-auto social-instagram">
                            <a href="https://www.instagram.com/lamborghini/?hl=en">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="icon-social">
                                    <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.6 102.7-9 132.1z"></path>
                                </svg>
                            </a>
                        </div>
                        <div class="col-2 col-md-auto social-facebook">
                            <a href="https://www.facebook.com/Lamborghini">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="icon-social">
                                    <path d="M448 56.7c0-31.5-25.7-56.7-57.1-56.7h-334c-31.5 0-57.1 25.7-57.1 56.7v398.6c0 31.5 25.7 56.7 57.1 56.7h334c31.5 0 57.1-25.7 57.1-56.7V56.7zM313.6 459.9c-12.9 0-23.4-10.5-23.4-23.4V275.5h40.6l6.4-47.6h-47c0-15.6 0-29.1 0-41.8 0-10.5 5.3-20.7 14.3-26.3 8.9-5.5 21.4-5.5 31.8 0 10.4 5.6 16.8 15.8 16.8 27.3V227h44.8c3.4 0 6.1 2.5 6.1 5.8l-.2 47.5h-50.7V459c0 12.9-10.5 23.4-23.4 23.4zM148.4 459c-12.9 0-23.4-10.5-23.4-23.4V275.5h40.6l6.4-47.6h-47V149c0-15.6 0-29.1 0-41.8 0-10.5 5.3-20.7 14.3-26.3 8.9-5.5 21.4-5.5 31.8 0 10.4 5.6 16.8 15.8 16.8 27.3V227h44.8c3.4 0 6.1 2.5 6.1 5.8l-.2 47.5h-50.7V459c0 12.9-10.5 23.4-23.4 23.4z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
