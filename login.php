<?php
    // Seção de Configuração
    

    // Se o usuario clicar pra sair, é direcionado para pagina principal
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if ($_POST["val1"] == "1"){
            login();
        }
        if ($_POST["val1"] == "2"){
            logout();
        }
        
    }

    function login(){
        $usuario = "root";
        $senha = "root";
        $database = "loginregistry";
        $host = "127.0.0.1:3306";

        $con = new mysqli($host, $usuario, $senha, $database);

        if ($con->connect_error) {
        die("Falha na conexão: " . $con->connect_error);
        }

        //Processamento de Login
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $senha = isset($_POST['senha']) ? $_POST['senha'] : null;

        $sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";
        $result = $con->query($sql);

        $con->close();
        // var_dump($result);
        // die;

        session_start();

        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {
                $_SESSION['email'] = $email;
                $_SESSION['senha'] = $senha;
                header('Location: dashboard.html');
                exit;
            } 

        }else { 
            unset($_SESSION['email']);  
            unset($_SESSION['senha']);
            header('Location: 404.html');    
            exit;
        }
        }
    
    function logout(){
            session_destroy();
            header('Location: index.html');
            exit;
        }
?>

