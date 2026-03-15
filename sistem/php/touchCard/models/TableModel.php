<?php

class TableModel {
    private $db;
    
    public function __construct($connection) {
        $this->db = $connection;
    }

    // GET TABLES
    public function getTables() {
        $query = "
            SELECT 
                t.*,
                COALESCE(SUM(sp.cantidad * sp.monto),0) AS total
            FROM tables t
            LEFT JOIN salida_productos_temp sp 
                ON sp.table_id = t.id
            WHERE t.state = ?
            GROUP BY t.id
            ORDER BY t.name ASC
        ";

        $stmt = mysqli_prepare($this->db, $query);
        $state = 1;

        mysqli_stmt_bind_param($stmt, "i", $state);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (!$result) {
            echo "Query error: " . mysqli_error($this->db);
            return [];
        }

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getTable($table_id) {
        $query = "
            SELECT 
                t.*
            FROM tables t
            WHERE t.id = ?
        ";

        $stmt = mysqli_prepare($this->db, $query);

        mysqli_stmt_bind_param($stmt, "i", $table_id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (!$result) {
            echo "Query error: " . mysqli_error($this->db);
            return [];
        }

        return mysqli_fetch_assoc($result);
    }

    public function handlerTable($table_id, $state) {
        $query = "UPDATE tables SET is_free = ? WHERE id = ?";

        $stmt = mysqli_prepare($this->db, $query);

        mysqli_stmt_bind_param($stmt, "ii", $state, $table_id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_error($stmt)) {
            echo "Query error: " . mysqli_stmt_error($stmt);
            return false;
        }

        return true;
    }
}