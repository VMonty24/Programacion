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
}