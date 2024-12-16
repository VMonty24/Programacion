<?php
include_once 'config/dataBase.php';
include_once 'model/Producto.php';

class ProductosDAO{

    public static function getProductos(){
        //Realizamos la conexión a la DB
        $con = DataBase::connect();
        //Preparamos la consulta SQL    
        $stmt = $con->prepare("Select * from RESTAURANTE.productos");

        //Ejecutamos la consulta
        $stmt->execute();
        $result = $stmt->get_result();

        //Creamos el array donde almacenaremos los datos que encontremos con fetch
        $productos = [];
        //Bucle para recopilar los datos con fetch
        while ($producto = $result->fetch_object("Producto")) {
            $productos[] = $producto;
        }
        $con->close();

        return $productos;
    }

    public static function getProductoById($id) {
        // Realizamos la conexión a la DB
        $con = DataBase::connect();
        
        // Preparamos la consulta SQL
        $stmt = $con->prepare("SELECT * FROM RESTAURANTE.productos WHERE id = ?");
        $stmt->bind_param("i", $id);  // Asociar el parámetro al id
    
        // Ejecutamos la consulta
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Obtener el producto si existe
        if ($producto = $result->fetch_object("Producto")) {
            $con->close();
            return $producto;
        }
    
        $con->close();
        return null; // Retorna null si no se encuentra el producto
    }


    public static function guardarProducto($producto) {
        // Realizamos la conexión a la DB
        $con = DataBase::connect();
    
        // Preparamos la consulta SQL
        $sql = "INSERT INTO RESTAURANTE.pedidos (nombre, descripcion, precio, imagen) 
                VALUES (?, ?, ?, ?)";
    

    }
    

}