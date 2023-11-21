<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "banco";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }

    // Consulta SQL para verificar o gerente
    $sql = "SELECT id, nome, email FROM gerente WHERE email = '$email'";
    $result = $conn->query($sql);

    if (!$result) {
        die("Erro na consulta: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Comparar a senha inserida com a senha armazenada no banco de dados
        if (isset($_POST['senha'])) {
            $senha = $_POST['senha'];
            // Login bem-sucedido, armazenar informações do gerente na sessão
            $_SESSION['id_gerente'] = $row['id'];
            $_SESSION['nome_gerente'] = $row['nome'];
            $_SESSION['email_gerente'] = $row['email'];
            header("Location: home.php");
            exit();
        } else {
            // Senha incorreta, exibir mensagem de erro
            echo "Credenciais inválidas. Por favor, tente novamente.";
        }
    } else {
        // Gerente não encontrado, exibir mensagem de erro
        echo "Gerente não encontrado. Por favor, verifique suas credenciais.";
    }

    // Fechar conexão
    $conn->close();
}
?>
