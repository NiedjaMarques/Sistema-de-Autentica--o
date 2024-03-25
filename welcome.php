<?php
    session_start();

    // Verifica se o nome do usuário está armazenado na Session
    if (isset($_SESSION['nomeUsuario'])) {
        $nomeUsuario = $_SESSION['nomeUsuario'];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo!</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-400 m-0 p-0 flex items-center justify-center h-screen">

    <div class="container bg-slate-200 text-center p-5 mx-2 rounded-xl shadow-[0_0_10px_rgba(0, 0, 0, 0.1)]">
        
        <h1 class="text-[#333]">
            Bem-vindo ao Nosso Site <strong><?php echo $nomeUsuario;?></strong>! 
        </h1>

        <p class="text-[#666]">
            Obrigado por fazer login. Aqui está o que você pode fazer:
        </p>

        <ul>
            <li>Explorar nosso conteúdo exclusivo</li>
            <li>Atualizar seu perfil</li>
            <li>Entrar em contato conosco</li>
        </ul>

        <p>
            Se precisar de ajuda, <a href="#" class="text-[#007bff] hover:underline">entre em contato conosco</a>.
        </p>

        <p>
            <a href="index.html" class="text-[#007bff] hover:underline">
                Sair
            </a>
        </p>

    </div>

</body>
</html>

<?php
    } else {
        // Se o nome do usuário não estiver armazenado na Session, exibe uma mensagem de erro
        echo "Erro: Nome do usuário não encontrado.";
    }
?>