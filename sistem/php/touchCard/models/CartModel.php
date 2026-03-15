<?php

class CartModel {
    private $db;
    
    public function __construct($connection) {
        $this->db = $connection;
    }

    // Get NEXT TICKET ID
    public function getTicketId() {
        $query = "
            SELECT IFNULL(MAX(numero_fact),0) + 1 AS next_ticket
            FROM (
                SELECT numero_fact FROM salida_productos
                UNION ALL
                SELECT numero_fact FROM salida_productos_temp
            ) t
        ";
    
        $res = mysqli_query($this->db, $query);
        $row = mysqli_fetch_assoc($res);
    
        return isset($row['next_ticket']) ? (int)$row['next_ticket'] : 1;
    }

    // INSERT PRODUCT INTO CART
    public function insertProduct($idProduct, $quantity, $price, $discountProduct, $invoiceNumber, $tableId, $userId,$clientId) {
        $query = "
            INSERT INTO salida_productos_temp(
                id_producto,
                cantidad,
                monto,
                desc_product,
                numero_fact,
                table_id,
                id_usuario,
                nombre_fact,
                fecha_salida
            ) VALUES(
                '$idProduct',
                '$quantity',
                '$price',
                '$discountProduct',
                '$invoiceNumber',
                '$tableId',
                '$userId',
                '$clientId',
                NOW()
            )
        ";

        return mysqli_query($this->db, $query);
    }

    // CHECK IF PRODUCT EXISTS IN CART
    public function getCartItem($id, $tableId) {
        $query = "
            SELECT 
                id_salida, cantidad
            FROM salida_productos_temp
            WHERE id_producto = '$id'
            AND table_id = '$tableId'
            LIMIT 1
        ";

        $res = mysqli_query($this->db, $query);

        if (!$res) {
            echo "Query error: " . mysqli_error($this->db);
            return null;
        }

        $row = mysqli_fetch_assoc($res);

        return $row ?: null;
    }

    // UPDATE PRODUCT IN CART
    public function updateCartItem($idItem, $idProduct, $quantity, $price, $discountProduct, $invoiceNumber, $tableId) {
        $query = "
            UPDATE salida_productos_temp
            SET 
                cantidad = '$quantity',
                monto = '$price',
                desc_product = '$discountProduct',
                numero_fact = '$invoiceNumber',
                id_producto = '$idProduct',
                table_id = '$tableId',
                fecha_salida = NOW()
            WHERE id_salida = '$idItem'
            AND table_id = '$tableId'
        ";

        return mysqli_query($this->db, $query);
    }

    // GET CART ITEMS
    public function getCart($tableId) {
        $query = "
            SELECT 
                P.nombre_producto,
                P.cod_producto,
                P.iva_producto,
                S.id_producto,
                S.monto AS precio_unid,
                SUM(S.cantidad) AS cantidad,
                SUM(S.monto) AS monto,
                S.fecha_salida,
                S.id_usuario,
                S.numero_fact,
                S.id_salida
            FROM salida_productos_temp S
            INNER JOIN productos P 
            ON S.id_producto = P.id_producto
            WHERE table_id = '$tableId'
            GROUP BY 
                S.id_producto,
                P.nombre_producto,
                P.cod_producto,
                P.iva_producto,
                S.fecha_salida,
                S.id_usuario,
                S.numero_fact
            ORDER BY S.id_salida ASC
        ";

        $res = mysqli_query($this->db, $query);
        return $res;
    }

    // UPDATE PRODUCT IN CART
    public function updateItemAmount($quantity,$itemId) {
        $query = "
            UPDATE salida_productos_temp
            SET 
                cantidad = '$quantity'
            WHERE id_salida = '$itemId'
        ";

        return mysqli_query($this->db, $query);
    }

    // DELETE PRODUCT IN CART
    public function deleteItem($itemId) {
        $query = "
            DELETE FROM salida_productos_temp
            WHERE id_salida = '$itemId'
        ";

        return mysqli_query($this->db, $query);
    }
    
    // BORRAR LOS PRODUCTOS DEL CARRITO DE COMPRA
    public function emptyCart($table_id) {
        $query = "DELETE FROM salida_productos_temp WHERE table_id = ?";

        $stmt = mysqli_prepare($this->db, $query);

        mysqli_stmt_bind_param($stmt, "i", $table_id);

        if(mysqli_stmt_execute($stmt)){
            return [
                "success" => true,
                "message" => "Cart emptied successfully"
            ];
        } else {
            return [
                "success" => false,
                "message" => mysqli_error($this->db)
            ];
        }
    }

    public function saveCart($table_id, $postAction = null) {
        $conexion = $this->db;

        // 1️⃣ Preparar la consulta INSERT ... SELECT desde temp a final
        $query = "
            INSERT INTO salida_productos (
                nombre_fact, numero_fact, fecha_salida, id_producto, monto, cantidad, id_usuario, desc_product, table_id
            )
            SELECT 
                nombre_fact, numero_fact, fecha_salida, id_producto, monto, cantidad, id_usuario, desc_product, table_id
            FROM salida_productos_temp
            WHERE table_id = ?
        ";

        $stmt = mysqli_prepare($conexion, $query);
        if (!$stmt) {
            return [
                "success" => false,
                "message" => "Error preparing the query: " . mysqli_error($conexion)
            ];
        }

        // 2️⃣ Vincular el parámetro table_id
        mysqli_stmt_bind_param($stmt, "i", $table_id);

        // 3️⃣ Ejecutar la inserción
        if (!mysqli_stmt_execute($stmt)) {
            $stmt->close();
            return [
                "success" => false,
                "message" => "Error executing the query: " . mysqli_error($conexion)
            ];
        }

        $stmt->close();

        // 4️⃣ Vaciar la tabla temporal para esa mesa
        $emptyResult = $this->emptyCart($table_id);

        return [
            "success" => true,
            "message" => "Cart saved and emptied successfully",
            "emptyResult" => $emptyResult
        ];
    }
   
}