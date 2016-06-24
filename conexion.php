<?php
    /* Este fichero realiza la conexión con la base de datos */

    define("DB_DSN", "mysql:host=localhost;dbname=employees");
    define("DB_USER", "root");
    try{
            $conex = new PDO(DB_DSN, DB_USER);
            $conex->setAttribute(PDO::ATTR_PERSISTENT,TRUE);
            $conex->setAttribute(PDO::ERRMODE_EXCEPTION,TRUE);
    }catch(PDOexception $e){
            die("Conexion fallida: ".$e->getMessage());

    }

?>