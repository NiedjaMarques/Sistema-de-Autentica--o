<?php
    include_once ('config.php');
    // conexão com o banco de dados 
    $dbHost = "127.0.0.1:3306";
    $dbUsername = "root";
    $dbPassword = "root";
    $dbName = "loginregistry";       

    $con = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    if ($con->connect_error) {
        die("Falha na conexão: " . $con->connect_error);
    }

    //Processamento de Login
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $senha = isset($_POST['senha']) ? $_POST['senha'] : null;

    $sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";
    $result = $con->query($sql) or die("Falha na execução do código SQL: " . $con->error);

    if (mysqli_num_rows($result) > 0) {
        $usuario = $result->fetch_assoc();

        // Inicia a sessão
        if (!isset($_SESSION)) {
            session_start();
        }

        //pego o nome do usuario no banco de dados e armazeno na minha session
        $nomeUsuario = $usuario['username'];        
        $_SESSION['nomeUsuario'] = $nomeUsuario;

        //redirecionando o meu usuario para a pagina principal do site
        header('Location: welcome.php');
        exit();

    } else {
        errorHttp(404, "Ops! Seu usuário não foi encontrado. Por favor, volte e cadastre-se para acessar.");
        exit();
    }
    
    $con->close();
    
?>

