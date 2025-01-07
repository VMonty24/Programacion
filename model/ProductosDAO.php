<?php
include_once 'config/dataBase.php';
include_once 'model/Producto.php';

class ProductosDAO {

    // Método para obtener todos los productos de la base de datos
    public static function getProductos() {
        // Realizamos la conexión a la DB
        $con = DataBase::connect();
        
        // Preparamos la consulta SQL    
        $stmt = $con->prepare("SELECT * FROM productos");

        // Ejecutamos la consulta
        $stmt->execute();
        $result = $stmt->get_result();

        // Creamos el array donde almacenaremos los datos que encontremos con fetch
        $productos = [];
        
        // Bucle para recopilar los datos con fetch
        while ($producto = $result->fetch_object("Producto")) {
            $productos[] = $producto;
        }
        
        // Cerramos la conexión a la DB
        $con->close();

        // Retornamos el array de productos
        return $productos;
    }

    // Método para obtener un producto por su ID
    public static function getProductoById($id) {
        // Realizamos la conexión a la DB
        $con = DataBase::connect();
        
        // Preparamos la consulta SQL
        $stmt = $con->prepare("SELECT * FROM productos WHERE id = ?");
        $stmt->bind_param("i", $id);  // Asociar el parámetro al id
    
        // Ejecutamos la consulta
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Obtener el producto si existe
        if ($producto = $result->fetch_object("Producto")) {
            // Cerramos la conexión a la DB
            $con->close();
            return $producto;
        }
    
        // Cerramos la conexión a la DB
        $con->close();
        return null; // Retorna null si no se encuentra el producto
    }

    // Método para insertar un nuevo pedido en la base de datos
    public static function insertarPedido($idUser, $total, $numeroPago) {
        // Realizamos la conexión a la DB
        $con = DataBase::connect();
        
        // Preparamos la consulta SQL
        $sql = "INSERT INTO pedidos (id_usuario, total, metodo_pago, fecha) VALUES (?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        
        // Obtener la fecha actual con hora
        $fecha = date('Y-m-d H:i:s');
        
        // Asociar los parámetros a la consulta
        $stmt->bind_param('idss', $idUser, $total, $numeroPago, $fecha); // 'i' para ID, 'd' para decimal, 's' para string
    
        // Ejecutamos la consulta
        $resultado = $stmt->execute();
        
        // Cerramos el statement y la conexión a la DB
        $stmt->close();
        $con->close();
    
        // Retornamos el resultado de la ejecución
        return $resultado;
    }

}
