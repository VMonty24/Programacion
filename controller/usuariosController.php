<?php

include_once 'model/UsuariosDAO.php';
include_once 'model/Usuario.php';

class usuariosController {

    // Muestra la vista de login y registro
    public function login() {
        $views = 'view/html/login-register.php';
        include_once 'view/main.php';
    }

    // Muestra el panel de administración si el usuario es admin
    public function admin() {
        session_start();
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            if ($usuario->getNombre() === 'admin') {
                include_once 'api/admin_panel.html';
            }
        } else {
            header('Location: ?controller=usuarios&action=login');
        }
    }

    // Muestra los detalles del usuario
    public function userDetails() {
        session_start();
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            if ($usuario->getNombre() === 'admin') {
                header('Location: ?controller=usuarios&action=admin');
            } else {
                $pedido = UsuariosDAO::getUltimoPedido($usuario->getId());
                $views = 'view/html/user.php';
                include_once 'view/main.php';
            }
        } else {
            header('Location: ?controller=usuarios&action=login');
        }
    }

    // Procesa el login del usuario
    public function doLogin() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $usuario = UsuariosDAO::obtenerPorEmail($email);

            if ($usuario && password_verify($password, $usuario->getPassword())) {
                if ($email === 'admin@admin.com') {
                    $_SESSION['usuario'] = $usuario;
                    header('Location: ?controller=usuarios&action=admin');
                    exit();
                } else {
                    $_SESSION['usuario'] = $usuario;
                    header('Location: ?controller=producto&action=index');
                    exit();
                }
            } else {
                echo '<script>alert("Correo o contraseña incorrectos.");</script>';
                $this->login();
            }
        }
    }

    // Procesa el registro del usuario
    public function doRegister() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Capturar el campo de nombre completo
            $nombre_apellidos = $_POST['nombre_apellidos'];

            // Dividir en nombre y apellidos
            $partes = explode(' ', $nombre_apellidos, 2);
            $nombre = $partes[0];
            $apellidos = isset($partes[1]) ? $partes[1] : '';

            // Capturar los demás datos del formulario
            $email = $_POST['email'];

            // Comprobar si el email ya existe
            if (UsuariosDAO::checkEmail($email)) {
                echo '<script>alert("El email ya está registrado.");</script>';
                $this->login();
                return;
            }

            // Continuar con el registro
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $usuario = new Usuario($nombre, $apellidos, $password, $email);
            $exito = UsuariosDAO::insertarUsuario($usuario);

            if ($exito === true) {
                session_start();
                $_SESSION['usuario'] = $usuario;
                header("Location: ?controller=producto");
                exit();
            } else {
                echo '<script>alert("Hubo un problema al registrar el usuario.");</script>';
                $views = 'view/html/register.php';
                include_once 'view/main.php';
            }
        }
    }

    // Cierra la sesión del usuario
    public function logout() {
        session_start();
        session_destroy();
        header('Location: ?controller=producto');
        session_start();
        $_SESSION['mensaje'] = "Session cerrada con exito.";
    }

    // Actualiza los datos del usuario
    public function actualizarUsuario() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = $_SESSION['usuario'];
            $usuario->setNombre($_POST['nombre']);
            $usuario->setApellidos($_POST['apellidos']);
            $usuario->setTelefono($_POST['telefono']);
            $usuario->setDireccion($_POST['direccion']);

            $exito = UsuariosDAO::actualizarUsuario($usuario);

            if ($exito === true) {
                $_SESSION['usuario'] = $usuario;
                $_SESSION['mensaje'] = "Datos actualizados con exito.";
                header('Location: ?controller=producto');
                exit();
            } else {
                $_SESSION['mensaje'] = "Hubo un problema al actualizar el perfil.";
                $this->userDetails();
            }
        }
    }

    // Redirige a la página de carta si el usuario ha iniciado sesión y sino al loging
    public function redirectOfertas() {
        session_start();
        if (isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])) {
            header('Location: ?controller=producto&action=carta');
        } else {
            header('Location: ?controller=usuarios&action=login');
        }
    }

}
