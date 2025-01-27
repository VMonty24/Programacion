<?php

include_once 'config/dataBase.php';

class apiController {

    // LOGS
    // Function to log actions
    function putLogs($action, $data) {
        $logFile = 'api/logs.log';
        $timestamp = date("Y-m-d H:i:s");
        $logMessage = "[$timestamp] Action: $action, Data: " . json_encode($data) . "\n";

        file_put_contents($logFile, $logMessage, FILE_APPEND);
    }

    // Function to retrieve logs
    function getLogs() {
        $logFile = 'api/logs.log';

        if (file_exists($logFile)) {
            $logs = file_get_contents($logFile);

            if ($logs !== false) {
                header('Content-Type: application/json');
                echo json_encode(array('status' => 'success', 'logs' => $logs));
            } else {
                header('Content-Type: application/json');
                echo json_encode(array('status' => 'error', 'message' => 'No se pudo leer el archivo de logs.'));
            }
        } else {
            header('Content-Type: application/json');
            echo json_encode(array('status' => 'error', 'message' => 'No se encontró el archivo de logs.'));
        }
    }

    // Function to delete logs
    function deleteLogs() {
        $logFile = 'api/logs.log';

        if (file_put_contents($logFile, '') !== false) {
            header('Content-Type: application/json');
            echo json_encode(array('status' => 'success', 'message' => 'Logs eliminados correctamente.'));
        } else {
            header('Content-Type: application/json');
            echo json_encode(array('status' => 'error', 'message' => 'No se pudo eliminar el archivo de logs.'));
        }
    }

    // FUNCIONES PRODUCTOS 
    // Function to get all products
    function getProductos() {
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM productos");
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

    // Function to delete a product by ID
    function deleteProducto($id) {
        $con = DataBase::connect();
        $oldData = $con->query("SELECT * FROM productos WHERE id = $id")->fetch_assoc();

        $stmt = $con->prepare("DELETE FROM productos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $this->putLogs("deleteProducto", $oldData);
            $response = array('status' => 'success', 'message' => 'Producto eliminado correctamente.');
        } else {
            $this->putLogs("ERROR deleteProducto", array('id: ' . $id));
            $response = array('status' => 'error', 'message' => 'No se pudo eliminar el producto.');
        }

        $con->close();

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // Function to get a product by ID
    function getProductoById($id) {
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM productos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $producto = $result->fetch_assoc();
        $con->close();

        header('Content-Type: application/json');
        echo json_encode($producto);
    }

    // Function to update a product
    function updateProducto() {
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['id'], $data['nombre'], $data['descripcion'], $data['precio'], $data['categoria'], $data['image'])) {
            $con = DataBase::connect();
            $oldData = $con->query("SELECT * FROM productos WHERE id = $data[id]")->fetch_assoc();

            $stmt = $con->prepare("UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, categoria = ?, image = ? WHERE id = ?");
            $stmt->bind_param("ssdssi", $data['nombre'], $data['descripcion'], $data['precio'], $data['categoria'], $data['image'], $data['id']);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $response = array('status' => 'success', 'message' => 'Producto actualizado correctamente.');
                $this->putLogs("updateProducto", array('oldData: ' => $oldData));
            } else {
                $response = array('status' => 'error', 'message' => 'No se pudo actualizar el producto.');
                $this->putLogs("Error updateProducto", array($data));
            }

            $con->close();
        } else {
            $response = array('status' => 'error', 'message' => 'Datos incompletos.');
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // Function to create a new product
    function createProducto() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['nombre'], $data['descripcion'], $data['precio'], $data['categoria'], $data['image'])) {
            $con = DataBase::connect();
            $stmt = $con->prepare("INSERT INTO productos (nombre, descripcion, precio, categoria, image) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssdss", $data['nombre'], $data['descripcion'], $data['precio'], $data['categoria'], $data['image']);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $this->putLogs("createProducto", array('id: ' . $data['id']));
                $response = array('status' => 'success', 'message' => 'Producto creado correctamente.');
            } else {
                $this->putLogs("Error createProducto", array($data));
                $response = array('status' => 'error', 'message' => 'No se pudo crear el producto.');
            }

            $con->close();
        } else {
            $response = array('status' => 'error', 'message' => 'Datos incompletos.');
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // FUNCIONES USUARIOS
    // Function to get all users
    function getUsuarios() {
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM users");
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

    // Function to delete a user by ID
    function deleteUsuario($id) {
        $con = DataBase::connect();
        $oldData = $con->query("SELECT * FROM users WHERE id = $id")->fetch_assoc();

        $stmt = $con->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $response = array('status' => 'success', 'message' => 'Usuario eliminado correctamente.');
            $this->putLogs("deleteUsuario", $oldData);
        } else {
            $response = array('status' => 'error', 'message' => 'No se pudo eliminar el usuario.');
            $this->putLogs("ERROR deleteUsuario", array('id: ' . $id));
        }

        $con->close();

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // Function to get a user by ID
    function getUsuarioById($id) {
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $usuario = $result->fetch_assoc();
        $con->close();

        header('Content-Type: application/json');
        echo json_encode($usuario);
    }

    // Function to update a user
    function updateUsuario() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['id'], $data['nombre'], $data['apellidos'], $data['password'], $data['email'], $data['telefono'], $data['direccion'])) {
            $con = DataBase::connect();
            $oldData = $con->query("SELECT * FROM users WHERE id = $data[id]")->fetch_assoc();

            $stmt = $con->prepare("UPDATE users SET nombre = ?, apellidos = ?, password = ?, email = ?, telefono = ?, direccion = ? WHERE id = ?");
            $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
            $stmt->bind_param("ssssssi", $data['nombre'], $data['apellidos'], $hashedPassword, $data['email'], $data['telefono'], $data['direccion'], $data['id']);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $response = array('status' => 'success', 'message' => 'Usuario actualizado correctamente.');
                $this->putLogs("updateUsuario", array('oldData: ' => $oldData));
            } else {
                $response = array('status' => 'error', 'message' => 'No se pudo actualizar el usuario.');
                $this->putLogs("Error updateUsuario", array($data));
            }

            $con->close();
        } else {
            $response = array('status' => 'error', 'message' => 'Datos incompletos.');
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // Function to create a new user
    function createUsuario() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['nombre'], $data['apellidos'], $data['password'], $data['email'], $data['telefono'], $data['direccion'])) {
            $con = DataBase::connect();
            $stmt = $con->prepare("INSERT INTO users (nombre, apellidos, password, email, telefono, direccion) VALUES (?, ?, ?, ?, ?, ?)");
            $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
            $stmt->bind_param("ssssss", $data['nombre'], $data['apellidos'], $hashedPassword, $data['email'], $data['telefono'], $data['direccion']);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $this->putLogs("createUsuario", array('id: ' . $data['email']));
                $response = array('status' => 'success', 'message' => 'Usuario creado correctamente.');
            } else {
                $this->putLogs("Error createUsuario", array($data));
                $response = array('status' => 'error', 'message' => 'No se pudo crear el usuario.');
            }

            $con->close();
        } else {
            $response = array('status' => 'error', 'message' => 'Datos incompletos.');
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // FUNCIONES PEDIDOS
    // Function to get all orders with optional sorting
    function getPedidos() {
        $accion = $_GET['order'] ?? null;

        switch ($accion) {
            case 'userAsc':
                $orderBy = 'id_usuario ASC';
                break;
            case 'userDesc':
                $orderBy = 'id_usuario DESC';
                break;
            case 'totalAsc':
                $orderBy = 'total ASC';
                break;
            case 'totalDesc':
                $orderBy = 'total DESC';
                break;
            case 'fechaAsc':
                $orderBy = 'fecha ASC';
                break;
            case 'fechaDesc':
                $orderBy = 'fecha DESC';
                break;
            default:
                $orderBy = 'id ASC';
                break;
        }

        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM pedidos ORDER BY $orderBy");
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

    // Function to delete an order by ID
    function deletePedido($id) {
        $con = DataBase::connect();
        $oldData = $con->query("SELECT * FROM pedidos WHERE id = $id")->fetch_assoc();

        $stmt = $con->prepare("DELETE FROM pedidos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $this->putLogs("deletePedido", $oldData);
            $response = array('status' => 'success', 'message' => 'Pedido eliminado correctamente.');
        } else {
            $this->putLogs("ERROR deletePedido", array('id: ' . $id));
            $response = array('status' => 'error', 'message' => 'No se pudo eliminar el pedido.');
        }

        $con->close();

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // Function to get an order by ID
    function getPedidoById($id) {
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM pedidos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $pedido = $result->fetch_assoc();
        $con->close();

        header('Content-Type: application/json');
        echo json_encode($pedido);
    }

    // Function to update an order
    function updatePedido() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['id'], $data['id_usuario'], $data['total'], $data['metodo_pago'], $data['fecha'])) {
            $con = DataBase::connect();
            $oldData = $con->query("SELECT * FROM pedidos WHERE id = $data[id]")->fetch_assoc();

            $stmt = $con->prepare("UPDATE pedidos SET id_usuario = ?, total = ?, metodo_pago = ?, fecha = ? WHERE id = ?");
            $stmt->bind_param("idssi", $data['id_usuario'], $data['total'], $data['metodo_pago'], $data['fecha'], $data['id']);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $response = array('status' => 'success', 'message' => 'Pedido actualizado correctamente.');
                $this->putLogs("updatePedido", array('oldData:' => $oldData));
            } else {
                $response = array('status' => 'error', 'message' => 'No se pudo actualizar el pedido.');
                $this->putLogs("Error updatePedido", array($data));
            }

            $con->close();
        } else {
            $response = array('status' => 'error', 'message' => 'Datos incompletos.');
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // Function to create a new order
    function createPedido() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['total'], $data['metodo_pago'], $data['fecha'])) {
            $con = DataBase::connect();
            $stmt = $con->prepare("INSERT INTO pedidos (id_usuario, total, metodo_pago, fecha) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("idss", $data['id_usuario'], $data['total'], $data['metodo_pago'], $data['fecha']);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $response = array('status' => 'success', 'message' => 'Pedido creado correctamente.');
                $this->putLogs("createPedido", array('id_usuario: ' . $data['id_usuario']));
            } else {
                $response = array('status' => 'error', 'message' => 'No se pudo crear el pedido.');
                $this->putLogs("Error createPedido", array($data));
            }

            $con->close();
            $stmt->close();
        } else {
            $response = array('status' => 'error', 'message' => 'Datos incompletos.');
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
