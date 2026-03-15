<?php

class UserModel {
    private $db;
    
    public function __construct($connection) {
        $this->db = $connection;
    }

    public function getById($id) {
        $query = "
            SELECT 
                id_usuario,
                nick,
                nombre_usu,
                id_rol,
                foto_usu,
                email,
                telefono
            FROM usuarios
            WHERE id_usuario = ?
            LIMIT 1
        ";

        $stmt = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_assoc($result);
    }
}