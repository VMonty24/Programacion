<?php?>

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
    
    <!-- Contenido colapsable -->
    <div class="collapse navbar-collapse" id="navbarContent">
      
        <!-- Logo -->
      <a class="col-1" href="?controller=producto">
        <img src="view/images/logo_black.svg" class="logo" alt="Sushi one logo">
      </a>
      
      <!-- Botón de colapso para pantallas pequeñas -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>


      <!-- Menú de navegación -->
      <ul class="navbar-nav ms-4 col-md-5 d-flex flex-row align-items-center">
        <li class="nav-item me-4">
          <a class="nav-link" href="?controller=producto">INICIO</a>
        </li>
        <li class="nav-item me-4">
          <a class="nav-link" href="?controller=producto&action=carta">CARTA</a>
        </li>
        <li class="nav-item me-4">
          <a class="nav-link" href="#">LOCALES</a>
        </li>
      </ul>

      <!-- Botón de pedido -->
      <div class="col-md-2 d-flex flex-end justify-content-end align-items-center col-2">
        <a href="#" class="btn-1">EMPEZAR PEDIDO</a>
      </div>
      
      <!-- Iconos -->
      <div class="col-md-4 d-flex justify-content-end align-items-center icon-nav">
        <a class="nav-item me-4" href="#">
          <img src="view/images/iconos/icono_session_blanco.png" class="icono" alt="lupa">
        </a>
        <a class="nav-item me-4" href="#">
          <img src="view/images/iconos/icono_carrito_blanco.png" class="icono" alt="carrito">
        </a>
        <a class="nav-item me-4" href="#">
          <img src="view/images/iconos/icono_session_blanco.png" class="icono" alt="user">
        </a>
      </div>
      
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
            <ul class="footer-menu text-uppercase ">
              <li class="col-6 col-md-auto mr-md-4 mr-lg-5">
                <a href="/es-en/la-empresa">EMPRESA</a>
              </li>
              <li class="col-6 col-md-auto mr-md-4 mr-lg-5">
                <a href="/es-en/financials">Financials</a>
              </li>
              <li class="col-6 col-md-auto mr-md-4 mr-lg-5">
                <a href="/es-en/empleo">EMPLEO</a>
              </li>
              <li class="col-6 col-md-auto mr-md-4 mr-lg-5">
                <a href="/es-en/contacto">CONTACTO</a>
              </li>
              <li class="col-6 col-md-auto mr-md-4 mr-lg-5">
                <a href="/es-en/sostenibilidad">Sostenibilidad</a>
              </li>
              <li class="col-6 col-md-auto mr-md-4 mr-lg-5">
                <a href="https://media.lamborghini.com/english">Media Center</a>
              </li>
              <li class="col-6 col-md-auto mr-md-4 mr-lg-5">
                <a href="/es-en/privacy-legal">AVISO LEGAL Y PRIVACIDAD</a>
              </li>
              <li class="col-6 col-md-auto mr-md-4 mr-lg-5">
                <a href="#onetrust-settings">Configuración de cookies</a>
              </li>
              <li class="col-6 col-md-auto mr-md-4 mr-lg-5">
                <a href="/es-en/mapa-del-sitio">MAPA DEL SITIO</a>
              </li>
              <li class="col-6 col-md-auto mr-md-4 mr-lg-5">
                <a href="https://newsletter.lamborghini.com/en">Newsletter</a>
              </li>
              <li class="col-6 col-md-auto mr-md-4 mr-lg-5">
                <a href="/es-en/accesibilidad">Accesibilidad</a>
              </li>
            </ul>
          </div>
          <div class="order-4 order-md-1 ml-md-auto col-md-auto">
            <div class="social mt-5 mt-md-0 justify-content-md-end">
              <div class="col-2 col-md-auto social-instagram">
                <a href="https://www.instagram.com/lamborghini/?hl=en">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="icon-social">
                    <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/>
                  </svg>
                </a>
              </div>
              <div class="col-2 col-md-auto social-threads">
                <a href="https://www.threads.net/@lamborghini">
                  <svg aria-label="Threads" viewBox="0 0 192 192" xmlns="http://www.w3.org/2000/svg" class="icon-social">
                    <path class="x19hqcy" d="M141.537 88.9883C140.71 88.5919 139.87 88.2104 139.019 87.8451C137.537 60.5382 122.616 44.905 97.5619 44.745C97.4484 44.7443 97.3355 44.7443 97.222 44.7443C82.2364 44.7443 69.7731 51.1409 62.102 62.7807L75.881 72.2328C81.6116 63.5383 90.6052 61.6848 97.2286 61.6848C97.3051 61.6848 97.3819 61.6848 97.4576 61.6855C105.707 61.7381 111.932 64.1366 115.961 68.814C118.893 72.2193 120.854 76.925 121.825 82.8638C114.511 81.6207 106.601 81.2385 98.145 81.7233C74.3247 83.0954 59.0111 96.9879 60.0396 116.292C60.5615 126.084 65.4397 134.508 73.775 140.011C80.8224 144.663 89.899 146.938 99.3323 146.423C111.79 145.74 121.563 140.987 128.381 132.296C133.559 125.696 136.834 117.143 138.28 106.366C144.217 109.949 148.617 114.664 151.047 120.332C155.179 129.967 155.42 145.8 142.501 158.708C131.182 170.016 117.576 174.908 97.0135 175.059C74.2042 174.89 56.9538 167.575 45.7381 153.317C35.2355 139.966 29.8077 120.682 29.6052 96C29.8077 71.3178 35.2355 52.0336 45.7381 38.6827C56.9538 24.4249 74.2039 17.11 97.0132 16.9405C119.988 17.1113 137.539 24.4614 149.184 38.788C154.894 45.8136 159.199 54.6488 162.037 64.9503L178.184 60.6422C174.744 47.9622 169.331 37.0357 161.965 27.974C147.036 9.60668 125.202 0.195148 97.0695 0H96.9569C68.8816 0.19447 47.2921 9.6418 32.7883 28.0793C19.8819 44.4864 13.2244 67.3157 13.0007 95.9325L13 96L13.0007 96.0675C13.2244 124.684 19.8819 147.514 32.7883 163.921C47.2921 182.358 68.8816 191.806 96.9569 192H97.0695C122.03 191.827 139.624 185.292 154.118 170.811C173.081 151.866 172.51 128.119 166.26 113.541C161.776 103.087 153.227 94.5962 141.537 88.9883ZM98.4405 129.507C88.0005 130.095 77.1544 125.409 76.6196 115.372C76.2232 107.93 81.9158 99.626 99.0812 98.6368C101.047 98.5234 102.976 98.468 104.871 98.468C111.106 98.468 116.939 99.0737 122.242 100.233C120.264 124.935 108.662 128.946 98.4405 129.507Z"></path>
                  </svg>
                </a>
              </div>
              <div class="col-2 col-md-auto social-facebook">
                <a href="https://www.facebook.com/Lamborghini/">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="icon-social">
                    <path d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z"/>
                  </svg>
                </a>
              </div>
              <div class="col-2 col-md-auto social-youtube">
                <a href="https://www.youtube.com/channel/UC9DXZC8BCDOW6pYAQKgozqw">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="icon-social">
                  <path d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z"/>
                  </svg>
                </a>
              </div>
              <div class="col-2 col-md-auto social-twitter">
                <a href="https://twitter.com/Lamborghini">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="icon-social">
                    <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/>
                  </svg>
                </a>
              </div>
              <div class="col-2 col-md-auto social-tiktok">
                <a href="https://www.tiktok.com/@lamborghini?lang=en">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="icon-social">
                    <path d="M448 209.9a210.1 210.1 0 0 1 -122.8-39.3V349.4A162.6 162.6 0 1 1 185 188.3V278.2a74.6 74.6 0 1 0 52.2 71.2V0l88 0a121.2 121.2 0 0 0 1.9 22.2h0A122.2 122.2 0 0 0 381 102.4a121.4 121.4 0 0 0 67 20.1z"/>
                  </svg>
                </a>
              </div>
              <div class="col-2 col-md-auto social-linkedin">
                <a href="https://www.linkedin.com/company/automobili-lamborghini-s-p-a-">  
                  <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="icon-social">
                    <path style="display: inline; fill-rule: evenodd; clip-rule: evenodd;" d="M116.504,500.219V170.654H6.975v329.564H116.504L116.504,500.219z M61.751,125.674c38.183,0,61.968-25.328,61.968-56.953c-0.722-32.328-23.785-56.941-61.252-56.941C24.994,11.781,0.5,36.394,0.5,68.722c0,31.625,23.772,56.953,60.53,56.953H61.751L61.751,125.674z M177.124,500.219c0,0,1.437-298.643,0-329.564H286.67v47.794h-0.727c14.404-22.49,40.354-55.533,99.44-55.533c72.085,0,126.116,47.103,126.116,148.333v188.971H401.971V323.912c0-44.301-15.848-74.531-55.497-74.531c-30.254,0-48.284,20.38-56.202,40.08c-2.897,7.012-3.602,16.861-3.602,26.711v184.047H177.124L177.124,500.219z">
                    </path>
                  </svg>
                </a>
              </div>
              <div class="col-2 col-md-auto social-discord">
                <a href="https://discord.com/invite/lamborghini">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="icon-social">
                    <path d="M524.5 69.8a1.5 1.5 0 0 0 -.8-.7A485.1 485.1 0 0 0 404.1 32a1.8 1.8 0 0 0 -1.9 .9 337.5 337.5 0 0 0 -14.9 30.6 447.8 447.8 0 0 0 -134.4 0 309.5 309.5 0 0 0 -15.1-30.6 1.9 1.9 0 0 0 -1.9-.9A483.7 483.7 0 0 0 116.1 69.1a1.7 1.7 0 0 0 -.8 .7C39.1 183.7 18.2 294.7 28.4 404.4a2 2 0 0 0 .8 1.4A487.7 487.7 0 0 0 176 479.9a1.9 1.9 0 0 0 2.1-.7A348.2 348.2 0 0 0 208.1 430.4a1.9 1.9 0 0 0 -1-2.6 321.2 321.2 0 0 1 -45.9-21.9 1.9 1.9 0 0 1 -.2-3.1c3.1-2.3 6.2-4.7 9.1-7.1a1.8 1.8 0 0 1 1.9-.3c96.2 43.9 200.4 43.9 295.5 0a1.8 1.8 0 0 1 1.9 .2c2.9 2.4 6 4.9 9.1 7.2a1.9 1.9 0 0 1 -.2 3.1 301.4 301.4 0 0 1 -45.9 21.8 1.9 1.9 0 0 0 -1 2.6 391.1 391.1 0 0 0 30 48.8 1.9 1.9 0 0 0 2.1 .7A486 486 0 0 0 610.7 405.7a1.9 1.9 0 0 0 .8-1.4C623.7 277.6 590.9 167.5 524.5 69.8zM222.5 337.6c-29 0-52.8-26.6-52.8-59.2S193.1 219.1 222.5 219.1c29.7 0 53.3 26.8 52.8 59.2C275.3 311 251.9 337.6 222.5 337.6zm195.4 0c-29 0-52.8-26.6-52.8-59.2S388.4 219.1 417.9 219.1c29.7 0 53.3 26.8 52.8 59.2C470.7 311 447.5 337.6 417.9 337.6z"/>
                  </svg>
                </a>
              </div>
            </div>
          </div>
          <div class="order-2 col-12">
            <ul class="disclaimer align-self-md-end">
              <li><p>Los valores de consumos y emisiones presentes en el sitio web se refieren a su IP geográfica. Dicho valor podría diferir de la realidad si navega a través de una VPN o si la ubicación de su proveedor de Internet no es exacta. Si cree que no está geolocalizado correctamente, contacte con su concesionario de referencia para obtener información válida en su territorio sobre consumos y emisiones.</p>
              </li>
            </ul>
          </div>
          <div class="order-3 col-12">
            <div class="body">
              <p>Copyright © 2024 Automobili Lamborghini S.p.A. una sociedad de accionista único sujeta a la dirección y coordinación de AUDI AG.</p>
              <p>Todos los derechos reservados. Núm. IVA IT 00591801204</p>
              <p></p>
              <p>AVISO SOBRE OFERTAS ILEGALES DE SUPUESTAS ACCIONES DE AUTOMOBILI LAMBORGHINI S.P.A.</p>
              <p>Automobili Lamborghini S.p.A. ha tenido noticia de que varios terceros de diferentes países están presuntamente ofreciendo acciones de Automobili Lamborghini S.p.A. Estas ofertas son ilegales y no provienen ni de Volkswagen Aktiengesellschaft ni de ninguna de sus filiales.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  


  <!--BOOTSTRAP-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>  
</body>
</html>

