<?php
// Verificar si el carrito está definido y no está vacío
$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];

$resultados = productoController::calcTotal();
$total = $resultados['total'];
$descuento = $resultados['descuento'];
$oferta = $resultados['oferta'];
?>

<div class="figura">
  <p class="texto">HOME / CARRITO</p>
</div>

<h1 class="title_page">CARRITO</h1>

<div class="cart-container">
  <?php if (!empty($carrito)): ?>
    <?php foreach ($carrito as $item): ?>
      <!-- Producto dinámico -->
      <div class="cart-item">
        <div class="item-info">
          <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="Imagen del producto">
          <div class="item-details">
            <h3><?php echo htmlspecialchars($item['nombre']); ?></h3>
            <p><?php echo htmlspecialchars($item['descripcion']); ?></p>
          </div>
        </div>
        <div class="item-actions">
          <button class="btn btn-outline-light btn-sm" onclick="window.location.href='?controller=Producto&action=removeFromCart&id=<?php echo $item['id']; ?>'">-</button>
          <span>x<?php echo $item['cantidad']; ?></span>
          <button class="btn btn-outline-light btn-sm" onclick="window.location.href='?controller=Producto&action=addToCart&id=<?php echo $item['id']; ?>'">+</button>
          <p class="item-price"><?php echo number_format($item['precio'] * $item['cantidad'], 2); ?>€</p>
        </div>
      </div>
      <!-- Línea de separación -->
      <hr class="separator">
    <?php endforeach; ?>

    <!-- Coste Total -->
    <div class="cart-total">
      <?php if ($descuento > 0): ?>
        <p>DESCUENTO APLICADO
          <span><?php echo '-' . $oferta . '%  = ' .  number_format($descuento,2) . '€'; ?></span>
        </p>
      <?php endif; ?>

      <?php
      $suma = array_sum(array_map(function($item) {
        return $item['precio'] * $item['cantidad'];
      }, $_SESSION['carrito']));

      if ($total != $suma): ?>
        <p>PRECIO SIN DESCUENTO
          <span><?php echo number_format($suma, 2) . '€'; ?></span>
        </p>
      <?php endif; ?>

      <p>COSTE TOTAL DEL PEDIDO
        <span><?php echo number_format($total, 2) . '€'; ?></span>
      </p>
    </div>
  <?php else: ?>
    <p style="text-align: center; color: #fff;">El carrito está vacío.</p>
  <?php endif; ?>
</div>

<div class="payment-section">
  <h2>DATOS DE ENVIO</h2>
  <form method="POST" action="?controller=Producto&action=savePedido">
    <div class="form-row">
      <div class="input-group">
        <label for="nombre">NOMBRE:</label>
        <input type="text" id="nombre" name="nombre" required>
      </div>
      <div class="input-group">
        <label for="telefono">TELEFONO:</label>
        <input type="text" id="telefono" name="telefono" required>
      </div>
    </div>
    <div class="form-row">
      <div class="input-group">
        <label for="correo">CORREO:</label>
        <input type="email" id="correo" name="correo" required>
      </div>
      <div class="input-group">
        <label for="direccion">DIRECCION:</label>
        <input type="text" id="direccion" name="direccion" required>
      </div>
    </div>

    <h2>METODO DE PAGO</h2>
    <div class="form-row">
      <div class="input-group">
        <label for="numero-tarjeta">NUMERO TARJETA:</label>
        <input type="text" id="numero-tarjeta" name="numero-tarjeta" required>
      </div>
      <div class="input-group">
        <label for="fecha-caducidad">FECHA CADUCIDAD:</label>
        <input type="text" id="fecha-caducidad" name="fecha-caducidad" required>
      </div>
    </div>
    <div class="form-row">
      <div class="input-group">
        <label for="cvv">CVV:</label>
        <input type="text" id="cvv" name="cvv" required>
      </div>
    </div>
    <button class="btn-pay" type="submit">Enviar</button>
  </form>
</div>

