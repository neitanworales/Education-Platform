<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    return 0;
}

require '../dao/SchoolDao.class.php';
$datos = SchoolDao::getInstance();

$curso_id = $_GET['curso_id'];
$tema_id = $_GET['tema_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $correcto = true;
    $datosIncorrectos = "Hace falta: curso_id o tema_id";
    if (empty($curso_id) || empty($tema_id)) {
        $correcto = false;
    }

    if ($correcto) {
        if (!$datos->validarCursoTema($curso_id, $tema_id)) {
            $response["mensaje"] = "Este curso ya tiene asignado este tema";
            $response["code"] = 400;
            http_response_code(400);
            echo json_encode($response);
        } else {
            $response['success'] = $datos->agregarTema($curso_id, $tema_id);
            $response["mensaje"] = "Ok";
            $response["code"] = 201;
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
} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $correcto = true;
    $datosIncorrectos = "Hace falta: curso_id o tema_id";
    if (empty($curso_id) || empty($tema_id)) {
        $correcto = false;
    }

    if ($correcto) {
        $id = $_GET['id'];
        $response['success'] = $datos->quitarTema($curso_id, $tema_id);
        $response["mensaje"] = "Ok";
        $response["code"] = 200;
        http_response_code(200);
        echo json_encode($response);
    } else {
        $response["mensaje"] = "Bad request";
        $response["resultado"] = $datosIncorrectos;
        $response["code"] = 400;
        http_response_code(400);
        echo json_encode($response);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!empty($curso_id)) {
        $response['temas'] = $datos->obtenerTemasByCurso($curso_id);
        $response["mensaje"] = "Ok";
        $response["code"] = 200;
        http_response_code(200);
        echo json_encode($response);
    } else if (!empty($tema_id)) {
        $response['cursos'] = $datos->obtenerCursosBtTema($tema_id);
        $response["mensaje"] = "Ok";
        $response["code"] = 200;
        http_response_code(200);
        echo json_encode($response);
    } else {
        $response["mensaje"] = "Se necesita curso_id o tema_id";
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