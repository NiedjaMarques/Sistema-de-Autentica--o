<?php 
    namespace lib\database;

    abstract class Conexao{
        private static $con;

        public static function getConnection(){
            if (!self::$con) {
                $dbHost = "127.0.0.1:3306";
                $dbUsername = "root";
                $dbPassword = "root";
                $dbName = "loginregistry";

                self::$con = new \mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

                if(self::$con->connect_error){
                    die("Falha na conexão: " . self::$con->connect_error);
                }
            }
            return self::$con;
        }
    }
?>