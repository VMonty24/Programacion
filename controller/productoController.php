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

}