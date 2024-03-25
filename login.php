<?php
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
    $result = $con->query($sql);

    if (mysqli_num_rows($result) > 0) {
        //se encontrar um usuario com as credenciais fornecidas acima
        $usuario = $result->fetch_assoc();
        $nomeUsuario = $usuario['nome'];

        // Inicia a sessão e armazena o nome do usuário nela
        session_start();
        $_SESSION['nomeUsuario'] = $nomeUsuario;

        header('Location: welcome.php');
        exit;

    } else {
        $errorCode = 404;
        $errorMessage = "Ops! Seu usuário não foi encontrado. Por favor, volte e cadastre-se para acessar.";
        header("Location: error.php?code=$errorCode&message=$errorMessage");
        exit;
    }
    
    $con->close();
    

    // // Se o usuario clicar pra sair, é direcionado para pagina principal
    // if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //     if ($_POST["val1"] == "1"){
    //         login();
    //     }
    //     if ($_POST["val1"] == "2"){
    //         logout();
    //     }
        
    // }

//     function login(){
        
//         // var_dump($result);
//         // die;

//         session_start();

//         if (mysqli_num_rows($result) > 0) {

//             while ($row = mysqli_fetch_assoc($result)) {
//                 $_SESSION['email'] = $email;
//                 $_SESSION['senha'] = $senha;
//                 header('Location: dashboard.html');
//                 exit;
//             } 

//         }else { 
//             unset($_SESSION['email']);  
//             unset($_SESSION['senha']);
//             header('Location: 404.html');    
//             exit;
//         }
//     }
    
//     function logout(){
//         session_destroy();
//         header('Location: index.html');
//         exit;
//     }
// ?>

