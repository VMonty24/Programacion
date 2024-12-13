<?php


include_once 'config/parameters.php';
include_once("controller/productoController.php");
include_once("controller/usuariosController.php");


if(!isset($_GET['controller'])){
    //Si no se pasa nada mostraré la página principal
    header("Location:".url_base."?controller=producto");
}else{
    $controlador = $_GET['controller'].'Controller';
    if(class_exists($controlador)){
        $controller = new $controlador();
        
        if(isset($_GET['action'])&&method_exists($controller, $_GET['action'])){
            $action = $_GET['action'];
            $controller->$action();
        }else{
            $controller->index();
        } 

    }else{
        header("Location:".url_base."producto/");
    }
}
?>