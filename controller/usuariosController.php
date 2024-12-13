<?php

include_once 'model/UsuariosDAO.php';
include_once 'model/Usuario.php';

class usuariosController {

    public function login() {
        $views = 'view/html/login.php';
        include_once 'view/main.php';
    }

    public function register() {
        $views = 'view/html/register.php';
        include_once 'view/main.php';
    }

    public function doLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            $usuario = UsuariosDAO::obtenerPorEmail($email);
    
            if ($usuario && password_verify($password, $usuario->getPassword())) {
                session_start();
                $_SESSION['usuario'] = $usuario;
                // Verifica que la sesión se haya iniciado correctamente
                error_log('Usuario autenticado: ' . $_SESSION['usuario']->getEmail());
                header('Location: ?controller=producto&action=index');
                exit();
            } else {
                echo 'Correo o contraseña incorrectos.';
                $views = 'view/html/login.php';
                include_once 'view/main.php';
            }
        }
    }
    
    
    public function doRegister() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'] ?? '';
            $direccion = $_POST['direccion'] ?? '';
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
            // Crear un objeto Usuario
            $usuario = new Usuario($nombre, $apellidos, $password, $email, $telefono, $direccion);
    
            // Llamar al método para insertar el usuario en la base de datos
            $exito = UsuariosDAO::insertarUsuario($usuario);
    
            if ($exito = true) {
                header('Location: ?controller=usuarios&action=login');
                exit();  // Redirige al login si el registro fue exitoso
            } else {
                $error = 'Hubo un problema al registrar el usuario.';
                $views = 'view/html/register.php';
                include_once 'view/main.php';
            }
        }
    }
    

}
?>
