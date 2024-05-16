<?php
    require_once ('app/model/Usuario.php');
    require_once ('app/controller/LoginController.php');

    $uri = $_SERVER['REQUEST_URI'];

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['login'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $l = new LoginController();
        $l->login($email, $senha);
    }else{
        echo "estamos no index.php";
    }



    //require_once 'app\model\Usuario.php'; // class usuario
    // //require_once 'app\controller\LoginController.php'; //não serve pra nada ainda
    // require_once 'lib\database\conexao.php';//conexão com o banco de dados   
    // require_once 'app\config\config.php'; //redireciona pra pagina de erros

    //Processamento de Login
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     $email = isset($_POST['email']) ? $_POST['email'] : null;
    //     $senha = isset($_POST['senha']) ? $_POST['senha'] : null;

    //     $p = new Usuario($email, $senha);

    //     require_once 'app/controller/LoginController.php';
    //     $l = new LoginController();
    //     $l->check();

        
    //     //$pessoa->logar($email, $senha);
    // }else {
    //     echo 'não deu certo gatinha';
    // }

    // if (isset($_POST['login'])) {
    //     $email = $_POST['email'];
    //     $senha = $_POST['senha'];
    //     $pessoa = new Usuario($email, $senha);
    //     $pessoa->logar($email, $senha);
    // }else{
    //     echo 'aqui é o inicio';
    //     //header('Location: index.html');
    //     exit();
    // }

    // if (isset($_POST['cadastrar'])) {
    //     // Verifica se todos os campos do formulário foram preenchidos
    //     if (!empty($_POST['username']) && !empty($_POST['senha']) && !empty($_POST['email']) && !empty($_POST['nome_completo']) && !empty($_POST['nascimento'])) {
    //         // Obtém os valores do formulário
    //         $usuario = $_POST['username'];
    //         $senha = $_POST['senha'];
    //         $email = $_POST['email'];
    //         $nome = $_POST['nome_completo'];
    //         $dataNasc = $_POST['nascimento'];
    
    //         // Chama o método cadastrar com os valores obtidos
    //         $pessoa->cadastrar($usuario, $senha, $email, $nome, $dataNasc);
    //     } else {
    //         echo 'Por favor, preencha todos os campos.';
    //     }
    // }

    
    
   



    
    // include_once ('config.php');
    // // conexão com o banco de dados 
    // $dbHost = "127.0.0.1:3306";
    // $dbUsername = "root";
    // $dbPassword = "root";
    // $dbName = "loginregistry";        

    // $con = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    // if ($con->connect_error) {
    //     die("Falha na conexão: " . $con->connect_error);
    // }

    // //Processamento de Login
    // $email = isset($_POST['email']) ? $_POST['email'] : null;
    // $senha = isset($_POST['senha']) ? $_POST['senha'] : null;

    // // $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // $sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";
    // $result = $con->query($sql) or die("Falha na execução do código SQL: " . $con->error);

    // if (mysqli_num_rows($result) > 0) {
    //     $usuario = $result->fetch_assoc();

    //     //if(password_verify($senha, $usuario['senha'])){
    //         // Inicia a sessão
    //         if (!isset($_SESSION)) {
    //             session_start();
    //         }

    //         //pego o nome do usuario no banco de dados e armazeno na minha session
    //         $nomeUsuario = $usuario['username'];        
    //         $_SESSION['nomeUsuario'] = $nomeUsuario;

    //         //redirecionando o meu usuario para a pagina principal do site
    //         header('Location: welcome.php');
    //         exit();
    //     //}

    // } else {
    //     errorHttp(404, "Ops! Seu usuário não foi encontrado. Por favor, volte e cadastre-se para acessar.");
    //     exit();
    // }
    
    // $con->close();
    
?>

