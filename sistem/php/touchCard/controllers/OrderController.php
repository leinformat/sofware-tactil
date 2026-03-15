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
require_once "../models/OrderModel.php";

if (isset($_GET['table'])) {
    $orderModel = new OrderModel($conexion);
    $result = $orderModel->getById($_GET['table']);

    echo json_encode([
        "success" => (bool)$result,
        "result" => $result
    ]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $raw = file_get_contents("php://input");
    $body = json_decode($raw, true);

    $action = $body['action'] ?? null;

    $orderModel = new OrderModel($conexion);

    switch ($action) {

        case 'create-order':

            $tableId = $body['tableId'] ?? null;
            $ticketId = $body['ticketId'] ?? null;
            $userId = $_SESSION['id_usu'] ?? null;

            $result = $orderModel->create($tableId, $userId);
            http_response_code(201);
            
            echo json_encode(["success" => (bool)$result, "result" => $result]);
            break;

        case 'update-order':
            // open/paid/cacelled
            $id = $body['id'] ?? null;
            $state = $body['state'] ?? null;
            $subTotal = $body['subTotal'] ?? null;
            $vatTotal = $body['vatTotal'] ?? null;
            $total = $body['total'] ?? null;
            $paymentMethod = $body['paymentMethod'] ?? null;

            $result = $orderModel->setState($id, $state, $subTotal, $vatTotal,$paymentMethod,$total);
            http_response_code(201);
            
            echo json_encode(["success" => (bool)$result, "result" => $result]);
            break;

        default:
            http_response_code(400);
            echo json_encode(["error" => "Invalid action"]);
    }

    exit;
}