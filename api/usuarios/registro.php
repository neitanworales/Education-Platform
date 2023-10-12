<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json');

require '../dao/UsuariosDao.class.php';
$datos=UsuariosDao::getInstance();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response["mensaje"]="Se requiere POST";
    $response["code"]=400;
    echo json_encode($response);
}

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

$correcto = true;

if(empty($input['nombre']) || empty($input['email'])){
    $correcto = false;
}

if($correcto){
    $nombre = !empty($input['nombre'])?$input['nombre']:null;
    $email = !empty($input['email'])?$input['email']:null;
    $apellidos = !empty($input['apellidos'])?$input['apellidos']:null;

    $busqueda = $datos->getUsuarioByEmail($email);
    if(!empty($busqueda)){
        $response["mensaje"]="Ya existe un usuario con ese correo";
        $response["code"]=400;
        echo json_encode($response);
    } else {
        if($datos->registarUsuario($nombre, $apellidos, $email)){
            $response["mensaje"]="Guardado correctamente";
            $response["code"]=201;
            echo json_encode($response);
        }else{
            $response["mensaje"]="Ocurrió algún error al guardar";
            $response["code"]=500;
            echo json_encode($response);
        }
    }
} else {
    $response["mensaje"]="Datos incorrectos";
    $response["code"]=400;
    echo json_encode($response);
}
?>