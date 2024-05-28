<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro HTTP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#d1fae5]">

    <div class="flex flex-col items-center justify-center h-screen">

        <?php
            // Verificar se o código de erro foi passado via parâmetro GET
            if(isset($_GET['code']) && isset($_GET['message'])) {
                $errorCode = $_GET['code'];
                $errorMessage = $_GET['message'];
                echo "<h1 class='text-3xl font-bold text-green-800 mb-4'>Erro $errorCode</h1>";
                echo "<p class='text-lg text-green-700 mb-8'>$errorMessage</p>";
            } else {
                echo "<h1 class='text-3xl font-bold text-green-800 mb-4'>Ops! Ocorreu um erro desconhecido.</h1>";
            }
        ?>

        <a href="/sair" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
            Voltar para o Jardim
        </a>

    </div>
    
</body>
</html>