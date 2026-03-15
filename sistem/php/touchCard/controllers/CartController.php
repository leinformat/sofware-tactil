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
require_once "../models/CartModel.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $raw = file_get_contents("php://input");
    $body = json_decode($raw, true);

    $action = $body['action'] ?? null;

    $cart = new CartModel($conexion);

    switch ($action) {

        case 'add-product':

            $idProduct = $body['productId'] ?? null;
            $price     = $body['price'] ?? null;
            $quantity  = $body['quantity'] ?? 1;
            $tableId   = $body['tableId'] ?? null;
            $ticketId  = $body['ticketId'] ?? null;
            $userId = $_SESSION['id_usu'] ?? null;
            $clientId = $_SESSION['id_cliente'] ?? 0;

            $hasItem = $cart->getCartItem($idProduct, $tableId);

            if ($hasItem) {
                $result = $cart->updateCartItem(
                    $hasItem['id_salida'],
                    $idProduct,
                    $hasItem['cantidad'] + 1,
                    $price,
                    0,
                    $ticketId,
                    $tableId
                );
            } else {
                $result = $cart->insertProduct(
                    $idProduct,
                    $quantity,
                    $price,
                    0,
                    $ticketId,
                    $tableId,
                    $userId,
                    $clientId
                );
            }

            echo json_encode(["success" => (bool)$result]);
            break;

        case 'empty-cart':
            $result = $cart->emptyCart($body['table_id']);
            http_response_code(201);
            echo json_encode($result);

            break;
        
        case 'save-cart':
            $result = $cart->saveCart($body['table_id']);
            http_response_code(201);
            echo json_encode($result);

            break;
        default:
            http_response_code(400);
            echo json_encode(["error" => "Invalid action"]);
    }

    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['ticket-id'])) {
    $cart = new CartModel($conexion);
    $result = $cart->getTicketId();

    echo json_encode([
        "success" => (bool)$result,
        "ticketId" => $result
    ]);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['cart'])) {
    $cart = new CartModel($conexion);
    $result = $cart->getCart($_GET['cart']);

    $data = $result->fetch_all(MYSQLI_ASSOC);

    echo json_encode([
        "success" => (bool)$result,
        "cart" => $data
    ]);
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

    $raw = file_get_contents("php://input");
    $body = json_decode($raw, true);

    $itemId  = $body['itemId']      ?? null;
    $quantity = $body['quantity']     ?? null;

    $cart = new CartModel($conexion);

    if ($quantity > 0) {
        $result = $cart->updateItemAmount(
            $quantity,
            $itemId
        );

        echo json_encode([
            "success" => (bool)$result,
            "message" => $result
        ]);
    } else {
        $result = $cart->deleteItem(
            $itemId
        );

        echo json_encode([
            "success" => (bool)$result,
        ]);
    }
}

// Guardar venta y vaciar el carrito
else if(isset($_POST['save-sale'])){
    $bjetoGuardarCarrito = new Carrito;
    $guardarCarriro = $bjetoGuardarCarrito->guardarCarrito();

    $data = json_encode($guardarCarriro);
    print($data);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $input = json_decode(file_get_contents("php://input"), true);

    $carrito = new Carrito();
    $resultado = $carrito->guardarCarrito($input);

    http_response_code(201);

    echo json_encode([
        "success" => true,
        "data" => $resultado
    ]);
}

/*
//MOSTRAR TODO EL CARRITO DE COMPRA
else if(isset($_GET['carrito'])){
    $objetoCarrito = new Carrito;
    $carrito = $objetoCarrito->getCarrito();
    $datosCarrito = $carrito->fetch_all(MYSQLI_ASSOC);
    
    $data = json_encode($datosCarrito,JSON_UNESCAPED_UNICODE);
    print($data);
}
// CANCELAR VENTA Y VACIAR EL CARRITO DE COMPRA
else if(isset($_GET['cancelarVenta'])){
    $objetoCancelarVta = new Carrito;
    $venta = $objetoCancelarVta->deleteCarrito(null);

    $data = json_encode($venta);
    print($data);
}
*/