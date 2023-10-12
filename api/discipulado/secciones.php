<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json');

require '../dao/DiscipuladoDao.class.php';
$datos=DiscipuladoDao::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $response['resultado']=$datos->getSecciones();
    $response["mensaje"]="Ok";
    echo json_encode($response);
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response["mensaje"]="Vamos a agregar";
    echo json_encode($response);
} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $response["mensaje"]="Vamos a actualizar";
    echo json_encode($response);
} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $response["mensaje"]="Vamos a borrar";
    echo json_encode($response);
}

?>