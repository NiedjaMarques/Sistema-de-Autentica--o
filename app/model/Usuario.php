<?php
    require_once 'app\controller\LoginController.php';
    require_once 'lib\database\conexao.php';
    require_once './index.php';
   //require_once '\..\view\welcome.php';
    //require_once 'app\config\config.php';
    //require_once 'app\config\error.php';
    require_once(__DIR__ . '/../view/welcome.php');
    use lib\database\Conexao;

    class Usuario {
        private $id;
        private $usuario;
        private $senha;
        private $email;
        private $nome;
        private $dataNasc;

        public function __construct($email, $senha){
            $this->senha = $senha;
            $this->email = $email;              
        }

        public function validar($email, $senha){
            if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && (isset($_POST['senha']) && strlen($_POST['senha']) >= 8)) {

                

            } else {
                //errorHttp(404, "Ops! Seu usuário não foi encontrado. Por favor, volte e cadastre-se para acessar.");
                echo "404, Ops! Seu usuário não foi encontrado. Por favor, volte e cadastre-se para acessar.";
                exit();
            }
        }
        
        public function logar($email, $senha){
            if (empty($email) || empty($senha)) {
                echo 'vazio';
            }else{
                $conexao = Conexao::getConnection();

                $sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";
                $result = $conexao->query($sql);
                $row = $result->fetch_assoc();
                
                if ($result->num_rows > 0) {                   
                    session_start();
                    if ($row['senha'] == $senha) {
                        

                        $this->usuario = $row['username'];
                        $_SESSION['usuario'] = $this->getUsuario();

                       header('Location: \view\welcome.php');
                        echo 'funcionou - estamos na classe usuario';
                        exit();
                    }
                }else{
                    // //$config = new Config();
                    // $config = Config::errorHttp($errorCode, $errorMessage);
                    // $config->errorHttp(404,"Ops! Seu usuário não foi encontrado. Por favor, volte e cadastre-se para acessar.");
                    // //var_dump($config);\

                    echo 'não funcionou - estamos na classe usuario';
                    exit();
                }
            }

            $conexao->close();
        }
        
        public function cadastrar($usuario, $senha, $email, $nome, $dataNasc){
            $conexao = Conexao::getConnection();
            
            $this->usuario = $conexao->real_escape_string($_POST["username"]);
            $this->email = $conexao->real_escape_string($_POST["email"]);
            $this->senha = $conexao->real_escape_string($_POST["senha"]);
            $this->nome = $conexao->real_escape_string($_POST["nome_completo"]);
            $this->dataNasc = $conexao->real_escape_string($_POST["nascimento"]);
            
            $sql1 = "INSERT INTO usuarios (username, email, senha, nome, nascimento) VALUES ('$usuario', '$email', '$senha', '$nome', '$dataNasc')"; 

            if ($conexao->query($sql1) === TRUE) {
                echo "Cadastro realizado com sucesso!";
            } else {
                echo "Erro ao cadastrar usuário: " . $conexao->error;
            }

            $conexao->close();
        }

        public function logout() {
            require_once 'Logout.php';
            new Logout();
        }
    
        // public function errorHttp($errorCode, $errorMessage) {            
        //     header("Location: error.php?code=$errorCode&message=$errorMessage");
        //     exit();                
        // }

        public function getId() {
            return $this->id;
        }    
        public function getUsuario() {
            return $this->usuario;
        }    
        public function setUsuario($usuario) {
            $this->usuario = $usuario;
        }    
        public function getSenha() {
            return $this->senha;
        }    
        public function setSenha($senha) {
            $this->senha = $senha;
        }    
        public function getEmail() {
            return $this->email;
        }    
        public function setEmail($email) {
            $this->email = $email;
        }
        public function getNome() {
            return $this->nome;
        }    
        public function setNome($nome) {
            $this->nome = $nome;
        }  
        public function getDataNasc() {
            return $this->dataNasc;
        }    
        public function setDataNasc($dataNasc) {
            $this->dataNasc = $dataNasc;
        }   
    }
?>