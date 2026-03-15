<?php

class OrderModel {
    private $db;
    
    public function __construct($connection) {
        $this->db = $connection;
    }

    public function getByOrderId($id) {
        $query = "
            SELECT *
            FROM orders
            WHERE id = ?
            LIMIT 1
        ";

        $stmt = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_assoc($result);
    }

    public function getById($table_id, $status="open") {
        $query = "
            SELECT 
                O.*
            FROM orders O
            WHERE O.table_id = ?
            AND O.status = ?
        ";

        $stmt = mysqli_prepare($this->db, $query);

        mysqli_stmt_bind_param($stmt, "is", $table_id, $status);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (!$result) {
            echo "Query error: " . mysqli_error($this->db);
            return [];
        }

        return mysqli_fetch_assoc($result);
    }

    public function create($table_id, $user_id) {
        $query = "
            INSERT INTO orders (table_id, user_id)
            VALUES (?, ?)
        ";

        $stmt = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($stmt, "ii", $table_id, $user_id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) <= 0) {
            return false;
        }

        return $this->getById($table_id, "open");
    }

    // open/paid/cacelled
    public function setState($id, $state, $subTotal, $vatTotal, $paymentMethod, $total) {

        $query = "
            UPDATE orders
            SET 
                status = ?, 
                subtotal = ?, 
                tax = ?, 
                total = ?, 
                payment_method = ?,
                closed_at = CASE 
                    WHEN ? IN ('paid','cancelled') THEN NOW()
                    ELSE closed_at
                END
            WHERE id = ?
        ";

        $stmt = mysqli_prepare($this->db, $query);

        mysqli_stmt_bind_param(
            $stmt,
            "sdddssi",
            $state,
            $subTotal,
            $vatTotal,
            $total,
            $paymentMethod,
            $state,
            $id
        );

        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_errno($stmt)) {
            return false;
        }

        return $this->getByOrderId($id);
    }
}