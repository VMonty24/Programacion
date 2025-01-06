<div class="figura">
  <p class="texto">HOME / USER</p>
</div>

<div class="perfil-container">
    <h1 class="perfil-titulo">Mi Perfil</h1>
    <form action="?controller=usuarios&action=actualizarUsuario" method="POST" class="perfil-formulario">
        <div class="perfil-campo">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($usuario->getNombre()) ?>" required>
        </div>
        <div class="perfil-campo">
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" value="<?= htmlspecialchars($usuario->getApellidos()) ?>" required>
        </div>
        <div class="perfil-campo">
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" value="<?= htmlspecialchars($usuario->getTelefono()) ?>" required>
        </div>
        <div class="perfil-campo">
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" value="<?= htmlspecialchars($usuario->getDireccion()) ?>" required>
        </div>
        <div class="perfil-campo">
            <button type="submit" class="perfil-boton">Actualizar Perfil</button>
        </div>
    </form>

    <?php if (isset($pedido)): ?>
        <div class="ultimo-pedido">
            <h3>Último Pedido</h3>
            <p><strong>Fecha:</strong> <?= htmlspecialchars($pedido->fecha) ?></p>
            <p><strong>Tarjeta:</strong> <?= htmlspecialchars($pedido->metodo_pago) ?></p>
            <p><strong>Total:</strong> <?= htmlspecialchars($pedido->total) ?> €</p>
        </div>
    <?php else: ?>
        <p>No has realizado ningún pedido aún.</p>
    <?php endif; ?>
</div>


