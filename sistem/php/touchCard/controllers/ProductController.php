<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, PATCH, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}

require_once "../../conexion.php";
require_once "../models/ProductModel.php";

if (isset($_GET['all-categories'])) {
    $productModel = new ProductModel($conexion);
    $categories = $productModel->getCategories();

    $data = $categories->fetch_all(MYSQLI_ASSOC);
    echo json_encode($data);

} else if (isset($_GET['all-products'])) {
    $productModel = new ProductModel($conexion);
    $products = $productModel->retrive(null);

    $data = $products->fetch_all(MYSQLI_ASSOC);
    echo json_encode($data);

} else if (isset($_GET['products-by-category'])) {
    $productModel = new ProductModel($conexion);
    $products = $productModel->retrive($_GET['products-by-category']);

    $data = $products->fetch_all(MYSQLI_ASSOC);
    echo json_encode($data);

}else if (isset($_GET['search']) && $_GET['search'] !== '') {
    $productModel = new ProductModel($conexion);
    $search = trim($_GET['search']);

    $products = $productModel->search($search);

    $data = mysqli_fetch_all($products, MYSQLI_ASSOC);
    echo json_encode($data);
}

