<?php
class ProductModel {

    private $db;

    public function __construct($connection) {
        $this->db = $connection;
    }

    public function retrive($categoryId = null) {
        if (isset($categoryId)) {
            $query = "
                SELECT * 
                FROM productos 
                WHERE id_categoria = ?
                AND estado_producto = 1
                ORDER BY nombre_producto ASC
            ";

            $stmt = mysqli_prepare($this->db, $query);
            mysqli_stmt_bind_param($stmt, "i", $categoryId);

        } else {

            $query = "
                SELECT * 
                FROM productos 
                WHERE estado_producto = 1
                ORDER BY nombre_producto ASC
            ";
            $stmt = mysqli_prepare($this->db, $query);
        }

        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }

    public function search($search) {
        $query = "
            SELECT * 
            FROM productos 
            WHERE (
                cod_producto LIKE ?
                OR nombre_producto LIKE ?
            )
            AND estado_producto = 1
            ORDER BY nombre_producto ASC
        ";

        $stmt = mysqli_prepare($this->db, $query);

        $searchParam = "%{$search}%";

        mysqli_stmt_bind_param($stmt, "ss", $searchParam, $searchParam);

        mysqli_stmt_execute($stmt);

        return mysqli_stmt_get_result($stmt);
    }

    // GET PRODUCT BY BARCODE
    public function getByCode($code, $branchId) {

        $query = "
            SELECT * 
            FROM products 
            WHERE product_code = '$code'
            AND branch_id = '$branchId'
            AND product_stock > 0 
            AND product_status = 1
        ";

        return mysqli_query($this->db, $query);
    }

    // INSERT NEW PRODUCT
    public function insertProduct($code, $name, $category, $purchasePrice, $salePrice, $tax, $stock) {

        $query = "
            INSERT INTO productos (
                cod_producto,
                nombre_producto,
                id_categoria,
                cantidad,
                precio_unid,
                precio_compra,
                iva_producto
            ) VALUES (
                '$code',
                '$name',
                '$category',
                '$stock',
                '$salePrice',
                '$purchasePrice',
                '$tax'
            )
        ";

        return mysqli_query($this->db, $query);
    }

    // GET ACTIVE CATEGORIES
    public function getCategories() {

        $query = "
            SELECT id_categoria, nombre_cat
            FROM categorias WHERE state = 1
            ORDER BY nombre_cat ASC
        ";

        return mysqli_query($this->db, $query);
    }
}
