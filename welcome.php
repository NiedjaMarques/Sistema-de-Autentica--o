<?php
    session_start();
    include_once 'config.php';

    // Verifica se a variável de sessão 'nomeUsuario' está definida
    if(isset($_SESSION['nomeUsuario'])){
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
<body class="bg-[#d1fae5] m-0 p-0 flex items-center justify-center h-screen">

    <div class="flex flex-col items-center justify-center bg-green-300 container p-5 mx-2 rounded-xl shadow-[0_0_10px_rgba(0, 0, 0, 0.1)]">

        <h1 class="text-3xl font-bold text-green-800 mb-4">
            Bem-vindo ao Jardim <strong><?php echo $nomeUsuario;?></strong>!
        </h1>

        <p class="text-lg text-green-700 mb-8">
            Obrigado por fazer login. Aproveite as flores!
        </p>

        <a href="logout.php" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
            Voltar
        </a>

    </div>

</body>
</html>

<?php
    } else {  
        errorHttp(403, "Você não pode acessar esta página porque não esta logado. Volte e faça seu login!");  
        exit;
    }
?>