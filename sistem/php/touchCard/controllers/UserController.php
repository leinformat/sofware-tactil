<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, PATCH, DELETE");
header("Content-Type: application/json");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

require_once "../../conexion.php";
require_once "../models/UserModel.php";

if (isset($_GET['user'])) {
    $model = new UserModel($conexion);
    $result = $model->getById($_SESSION['id_usu']);

    echo json_encode([
        "success" => (bool)$result,
        "result" => $result
    ]);
}