<?php 
    //require_once __DIR__ . '/../view/error.php';
    if(!isset($_SESSION)){
        session_start();
    }    
    class Config {
        private static $errorCode;
        private static $errorMessage;

        public function __construct($errorCode, $errorMessage){
            $this->errorCode = $errorCode;
            $this->errorMessage = $errorMessage;
        }
        // public static function errorHttp($errorCode, $errorMessage){
        //     header("Location: /app/view/error.php?code=$errorCode&message=$errorMessage");
        //     exit();
        // }
    }
    // if(!isset($_SESSION)){
    //     session_start();
    // }
    // //Função para redirecionar para a página de erros com código e mensagem
    // function errorHttp($errorCode, $errorMessage){
    //     header("Location: error.php?code=$errorCode&message=$errorMessage");
    //     exit();         
    // }
?>