<?php 
    if(!isset($_SESSION)){
        session_start();
    }
    //Função para redirecionar para a página de erros com código e mensagem
    function errorHttp($errorCode, $errorMessage){
        header("Location: error.php?code=$errorCode&message=$errorMessage");
        exit();         
    }
?>