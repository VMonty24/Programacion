<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$users = [
    ['id' => 1,'nombre' => 'Juan Perez', 'edad' => '15'],
    ['id' => 2,'nombre' => 'Nicolas Sancho', 'edad' => '18']
];

$metodo = $_SERVER['REQUEST_METHOD'];

switch($metodo){
    case 'GET':
        if(isset($_GET['id'])){
            $existe = false;
            foreach($users as $user){
                if($user['id'] == $_GET['id']){
                    echo json_encode([
                        'estado' => 'Exito',
                        'data' => $user
                    ]);
                    $existe = true;
                    break;
                }
            }

            if($existe == false){
                http_response_code(404);
                echo json_encode([
                    'estado' => 'Fallido',
                    'data' => 'No hay datos'
                ]);
            }

        }else{
            echo json_encode([
                'estado' => 'Exito',
                'data' => $users
            ]);
        }
    break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);

        //insert
        array_push($users,
            ['id' => 3,'nombre' => $data["nombre"], 'edad' => '19']
        );

        echo json_encode([
            'estado' => 'Exito',
            'data' => 'insertado correctamente'
        ]);
    break;

}