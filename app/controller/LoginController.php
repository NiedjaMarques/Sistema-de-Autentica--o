<?php 
    require_once 'Usuario.php';
    class LoginController{
        public function check(){ //criando o usuario colocando email e senha
            $usuario = new Usuario();

            if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $usuario->setEmail($_POST['email']);
            } else {
                //errorHttp(404, "Ops! Seu usuário não foi encontrado. Por favor, volte e cadastre-se para acessar.");
                echo "404, Ops! Seu usuário não foi encontrado. Por favor, volte e cadastre-se para acessar.";
                exit();
            }
            
            if (isset($_POST['senha']) && strlen($_POST['senha']) >= 8) {
                $usuario->setSenha($_POST['senha']);
            } else {
                //errorHttp(404, "Ops! Seu usuário não foi encontrado. Por favor, volte e cadastre-se para acessar.");
                echo "404, Ops! Seu usuário não foi encontrado. Por favor, volte e cadastre-se para acessar.";
                exit();
            }     
            
            $usuario->validar();
            //try{}catch
        }         
    }
?> 