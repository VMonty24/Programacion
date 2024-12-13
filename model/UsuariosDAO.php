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
        $stmt->bind_param('s', $email);  // 's' para indicar que el parámetro es una cadena
        
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            // Crea un objeto Usuario sin el id, ya que es generado automáticamente
            $usuario = new Usuario(
                $row['nombre'],        // nombre
                $row['apellidos'],     // apellidos
                $row['password'],      // password
                $row['email'],         // email
                $row['telefono'],      // telefono
                $row['direccion']      // direccion
            );
            return $usuario;  // Retorna el objeto Usuario
        }
        
        return null;  // Retorna null si no se encuentra el usuario
    }
    

    public static function insertarUsuario($usuario) {
    // Realizamos la conexión a la DB
    $con = DataBase::connect();

    // Preparamos la consulta SQL
    $sql = "INSERT INTO users (nombre, apellidos, password, email, telefono, direccion) 
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $con->prepare($sql);
    
    // Enlazamos los parámetros con los tipos correspondientes
    $stmt->bind_param('ssssss', 
        $usuario->getNombre(),
        $usuario->getApellidos(),
        $usuario->getPassword(),
        $usuario->getEmail(),
        $usuario->getTelefono(),
        $usuario->getDireccion(),
        
    );

    // Ejecutamos la consulta
    $result = $stmt->execute();

    $con->close();

    return $result;  // Devuelve true si la inserción fue exitosa
}

}
?>
