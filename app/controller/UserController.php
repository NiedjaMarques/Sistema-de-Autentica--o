<?php
    require_once 'lib\database\conexao.php';
    require_once __DIR__ . '/../../core/erroHttp.php';

    use lib\database\Conexao;

    class UserController{
        
        public function cadastrForm(){
            require_once 'app/view/cadastro.html';
        }
        
        public function cadastrar(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $usuario = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
                $nome = filter_input(INPUT_POST, 'nome_completo', FILTER_SANITIZE_SPECIAL_CHARS);

                if (!$usuario || !$email || !$senha || !$nome) {
                    $mensagem = "É necessario preencher todos os campos";
                    $type = 'success';
                    header("Location: /app/view/cadastro.html?mensagem=$mensagem&type=$type");
                    return; 
                }

                $conexao = Conexao::getConnection(); 

                $stmt = $conexao->prepare("SELECT username FROM usuarios WHERE username = ?");
                $stmt->bind_param("s", $usuario);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $mensagem = "Nome de usuário já existe, Por favor, escolha outro.";
                    $type = 'error';
                    header("Location: /app/view/cadastro.html?mensagem=$mensagem&type=$type");
                    $stmt->close();
                    $conexao->close();
                    return;
                }
                $stmt->close();

                $senhaHashed = password_hash($senha, PASSWORD_DEFAULT);  
                $stmt = $conexao->prepare("INSERT INTO usuarios (username, email, senha, nome) VALUES (?, ?, ?, ?)"); 
                $stmt->bind_param("ssss", $usuario, $email, $senhaHashed, $nome);

                if ($stmt->execute()) {
                    $mensagem = "Cadastro realizado com sucesso!";
                    $type = 'success';
                }else{
                    $mensagem = "Erro ao cadastrar o usuário";
                    $type = 'error';
                }
                header("Location: /app/view/cadastro.html?mensagem=$mensagem&type=$type");
        
                $stmt->close();
                $conexao->close();               
            }else{
                showErro::errorHttp('500 - Internal Server Error');
                exit();
            }
        }
    }
?>