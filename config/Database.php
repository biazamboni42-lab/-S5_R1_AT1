<?php 

class Database{
    private static $conn;

    public static function conectar(){
        if(!self::$conn){
            self::$conn = new PDO(
                "pgsql:host=192.168.10.12;port=5432;dbname=estoque",
                "estoque",
                "estoque",
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        }

        return self::$conn;
    }
}

?>