<?php

include_once 'config/parameters.php';
include_once("controller/productoController.php");
include_once("controller/usuariosController.php");
include_once("controller/apiController.php");

if (!isset($_GET['controller'])) {
    // Redirigir a la página principal si no se pasa ningún controlador
    header("Location:".url_base."?controller=producto");
} else {
    $controlador = $_GET['controller'].'Controller';
    
    if (class_exists($controlador)) {
        $controller = new $controlador();
        
        if (isset($_GET['action']) && method_exists($controller, $_GET['action'])) {
            $action = $_GET['action'];

            // Verifica si existe el parámetro 'id' en la URL y lo pasa a la acción
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $controller->$action($id);
            } else {
                $controller->$action();
            }
        } else {
            // Llamar al método index si no se especifica una acción válida
            $controller->index();
        } 

    } else {
        // Redirigir a la página principal si el controlador no existe
        header("Location:".url_base."?controller=producto&action=index");
    }
}
?>
