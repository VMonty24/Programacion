<?php
include_once 'model/ProductosDAO.php';
include_once 'model/Producto.php';



class productoController{
    public function index(){
        $views = 'view/html/home.php';
        include_once 'view/main.php';   
    }

    public function carta(){
        $productos = ProductosDAO::getProductos();
        $views = 'view/html/carta.php';
        include_once 'view/main.php';

    }

    public function carrito(){
        session_start();
        $views = 'view/html/carrito.php';
        include_once 'view/main.php';
    }   


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
                    $productoID = $producto->getId();
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
                header("Location: ?controller=Producto&action=carta");
                exit; // Añadir exit después de redirigir para evitar más ejecuciones
            }
        }
    }
    
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
    
    
    public function savePedido() {
        session_start();

        // Verificar si el carrito no está vacío
        if (empty($_SESSION['carrito'])) {
            echo "El carrito está vacío.";
            return;
        }
    
        // Obtener el número de tarjeta desde el formulario
        $numeroPago = $_POST['numero-tarjeta'];
    
        // Calcular el total del pedido
        $total = 0;
        foreach ($_SESSION['carrito'] as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }
    
        // Obtener el ID del usuario si está autenticado, si no, será null
        $idUser = null;
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $idUser = $usuario->getId(); // Usamos el ID del usuario autenticado
        }
    
        // Guardar el pedido en la base de datos
        ProductosDAO::insertarPedido($idUser, $total, $numeroPago);
    
        // Vaciar el carrito después de guardar el pedido
        $_SESSION['carrito'] = [];
    
        // Redirigir o mostrar mensaje de éxito
        echo "Pedido realizado con éxito.";
        header('Location: ?controller=producto&action=index');
        exit();
    }
    
    
    
    
    

}