<?php

include_once 'config/dataBase.php';

class apiController {

    //FUNCIONES PRODUCTOS 
    function getProductos() {
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM RESTAURANTE.productos");
        $stmt->execute();
        $result = $stmt->get_result();

        $productos = [];
        while ($producto = $result->fetch_assoc()) {
            $productos[] = $producto;
        }
        $con->close();
    
        header('Content-Type: application/json');
        echo json_encode($productos);
    }

    function deleteProducto($id) {
        $con = DataBase::connect();
        $stmt = $con->prepare("DELETE FROM RESTAURANTE.productos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        

        if ($stmt->affected_rows > 0) {
            $response = array('status' => 'success', 'message' => 'Producto eliminado correctamente.');
        } else {
            $response = array('status' => 'error', 'message' => 'No se pudo eliminar el producto.');
        }

        $con->close();
    
        header('Content-Type: application/json');
        echo json_encode($response);
    }


    function getProductoById($id) {
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM RESTAURANTE.productos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $producto = $result->fetch_assoc();
        $con->close();
        
        header('Content-Type: application/json');
        echo json_encode($producto);
    }
    

    function updateProducto() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['id'], $data['nombre'], $data['descripcion'], $data['precio'], $data['categoria'], $data['image'])) {
            $con = DataBase::connect();
            $stmt = $con->prepare("UPDATE RESTAURANTE.productos SET nombre = ?, descripcion = ?, precio = ?, categoria = ?, image = ? WHERE id = ?");
            $stmt->bind_param("ssdssi", $data['nombre'], $data['descripcion'], $data['precio'], $data['categoria'], $data['image'], $data['id']);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $response = array('status' => 'success', 'message' => 'Producto actualizado correctamente.');
            } else {
                $response = array('status' => 'error', 'message' => 'No se pudo actualizar el producto.');
            }

            $con->close();
        } else {
            $response = array('status' => 'error', 'message' => 'Datos incompletos.');
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function createProducto() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['nombre'], $data['descripcion'], $data['precio'], $data['categoria'], $data['image'])) {
            $con = DataBase::connect();
            $stmt = $con->prepare("INSERT INTO RESTAURANTE.productos (nombre, descripcion, precio, categoria, image) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssdss", $data['nombre'], $data['descripcion'], $data['precio'], $data['categoria'], $data['image']);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $response = array('status' => 'success', 'message' => 'Producto creado correctamente.');
            } else {
                $response = array('status' => 'error', 'message' => 'No se pudo crear el producto.');
            }

            $con->close();
        } else {
            $response = array('status' => 'error', 'message' => 'Datos incompletos.');
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
            



    //FUNCIONES USUARIOS

    function getUsuarios() {
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM RESTAURANTE.users");
        $stmt->execute();
        $result = $stmt->get_result();

        $usuarios = [];
        while ($usuario = $result->fetch_assoc()) {
            $usuarios[] = $usuario;
        }
        $con->close();
    
        header('Content-Type: application/json');
        echo json_encode($usuarios);
    }


    function deleteUsuario($id) {
        $con = DataBase::connect();
        $stmt = $con->prepare("DELETE FROM RESTAURANTE.users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $response = array('status' => 'success', 'message' => 'Usuario eliminado correctamente.');
        } else {
            $response = array('status' => 'error', 'message' => 'No se pudo eliminar el usuario.');
        }

        $con->close();

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function getUsuarioById($id) {
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM RESTAURANTE.users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $usuario = $result->fetch_assoc();
        $con->close();

        header('Content-Type: application/json');
        echo json_encode($usuario);
    }

    function updateUsuario() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['id'], $data['nombre'], $data['apellidos'], $data['password'], $data['email'], $data['telefono'], $data['direccion'])) {
            $con = DataBase::connect();
            $stmt = $con->prepare("UPDATE RESTAURANTE.users SET nombre = ?, apellidos = ?, password = ?, email = ?, telefono = ?, direccion = ? WHERE id = ?");
            $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
            $stmt->bind_param("ssssssi", $data['nombre'], $data['apellidos'], $hashedPassword, $data['email'], $data['telefono'], $data['direccion'], $data['id']);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $response = array('status' => 'success', 'message' => 'Usuario actualizado correctamente.');
            } else {
                $response = array('status' => 'error', 'message' => 'No se pudo actualizar el usuario.');
            }

            $con->close();
        } else {
            $response = array('status' => 'error', 'message' => 'Datos incompletos.');
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function createUsuario() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['nombre'], $data['apellidos'], $data['password'], $data['email'], $data['telefono'], $data['direccion'])) {
            $con = DataBase::connect();
            $stmt = $con->prepare("INSERT INTO RESTAURANTE.users (nombre, apellidos, password, email, telefono, direccion) VALUES (?, ?, ?, ?, ?, ?)");
            $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
            $stmt->bind_param("ssssss", $data['nombre'], $data['apellidos'], $hashedPassword, $data['email'], $data['telefono'], $data['direccion']);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $response = array('status' => 'success', 'message' => 'Usuario creado correctamente.');
            } else {
                $response = array('status' => 'error', 'message' => 'No se pudo crear el usuario.');
            }

            $con->close();
        } else {
            $response = array('status' => 'error', 'message' => 'Datos incompletos.');
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }




    // FUNCINES PEDIDOS
    function getPedidos() {
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM RESTAURANTE.pedidos");
        $stmt->execute();
        $result = $stmt->get_result();

        $pedidos = [];
        while ($pedido = $result->fetch_assoc()) {
            $pedidos[] = $pedido;
        }
        $con->close();

        header('Content-Type: application/json');
        echo json_encode($pedidos);
    }

    function deletePedido($id) {
        $con = DataBase::connect();
        $stmt = $con->prepare("DELETE FROM RESTAURANTE.pedidos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $response = array('status' => 'success', 'message' => 'Pedido eliminado correctamente.');
        } else {
            $response = array('status' => 'error', 'message' => 'No se pudo eliminar el pedido.');
        }

        $con->close();

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function getPedidoById($id) {
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM RESTAURANTE.pedidos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $pedido = $result->fetch_assoc();
        $con->close();

        header('Content-Type: application/json');
        echo json_encode($pedido);
    }

    function updatePedido() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['id'], $data['id_usuario'], $data['total'], $data['metodo_pago'], $data['fecha'])) {
            $con = DataBase::connect();
            $stmt = $con->prepare("UPDATE RESTAURANTE.pedidos SET id_usuario = ?, total = ?, metodo_pago = ?, fecha = ? WHERE id = ?");
            $stmt->bind_param("idssi", $data['id_usuario'], $data['total'], $data['metodo_pago'], $data['fecha'], $data['id']);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $response = array('status' => 'success', 'message' => 'Pedido actualizado correctamente.');
            } else {
                $response = array('status' => 'error', 'message' => 'No se pudo actualizar el pedido.');
            }

            $con->close();
        } else {
            $response = array('status' => 'error', 'message' => 'Datos incompletos.');
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function createPedido() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['id_usuario'], $data['total'], $data['metodo_pago'], $data['fecha'])) {
            $con = DataBase::connect();
            $stmt = $con->prepare("INSERT INTO RESTAURANTE.pedidos (id_usuario, total, metodo_pago, fecha) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("idss", $data['id_usuario'], $data['total'], $data['metodo_pago'], $data['fecha']);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $response = array('status' => 'success', 'message' => 'Pedido creado correctamente.');
            } else {
                $response = array('status' => 'error', 'message' => 'No se pudo crear el pedido.');
            }

            $con->close();
        } else {
            $response = array('status' => 'error', 'message' => 'Datos incompletos.');
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
