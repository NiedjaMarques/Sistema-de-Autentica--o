<?php 
    require_once 'app/model/Usuario.php';
    class LoginController{ //
        public function check(){ //O método check() é responsável por receber os dados de login do usuário, validar esses dados e, em seguida, chamar o método validar()
            try {
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
            } catch (\Exception $e) {
                //errorHttp(404, "Ops! Seu usuário não foi encontrado. Por favor, volte e cadastre-se para acessar.");
                echo "404, Ops! Seu usuário não foi encontrado. Por favor, volte e cadastre-se para acessar.";
                exit();
            }           
            $usuario->logar($email, $senha);
        }
    }
?> 