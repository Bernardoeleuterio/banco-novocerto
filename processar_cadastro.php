<?php
session_start();

// Verifica se os dados do formulário foram recebidos via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta de dados do formulário
    $nome_cliente = $_POST["nome"];
    $email_cliente = $_POST["email"];
    $telefone_cliente = $_POST["telefone"];
    $cpf_cliente = $_POST["cpf"];

    // Assumindo que $id_gerente contém o ID do gerente logado
    $id_gerente = $_SESSION['id_gerente']; // Certifique-se de definir essa variável corretamente

    // Conexão com o banco de dados (substitua pelos seus dados)
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "banco";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Prepara e executa a consulta para inserir o novo cliente
    $sql = "INSERT INTO cliente (nome, email, telefone, cpf, id_gerente) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nome_cliente, $email_cliente, $telefone_cliente, $cpf_cliente, $id_gerente);

    if ($stmt->execute()) {
        // Cliente cadastrado com sucesso
        // Redirecione para uma página de sucesso ou faça outras ações necessárias
        header("Location: home.php");
        exit();
    } else {
        // Se houver algum erro durante a inserção
        echo "Erro ao cadastrar cliente: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
