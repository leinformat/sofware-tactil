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
require_once "../models/TableModel.php";

if (isset($_GET['all-tables'])) {
    $tableModel = new TableModel($conexion);
    $result = $tableModel->getTables();

    echo json_encode([
        "success" => (bool)$result,
        "results" => $result
    ]);
}

if (isset($_GET['table'])) {
    $tableModel = new TableModel($conexion);
    $result = $tableModel->getTable($_GET['table']);

    echo json_encode([
        "success" => (bool)$result,
        "result" => $result
    ]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $raw = file_get_contents("php://input");
    $body = json_decode($raw, true);

    $action   = $body['action'] ?? null;
    $table_id = $body['table_id'] ?? null;

    $state = $action === 'openTable' ? 0 : ($action === 'closeTable' ? 1 : null);

    if ($state === null || $table_id === null) {
        http_response_code(400);

        echo json_encode([
            "success" => false,
            "error" => "Invalid action or table_id"
        ]);
        exit;
    }

    $tableModel = new TableModel($conexion);
    $result = $tableModel->handlerTable($table_id, $state);

    if (!$result) {
        http_response_code(500);

        echo json_encode([
            "success" => false,
            "error" => "Database error"
        ]);
        exit;
    }

    http_response_code(200);

    echo json_encode([
        "success" => true
    ]);

    exit;
}