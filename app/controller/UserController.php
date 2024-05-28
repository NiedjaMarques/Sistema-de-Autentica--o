<?php 
    require_once __DIR__ . '/app/config/Config.php';
    class UserController{
        
        public function cadastrar($usuario, $senha, $email, $nome, $dataNasc){
            $conexao = Conexao::getConnection();
            
            $usuario = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
            $nome = filter_input(INPUT_POST, 'nome_completo', FILTER_SANITIZE_STRING);
            $dataNasc = filter_input(INPUT_POST, 'nascimento', FILTER_SANITIZE_STRING);

            if (!$usuario || !$email || !$senha || !$nome || !$dataNasc) {
                echo "Por favor, preencha todos os campos corretamente.";
                return;
            }

            $senhaHashed = password_hash($senha, PASSWORD_DEFAULT);
            
            $stmt = $conexao->prepare("INSERT INTO usuarios (username, email, senha, nome, nascimento) VALUES (?, ?, ?, ?, ?)"); 
            $stmt->bind_param("sssss", $usuario, $email, $senhaHashed, $nome, $dataNasc);

            if ($stmt->execute()) {
                echo "Cadastro realizado com sucesso!";
            } else {
                echo "Erro ao cadastrar usuário: " . $stmt->error;
            }
            $stmt->close();
            $conexao->close();
        }
    }
?>