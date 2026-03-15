<?php

class CompanyModel {
    private $db;
    
    public function __construct($connection) {
        $this->db = $connection;
    }

    public function retrive() {
        $query = "
            SELECT *
            FROM datos_empresa
            LIMIT 1
        ";

        $result = mysqli_query($this->db, $query);

        if (!$result) {
            echo "Query error: " . mysqli_error($this->db);
            return null;
        }

        return mysqli_fetch_assoc($result);
    }
}