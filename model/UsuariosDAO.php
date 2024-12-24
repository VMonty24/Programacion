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
                $row['id'],
                $row['nombre'],      
                $row['apellidos'],   
                $row['password'],      
                $row['email'],         
            );
            return $usuario;  // Retorna el objeto Usuario
        }
        
        return null;  // Retorna null si no se encuentra el usuario
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

}
?>
