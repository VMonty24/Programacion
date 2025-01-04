<?php

include_once 'config/parameters.php';
include_once("controller/productoController.php");
include_once("controller/usuariosController.php");
include_once("controller/apiController.php");

if (!isset($_GET['controller'])) {
    // Si no se pasa nada mostraré la página principal
    header("Location:".url_base."?controller=producto");
} else {
    $controlador = $_GET['controller'].'Controller';
    
    if (class_exists($controlador)) {
        $controller = new $controlador();
        
        if (isset($_GET['action']) && method_exists($controller, $_GET['action'])) {
            $action = $_GET['action'];

            // Verifica si existe el parámetro 'id' en la URL
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $controller->$action($id);  // Pasar 'id' a la acción
            } else {
                $controller->$action();  // Si no existe 'id', llamar sin el parámetro
            }
        } else {
            $controller->index();
        } 

    } else {
        header("Location:".url_base."?controller=producto&action=index");
    }
}
?>
