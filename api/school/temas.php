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
        $response['resultado'] = $datos->getTemas();
        $response["mensaje"] = "Ok";
        $response["code"] = 200;
        http_response_code(200);
        echo json_encode($response);
    } else {
        $response['resultado'] = $datos->getTemasById($id);
        $response["mensaje"] = "Ok";
        $response["code"] = 200;
        http_response_code(200);
        echo json_encode($response);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, TRUE);

    $correcto = true;
    $datosIncorrectos = " Hace falta: titulo o presentador";
    if (empty($input['titulo']) || empty($input['presentador'])) {
        $correcto = false;
    }

    if ($correcto) {

        $titulo = !empty($input['titulo']) ? $input['titulo'] : null;
        $descripcion = !empty($input['descripcion']) ? $input['descripcion'] : null;
        $presentador = !empty($input['presentador']) ? $input['presentador'] : null;
        $categoria = !empty($input['categoria']) ? $input['categoria'] : null;

        if ($datos->guardarTema($titulo, $descripcion, $presentador, $categoria)) {
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
    $titulo = !empty($input['titulo']) ? $input['titulo'] : null;
    $descripcion = !empty($input['descripcion']) ? $input['descripcion'] : null;
    $presentador = !empty($input['presentador']) ? $input['presentador'] : null;
    $categoria = !empty($input['categoria']) ? $input['categoria'] : null;
    $estatus = !empty($input['estatus']) ? $input['estatus'] : null;

    if ($datos->actualizarTema($id, $titulo, $descripcion, $presentador, $categoria, $estatus)) {
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
    $response['success'] = $datos->desactivarTema($id);
    $response["mensaje"] = "Ok";
    $response["code"] = 200;
    http_response_code(200);
    echo json_encode($response);
}

?>