<h1 class="title_page">CARTA</h1>

<div class="container fondo">
    <?php foreach ($productos as $index => $producto): ?>
        <!-- Abrir una nueva fila para el primer producto o después de dos tarjetas -->
        <?php if ($index % 2 === 0): ?>
            <div class="row justify-content-center">
        <?php endif; ?>

        <!-- Generar la tarjeta -->
        <div class="card col-md-12 col-lg-4 m-2">
            <img class="card-img-top" src="<?=$producto->getImage()?>" alt="<?=$producto->getNombre()?>">
            <div class="card-body d-flex justify-content-between">
                <div style="width: 400px;">
                    <h5 class="card-title text-uppercase"><?=$producto->getNombre()?></h5>
                    <p class="card-text"><?=$producto->getDescripcion()?></p>  
                </div>
                
                <div class="icon-container-add">
                    <a href="index.php?controller=Producto&action=addToCart&id=<?= $producto->getId() ?>" style="display: block; width: 100%; height: 100%;">
                        <!-- Icono SVG -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50.464 58.271">
                            <g class="add-boton-stroke" stroke-width="1.5" transform="translate(-1624 -187.923)">
                                <path d="M50.464 43.992L25.732 58.271 1 43.992V15.434L25.732 1.155l24.732 14.279z" transform="translate(1623.5 187.345)"></path>
                                <g transform="translate(627 -5248.5)">
                                    <path class="add-boton" d="M0 0v15" transform="translate(1022.5 5458.5)"></path>
                                    <path class="add-boton" d="M0 0v15" transform="rotate(90 -2218 3248)"></path>
                                </g>
                            </g>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Cerrar la fila después de dos tarjetas -->
        <?php if (($index + 1) % 2 === 0 || $index === count($productos) - 1): ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
