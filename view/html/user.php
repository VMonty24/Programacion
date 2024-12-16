<div class="container">
    <h1>Mi Perfil</h1>

    <form action="?controller=usuarios&action=actualizarPerfil" method="POST">
        <div class="form-group">
            <label for="nombre_apellidos">Nombre y Apellidos</label>
            <input type="text" id="nombre_apellidos" name="nombre_apellidos" class="form-control" 
                   value="<?= htmlspecialchars($usuario->getNombre() . ' ' . $usuario->getApellidos()) ?>" required>
        </div>
        
        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" class="form-control" 
                   value="<?= htmlspecialchars($usuario->getEmail()) ?>" readonly>
        </div>
        
        <div class="form-group">
            <label for="password">Nueva Contraseña</label>
            <input type="password" id="password" name="password" class="form-control">
            <small>Deja en blanco si no quieres cambiar la contraseña.</small>
        </div>
        
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
