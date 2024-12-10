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
                    $_SESSION['carrito'] = array();
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
                    $_SESSION['carrito'][] = array(
                        'id' => $producto->getId(),          
                        'nombre' => $producto->getNombre(),
                        'descripcion' => $producto->getDescripcion(),
                        'precio' => $producto->getPrecio(),
                        'image' => $producto->getImage(),
                        'cantidad' => 1 // Inicializamos la cantidad en 1
                    );
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
    
    
    
    
    

}