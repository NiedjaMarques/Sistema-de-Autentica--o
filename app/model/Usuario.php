<?php
    require_once 'lib\database\conexao.php';
    
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

        public function authenticate($usuario, $senha){
            $conexao = Conexao::getConnection();
    
            $stmt = $conexao->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
            $stmt->bind_param(':username', $username);
            $stmt->execute();
            $user = $stmt->fetch_assoc();
    
            if ($user && password_verify($password, $user['password'])) {
                return true;
            }
    
            return false;
        }

        // public function validar($email, $senha){
        //     if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && (isset($_POST['senha']) && strlen($_POST['senha']) >= 8)) {

                

        //     } else {
        //         //errorHttp(404, "Ops! Seu usuário não foi encontrado. Por favor, volte e cadastre-se para acessar.");
        //         echo "404, Ops! Seu usuário não foi encontrado. Por favor, volte e cadastre-se para acessar.";
        //         exit();
        //     }
        // }
        
        // public function logar($email, $senha){
        //     if (empty($email) || empty($senha)) {
        //         echo 'vazio';
        //     }else{
        //         $conexao = Conexao::getConnection();

        //         $sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";
        //         $result = $conexao->query($sql);
        //         $row = $result->fetch_assoc();
                
        //         if ($result->num_rows > 0) {                   
                    
        //             if ($row['senha'] == $senha) {
        //                 if(!isset($_SESSION)){
        //                     session_start();
        //                 }

        //                 $this->usuario = $row['username'];
        //                 $_SESSION['usuario'] = $this->getUsuario();
                        
        //                 header('Location: ../../../view/welcome.php');
        //                 echo 'funcionou - estamos na classe usuario - estou logado : ' . $this->getUsuario();
        //                 exit();
        //             }
        //         }else{
        //             // //$config = new Config();
        //             // $config = Config::errorHttp($errorCode, $errorMessage);
        //             // $config->errorHttp(404,"Ops! Seu usuário não foi encontrado. Por favor, volte e cadastre-se para acessar.");
        //             // //var_dump($config);\

        //             echo 'não funcionou - estamos na classe usuario - usuario não existe';
        //             exit();
        //         }
        //     }

        //     $conexao->close();
        // }
        
        // public function cadastrar($usuario, $senha, $email, $nome, $dataNasc){
        //     $conexao = Conexao::getConnection();
            
        //     $this->usuario = $conexao->real_escape_string($_POST["username"]);
        //     $this->email = $conexao->real_escape_string($_POST["email"]);
        //     $this->senha = $conexao->real_escape_string($_POST["senha"]);
        //     $this->nome = $conexao->real_escape_string($_POST["nome_completo"]);
        //     $this->dataNasc = $conexao->real_escape_string($_POST["nascimento"]);
            
        //     $sql1 = "INSERT INTO usuarios (username, email, senha, nome, nascimento) VALUES ('$usuario', '$email', '$senha', '$nome', '$dataNasc')"; 

        //     if ($conexao->query($sql1) === TRUE) {
        //         echo "Cadastro realizado com sucesso!";
        //     } else {
        //         echo "Erro ao cadastrar usuário: " . $conexao->error;
        //     }

        //     $conexao->close();
        // }

        // public function logout() {
        //     require_once 'Logout.php';
        //     new Logout();
        // }
    
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