<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, PATCH, DELETE");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

require_once "../../conexion.php";
require_once "../models/CompanyModel.php";

if (isset($_GET['company'])) {
    $model = new CompanyModel($conexion);
    $result = $model->retrive();

    echo json_encode([
        "success" => (bool)$result,
        "result" => $result
    ]);
}