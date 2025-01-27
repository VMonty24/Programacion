<?php
include_once 'model/ProductosDAO.php';
include_once 'model/Producto.php';

class productoController {
    // Método para mostrar la página principal
    public function index() {
        $views = 'view/html/home.php';
        include_once 'view/main.php';
    }

    // Método para mostrar la carta de productos
    public function carta() {
        $productos = ProductosDAO::getProductos();
        $views = 'view/html/carta.php';
        include_once 'view/main.php';
    }

    // Método para mostrar el carrito de compras
    public function carrito() {
        session_start();
        $views = 'view/html/carrito.php';
        include_once 'view/main.php';
    }

    // Método para agregar un producto al carrito
    public function addToCart() {
        session_start();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Obtener el producto por su ID desde el modelo
            $producto = ProductosDAO::getProductoById($id);

            if ($producto) { // Solo agregar si se encuentra el producto
                // Iniciar carrito si no está definido
                if (!isset($_SESSION['carrito'])) {
                    $_SESSION['carrito'] = [];
                }

                // Comprobar si el producto ya está en el carrito
                $found = false;
                foreach ($_SESSION['carrito'] as &$item) {
                    if ($item['id'] === (int)$producto->getId()) {
                        // Si ya está en el carrito, incrementar la cantidad
                        $item['cantidad']++;
                        $found = true;
                        break;
                    }
                }

                // Si el producto no está en el carrito, agregarlo como un array
                if (!$found) {
                    $_SESSION['carrito'][] = [
                        'id' => $producto->getId(),
                        'nombre' => $producto->getNombre(),
                        'descripcion' => $producto->getDescripcion(),
                        'precio' => $producto->getPrecio(),
                        'image' => $producto->getImage(),
                        'cantidad' => 1 // Inicializamos la cantidad en 1
                    ];
                }

                // Redirigir a la carta
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit; // Añadir exit después de redirigir para evitar más ejecuciones
            }
        }
    }

    // Método para eliminar un producto del carrito
    public function removeFromCart() {
        session_start();

        if (isset($_GET['id'])) {
            $id = (int) $_GET['id'];

            // Comprobar si el carrito está definido
            if (isset($_SESSION['carrito'])) {
                foreach ($_SESSION['carrito'] as $key => &$item) {
                    if ($item['id'] === $id) {
                        $item['cantidad']--;

                        // Eliminar el producto si la cantidad llega a 0
                        if ($item['cantidad'] <= 0) {
                            unset($_SESSION['carrito'][$key]);
                        }
                        break;
                    }
                }
                // Reindexar el array del carrito
                $_SESSION['carrito'] = array_values($_SESSION['carrito']);
            }
        }

        // Redirigir de vuelta al carrito
        header("Location: ?controller=Producto&action=carrito");
        exit;
    }

    // Método para calcular el total del carrito con descuentos aplicados
    public function calcTotal() {
        $total = 0;
        $descuento = 0;
        $oferta = 0;
        $oferta2 = 0;

        if (isset($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $item) {
                $total += $item['precio'] * $item['cantidad'];
            }
        }

        // Aplicar ofertas solo para usuarios
        if (isset($_SESSION['usuario'])) {

            // Aplicar descuento de los jueves
            $diaActual = date('N'); // Devuelve el día de la semana (1: lunes, 7: domingo)
            if ($diaActual == 4) {
                $oferta = UsuariosDAO::getOfertas(1);
                $oferta = $oferta['descuento_porcentaje'];
                $descuento += $total *  $oferta / 100;
            }

            // Aplicar descuento para nuevos usuarios
            if (isset($_SESSION['usuario']) && method_exists($_SESSION['usuario'], 'getId')) {
                $usuarioId = $_SESSION['usuario']->getId();
                $esNuevoUsuario = UsuariosDAO::contarPedidos($usuarioId);
                if ($esNuevoUsuario === 0) {
                    $oferta2 = UsuariosDAO::getOfertas(2);
                    $oferta2 = $oferta2['descuento_porcentaje'];
                    $descuento += $total *  $oferta2 / 100;
                }
            }

            $total -= $descuento;
            $oferta += $oferta2;
        }

        return [
            'total' => $total,
            'descuento' => $descuento,
            'oferta' => $oferta
        ];
    }

    // Método para guardar un pedido
    public function savePedido() {
        session_start();
        // Verificar si el carrito no está vacío
        if (empty($_SESSION['carrito'])) {
            echo "El carrito está vacío. Por favor, añade productos antes de realizar un pedido.";
            return;
        }

        // Obtener el número de tarjeta desde el formulario
        $numeroPago = $_POST['numero-tarjeta'];

        // Calcular el total del pedido usando el método calcTotal
        $total = $this->calcTotal();
        $total = $total['total'];

        // Obtener el ID del usuario si está autenticado, si no, será null (para pedidos de invitados)
        $idUser = null;
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];

            // Asegurarse de que el objeto usuario tiene un método para obtener el ID
            if (method_exists($usuario, 'getId')) {
                $idUser = $usuario->getId();
            }
        }

        // Guardar el pedido en la base de datos
        $pedidoExitoso = ProductosDAO::insertarPedido($idUser, $total, $numeroPago);

        // Verificar si el pedido se guardó con éxito
        if ($pedidoExitoso) {
            // Vaciar el carrito después de guardar el pedido
            $_SESSION['carrito'] = [];

            // Redirigir
            header('Location: ?controller=producto&action=index');
            exit();
        } else {
            echo "<script>alert('Hubo un problema al guardar el pedido. Por favor, inténtalo de nuevo.');</script>";
            $this->carrito();
        }
    }
}
