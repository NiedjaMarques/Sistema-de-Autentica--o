<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro HTTP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-600">
    <h1 class="text-2xl">Erro HTTP</h1>
    <?php
    // Verificar se o código de erro foi passado via parâmetro GET
    if(isset($_GET['code']) && isset($_GET['message'])) {
        $errorCode = $_GET['code'];
        $errorMessage = $_GET['message'];
        echo "<p>Erro $errorCode: $errorMessage</p>";
    } else {
        echo "<p>Ocorreu um erro desconhecido.</p>";
    }
    ?>
</body>
</html>