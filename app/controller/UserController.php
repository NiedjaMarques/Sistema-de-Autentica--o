<?php
    require_once 'lib\database\conexao.php';
    require_once __DIR__ . '/../../core/erroHttp.php';

    use lib\database\Conexao;

    class UserController{
        
        public function loginCadastr(){
            require_once 'app/view/cadastro.html';
        }
        
        public function cadastrar(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $usuario = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
                $nome = filter_input(INPUT_POST, 'nome_completo', FILTER_SANITIZE_SPECIAL_CHARS);

                if (!$usuario || !$email || !$senha || !$nome) {
                    echo 'É necessario preencher todos os campos', "Por favor, volte e tente novamente.";
                }else{
                    $conexao = Conexao::getConnection();                    
                    $stmt = $conexao->prepare("SELECT username FROM usuarios WHERE username = ?");
                    $stmt->bind_param("s", $usuario);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (!$result) {
                        //bota um erro http no lugar do echo
                        echo "Erro ao verificar usuário: " . $conexao->error;
                        return;
                    }
                    if ($result->num_rows > 0) {
                        //bota um erro http no lugar do echo
                        echo 'Nome de usuário já existe', "Por favor, escolha outro.";
                        $stmt->close();
                        $conexao->close();
                    }
                    $stmt->close();

                    $senhaHashed = password_hash($senha, PASSWORD_DEFAULT);  
                    $stmt = $conexao->prepare("INSERT INTO usuarios (username, email, senha, nome) VALUES (?, ?, ?, ?)"); 
                    $stmt->bind_param("ssss", $usuario, $email, $senhaHashed, $nome);

                    if ($stmt->execute()) {
                       //bota um erro http no lugar do echo
                        echo "Cadastro realizado com sucesso!";
                    }else{
                        //bota um erro http no lugar do echo
                        echo "Erro ao cadastrar usuário: " . $stmt->error;
                    }
        
                    $stmt->close();
                    $conexao->close();
                }               
            }else{
                echo '500 - Internal Server Error';
            }
        }
    }
?>