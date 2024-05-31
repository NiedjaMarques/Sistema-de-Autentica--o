<?php 
    require_once 'lib\database\conexao.php';
    require_once __DIR__ . '/../../core/erroHttp.php';

    use lib\database\Conexao;

    class AuthController {  
        public function bemvindo() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $userlogado = isset($_SESSION['user']); 

            if ($userlogado) {
                require_once 'app/view/welcome.php';
            }else{
                showErro::errorHttp('401', "Você não tem mais acesso a esta pagina. Por favor, volte e faça o login novamente");
                exit();
            }            
        }
        
        public function loginForm() {
            require_once 'app/view/index.html';
        }

        public function login() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && isset($_POST['senha']) && strlen($_POST['senha']) >= 8) {

                    $email = $_POST['email'];
                    $senha = $_POST['senha'];

                    $conexao = Conexao::getConnection();

                    $sql = "SELECT * FROM usuarios WHERE email=?";
                    $stmt = $conexao->prepare($sql);
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $result = $stmt->get_result();


                    if ($result->num_rows > 0){
                        $row = $result->fetch_assoc();

                        if (password_verify($senha, $row['senha'])) {
                            if (session_status() === PHP_SESSION_NONE) {
                                session_start();
                            }

                            $user = $row['username'];
                            $_SESSION['user'] = $user;

                            header('Location: /welcome');
                            exit();
                        }else{
                            showErro::errorHttp('credenciais incorretas', "Por favor, verifique suas credenciais e tente novamente.");
                            exit();
                        }
                    }else{
                        showErro::errorHttp(401, "Usuario não encontrado. Por favor, faça seu cadastro.");
                        exit();
                    }
                }else{
                    showErro::errorHttp('credenciais incorretas', "você não preencheu todos os campos. Por favor, volte e preencha o email e a senha.");
                    exit();
                }
            }else{
                showErro::errorHttp('500 - Internal Server Error');
                exit();
            }
        }
    
        public function logout() {
            if(session_status() === PHP_SESSION_NONE){
                session_start();
            }

            session_destroy();
            header('Location: /login');
            exit;
        }
    }
?>