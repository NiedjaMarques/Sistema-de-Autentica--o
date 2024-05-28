<!-- Responsável por receber as requisições do usuário, interagir com o modelo apropriado e retornar a resposta para a visualização. -->
<?php 
    require_once __DIR__ . '/app/config/Config.php';

    class LoginController {
        public function indexHtml(){
            require '../app/views/login.html';
        }

        public function logar($email, $senha){     

            if (empty($email) || empty($senha)) {
                Config::errorHttp(404, 'Página não encontrada');
            }else{
                $conexao = Conexao::getConnection();

                $sql = "SELECT * FROM usuarios WHERE email=? AND senha=?";
                $stmt = $conexao->prepare($sql);
                $stmt->bind_param("ss", $email, $senha);
                $stmt->execute();
                $result = $stmt->get_result();

                //$sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";
                //$result = $conexao->query($sql);
                
                if ($result->num_rows > 0) {  

                    $row = $result->fetch_assoc();

                    if ($row['senha'] == $senha) {
                        if(!isset($_SESSION)){
                            session_start();
                        }

                        $this->usuario = $row['username'];
                        $_SESSION['usuario'] = $this->getUsuario();
                        
                        header('Location: ../app/views/welcome.html');
                        echo 'funcionou - estamos na classe usuario - estou logado : ' . $this->getUsuario();
                        exit();
                    }
                }else{
                    Config::errorHttp(404, 'Ops! Seu usuário não foi encontrado. Por favor, volte e cadastre-se para acessar.');
                    echo 'não funcionou - estamos na classe usuario - usuario não existe';
                    exit();
                }
            }
            $conexao->close();
        }
    }



    // require_once (__DIR__ . '/../../index.php');
    // require_once 'app/model/Usuario.php';

    // class LoginController{
    //     public function login($email, $senha){
    //         $l = new Usuario($email, $senha);
    //         $l->logar($email, $senha);
    //     }

    //     public function cadastro($usuario, $senha, $email, $nome, $dataNasc){
    //         $c = new Usuario();
    //         $c->cadastrar($usuario, $senha, $email, $nome, $dataNasc);
    //     }




             
    //     // public function check($email, $senha){
    //     //     try {
    //     //         $usuario = new Usuario($email, $senha);
    //     //         $usuario->validar($email, $senha);
    //     //         var_dump();

    //     //     } catch (\Exception $e) {
    //     //         //errorHttp(404, "Ops! Seu usuário não foi encontrado. Por favor, volte e cadastre-se para acessar.");
    //     //         echo "404, Ops! Seu usuário não foi encontrado. Por favor, volte e cadastre-se para acessar.";
    //     //         exit();
    //     //     }           
    //     //     $usuario->logar($email, $senha);
    //     // }
    //}
?> 