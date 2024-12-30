<?php
include_once 'config/dataBase.php';
include_once 'model/Usuario.php';

class UsuariosDAO {

    public static function obtenerPorEmail($email) {
        // Conectarse a la base de datos
        $con = DataBase::connect();
        
        // Consulta para obtener el usuario por su correo
        $sql = "SELECT * FROM users WHERE email = ?";
        
        $stmt = $con->prepare($sql);
        $stmt->bind_param('s', $email);  // 's' para indicar que el parámetro es un string
        
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            // Crea un objeto Usuario
            $usuario = new Usuario(
          
                $row['nombre'],      
                $row['apellidos'],   
                $row['password'],      
                $row['email'],         
            );

            $usuario->setId($row['id']);  // Asigna el id al objeto Usuario
            $usuario->setTelefono($row['telefono']);  // Asigna el teléfono al objeto Usuario
            $usuario->setDireccion($row['direccion']);  // Asigna la dirección al objeto Usuario

            return $usuario;  // Retorna el objeto Usuario
        }
        
        return null;  // Retorna null si no se encuentra el usuario
    }
    
    public static function checkEmail($email) {
        $con = DataBase::connect();
        $sql = "SELECT COUNT(*) as total FROM users WHERE email = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total'] > 0; // Devuelve true si el email existe
    }
    
    


    public static function insertarUsuario($usuario) {
    // Realizamos la conexión a la DB
    $con = DataBase::connect();

    // Preparamos la consulta SQL
    $sql = "INSERT INTO users (nombre, apellidos, password, email) 
            VALUES (?, ?, ?, ?)";

    $stmt = $con->prepare($sql);
    
    // Enlazamos los parámetros con los tipos correspondientes
    $stmt->bind_param('ssss', 
        $usuario->getNombre(),
        $usuario->getApellidos(),
        $usuario->getPassword(),
        $usuario->getEmail()
       
    );

    // Ejecutamos la consulta
    $result = $stmt->execute();

    $con->close();

    return $result;  // Devuelve true si la inserción fue exitosa
}


//borrar si no se usa, coo ahora
public static function obtenerIdPorEmail($email) {
    // Conectarse a la base de datos
    $con = DataBase::connect();
    
    // Consulta para obtener el id del usuario por su correo
    $sql = "SELECT id FROM users WHERE email = ?";
    
    $stmt = $con->prepare($sql);
    $stmt->bind_param('s', $email);  // 's' para indicar que el parámetro es un string
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        return $row['id'];  // Retorna el id del usuario
    }
    
    return null;  // Retorna null si no se encuentra el usuario
}



public static function actualizarUsuario($usuario) {
    // Realizamos la conexión a la DB
    $con = DataBase::connect();

    // Preparamos la consulta SQL
    $sql = "UPDATE users SET nombre = ?, apellidos = ?, telefono = ?, direccion = ? WHERE id = ?";

    $stmt = $con->prepare($sql);
    
    // Enlazamos los parámetros con los tipos correspondientes
    $stmt->bind_param('ssssi', 
        $usuario->getNombre(),
        $usuario->getApellidos(),
        $usuario->getTelefono(),
        $usuario->getDireccion(),
        $usuario->getId()
    );

    // Ejecutamos la consulta
    $result = $stmt->execute();

    $con->close();

    return $result;  // Devuelve true si la actualización fue exitosa   
    }

}
?>
