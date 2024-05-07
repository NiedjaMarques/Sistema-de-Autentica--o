<?php
    require_once 'LoginController.php';
    class Usuario{
        private $id;
        private $usuario;
        private $senha;
        private $email;

        public function __construct($usuario, $senha, $email){
            $this->usuario = $usuario;
            $this->senha = $senha;
            $this->email = $email;  
        }

        public function logar(){

        } 
        public function validar($email, $senha){
            //conexão com o banco de dados 
            $dbHost = "127.0.0.1:3306";
            $dbUsername = "root";
            $dbPassword = "root";
            $dbName = "loginregistry";

            $con = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

            if ($con->connect_error) {
                die("Falha na conexão: " . $con->connect_error);
            }

            //conectar ao banco de dados

            $sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";
            $result = $con->query($sql) or die("Falha na execução do código SQL: " . $con->error);

            //selecionar o usuario que tenha o mesmo email do informado
            //conferir a senha do usuario

            if (mysqli_num_rows($result) > 0) {
                    $user = $result->fetch_assoc();
            
                    if(password_verify($senha, $user['senha'])){
                        // Inicia a sessão
                        if (!isset($_SESSION)) {
                            session_start();
                        }
            
                        //pego o nome do usuario no banco de dados e armazeno na minha session
                        $nomeUsuario = $user['username'];        
                        $_SESSION['nomeUsuario'] = $nomeUsuario;
            
                        //redirecionando o meu usuario para a pagina principal do site
                        header('Location: welcome.php');
                        exit();
                    //}
            
                } else {
                    //errorHttp(404, "Ops! Seu usuário não foi encontrado. Por favor, volte e cadastre-se para acessar.");
                    echo "404, Ops! Seu usuário não foi encontrado. Por favor, volte e cadastre-se para acessar.";
                    exit();
                }
                
            //se tiver tudo oque... criar a session e direcionar o usuario pra login com sucesso
            //se tiver um erro... manda de volta pra a tela inicial
        }
        // public function cadastrar(){

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
    }
?>