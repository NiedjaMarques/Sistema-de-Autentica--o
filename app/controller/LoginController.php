<?php 
    require_once (__DIR__ . '/../../index.php');
    require_once 'app/model/Usuario.php';

    class LoginController{
        public function login($email, $senha){
            $n = new Usuario($email, $senha);
            $n->logar($email, $senha);
        }
             
        // public function check($email, $senha){
        //     try {
        //         $usuario = new Usuario($email, $senha);
        //         $usuario->validar($email, $senha);
        //         var_dump();

        //     } catch (\Exception $e) {
        //         //errorHttp(404, "Ops! Seu usuário não foi encontrado. Por favor, volte e cadastre-se para acessar.");
        //         echo "404, Ops! Seu usuário não foi encontrado. Por favor, volte e cadastre-se para acessar.";
        //         exit();
        //     }           
        //     $usuario->logar($email, $senha);
        // }
    }
?> 