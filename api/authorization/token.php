<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json');

require '../dao/UsuariosDao.class.php';
$datos = UsuariosDao::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, TRUE);

    $correcto = true;
    $datosIncorrectos = " hacen falta campos";
    if (empty($input['email']) || empty($input['password'])) {
        $correcto = false;
    }

    if($correcto){

        $result = $datos->validarUsuario($input['email'],$input['password']);
        if(empty($result)){
            $response["mensaje"] = "Unauthorized";
            $response["code"] = 401;
            http_response_code(401);
            echo json_encode($response);
        }else{
            $response = $result[0];
            http_response_code(200);
            echo json_encode($response);
        }

    } else {
        $response["mensaje"] = "Bad request";
        $response["resultado"] = $datosIncorrectos;
        $response["code"] = 400;
        http_response_code(400);
        echo json_encode($response);
    }
} else {
    $response["mensaje"] = "Method Not Allowed";
    $response["code"] = 405;
    http_response_code(405);
    echo json_encode($response);
}
?>