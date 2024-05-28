<?php 
    class showErro{
        private static $errorCode;
        private static $errorMessage;

        public static function errorHttp($errorCode, $errorMessage){

            self::$errorCode = $errorCode;
            self::$errorMessage = $errorMessage;
            
            header("Location: /app/view/error.php?code=$errorCode&message=$errorMessage");
            exit();
        }
    }
?>