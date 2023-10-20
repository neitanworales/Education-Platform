<?php
header("Access-Control-Allow-Origin: *");   
header("Content-Type: application/json; charset=UTF-8");    
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE OPTIONS");    
header("Access-Control-Max-Age: 3600");    
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); 

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {    
    return 0;    
}

require '../dao/SchoolDao.class.php';
$datos = SchoolDao::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];
    if (empty($id)) {
        $response['resultado'] = $datos->getCursos();
        $response["mensaje"] = "Ok";
        $response["code"] = 200;
        http_response_code(200);
        echo json_encode($response);
    } else {
        $response['resultado'] = $datos->getCursosById($id);
        $response["mensaje"] = "Ok";
        $response["code"] = 200;
        http_response_code(200);
        echo json_encode($response);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, TRUE);

    $correcto = true;
    $datosIncorrectos = " Hace falta: nombre";
    if (empty($input['nombre'])) {
        $correcto = false;
    }

    if ($correcto) {

        $nombre = !empty($input['nombre']) ? $input['nombre'] : null;
        $descripcion = !empty($input['descripcion']) ? $input['descripcion'] : null;
        $instructor = !empty($input['instructor']) ? $input['instructor'] : null;
        $fecha_inicio = !empty($input['fecha_inicio']) ? $input['fecha_inicio'] : null;
        $fecha_fin = !empty($input['fecha_fin']) ? $input['fecha_fin'] : null;
        $cupo_maximo = !empty($input['cupo_maximo']) ? $input['cupo_maximo'] : null;
        $precio = !empty($input['precio']) ? $input['precio'] : null;
        $nivel = !empty($input['nivel']) ? $input['nivel'] : null;
        $categoria = !empty($input['categoria']) ? $input['categoria'] : null;

        if ($datos->guardarCurso($nombre, $descripcion, $instructor, $fecha_inicio, $fecha_fin, $cupo_maximo, $precio, $nivel, $categoria)) {
            $response["mensaje"] = "Guardado correctamente";
            $response["code"] = 201;
            http_response_code(201);
            echo json_encode($response);
        } else {
            $response["mensaje"] = "Ocurrió algún error al guardar";
            $response["code"] = 500;
            http_response_code(500);
            echo json_encode($response);
        }
    } else {
        $response["mensaje"] = "Bad request";
        $response["resultado"] = $datosIncorrectos;
        $response["code"] = 400;
        http_response_code(400);
        echo json_encode($response);
    }

} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, TRUE);

    $id = !empty($input['id']) ? $input['id'] : null;
    $nombre = !empty($input['nombre']) ? $input['nombre'] : null;
    $descripcion = !empty($input['descripcion']) ? $input['descripcion'] : null;
    $instructor = !empty($input['instructor']) ? $input['instructor'] : null;
    $fecha_inicio = !empty($input['fecha_inicio']) ? $input['fecha_inicio'] : null;
    $fecha_fin = !empty($input['fecha_fin']) ? $input['fecha_fin'] : null;
    $cupo_maximo = !empty($input['cupo_maximo']) ? $input['cupo_maximo'] : null;
    $precio = !empty($input['precio']) ? $input['precio'] : null;
    $nivel = !empty($input['nivel']) ? $input['nivel'] : null;
    $categoria = !empty($input['categoria']) ? $input['categoria'] : null;
    $estatus = !empty($input['estatus']) ? $input['estatus'] : null;

    if ($datos->actualizarCurso($id, $nombre, $descripcion, $instructor, $fecha_inicio, $fecha_fin, $cupo_maximo, $precio, $nivel, $categoria, $estatus)) {
        $response["mensaje"] = "Guardado correctamente";
        $response["code"] = 200;
        http_response_code(200);
        echo json_encode($response);
    } else {
        $response["mensaje"] = "Ocurrió algún error al guardar";
        $response["code"] = 500;
        http_response_code(500);
        echo json_encode($response);
    }

} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET['id'];
    $response['success'] = $datos->desactivarCurso($id);
    $response["mensaje"] = "Ok";
    $response["code"] = 200;
    http_response_code(200);
    echo json_encode($response);
}

?>