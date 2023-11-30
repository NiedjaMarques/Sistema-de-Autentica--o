<?php 
$usuario = "root"; 
$senha = "root";
$database = "loginregistry"; 
$host = "127.0.0.1:3306";

//Cria uma conexão
$con = new mysqli($host, $usuario, $senha, $database);

//Verifica a conexão
if ($con->connect_error) {
    die("Falha na conexão: " . $con->connect_error);
}

// formulário com campos 'email' e 'senha'
$email = isset($_GET['email']) ? $_GET['email'] : null; //login é o nome do meu objeto no input
$senha = isset($_GET['senha']) ? $_GET['senha'] : null; //senha é o nome do meu objeto no input

$sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'"; //mensagem para o banco de dados
$result = $con->query($sql);

if (!$result) {
    die('Query failed: ' . mysqli_error($conn));
}

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    // Fetch and print the result
    while ($row = mysqli_fetch_assoc($result)) {
        print_r($row);
    }
} else {
    echo 'No results found.';
}

$con->close();
?>

</body>
</html>