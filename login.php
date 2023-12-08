<?php
    $usuario = "root"; 
    $senha = "root";
    $database = "loginregistry"; 
    $host = "127.0.0.1:3306";

    $con = new mysqli($host, $usuario, $senha, $database);

    if ($con->connect_error) {
    die("Falha na conexão: " . $con->connect_error);
    }

    $email = isset($_GET['email']) ? $_GET['email'] : null;
    $senha = isset($_GET['senha']) ? $_GET['senha'] : null; 

    $sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'"; 
    $result = $con->query($sql);

    // var_dump($result);
    // die;

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) { 
            echo '<h1>Olá, seja bem vindo(a) </h1>' . '<strong>' . $row["nome"] . '</strong>';
            // $_SESSION['email'] = $email;
            // $_SESSION['senha'] = $senha;
        }

    } else {
    
    echo "<h1>404 Not Found</h1>" . "<p>Usuário não encontrado. Por favor, verifique suas credenciais.</p>";
    header('Location: manutenção.html');
    exit();
    // header("HTTP/1.0 404 Not Found");
    // unset($_SESSION['email']) ;
    // unset($_SESSION['senha']) ;
    // 
    }

    $con->close();

?>   

<!-- tela de acesso do usuario:
verifico no meu banco de dados se o usuario tem acesso ou não - ok
(tela pra quando ele tiver acesso - bem vindo fulano de tal) - ok

questão das session

tela pra quando ele não tiver acesso - html com o erro (erro de credenciais erradas) - ok

tambem criando paginas de erros http: - ok

uma pra erro do servidor: 
quando a pagina do servidor estiver em manutenção - qual pagina ? pagina de cadastro) -->

<!-- //VERIFICAÇÃO DA SESSION
//session_start();
// if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)){
//     unset($_SESSION['email']) ;
//     unset($_SESSION['senha']) ;
//     header('Location: front-end.html'); //HTTP/1.1 503 Service Unavailable
// } 
// $acesso = $_SESSION['email']; -->

