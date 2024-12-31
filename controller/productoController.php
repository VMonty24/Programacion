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
    
    public function calcTotal() {
        $total = 0;
        if (isset($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $item) {
                $total += $item['precio'] * $item['cantidad'];
            }
        }

        //Aplicar ofertas a usuarios
        if (isset($_SESSION['usuario'])){
            $descuento = 0;
            $diaActual = date('N'); // Devuelve el día de la semana (1: lunes, 7: domingo)
            if ($diaActual == 4) { // Jueves es 4
                $descuento += $total * 0.10;
            }
        
            // Aplicar descuento para nuevos usuarios (-25%)
            if (isset($_SESSION['usuario']) && method_exists($_SESSION['usuario'], 'getId')) {
                $usuarioId = $_SESSION['usuario']->getId();
                $esNuevoUsuario = UsuariosDAO::contarPedidos($usuarioId); // Crear método para verificar esto
                if ($esNuevoUsuario === 0) {
                    $descuento += $total * 0.25;
                }
            }

            $total -= $descuento;

        }

        

        return $total;
    }
 
    
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


