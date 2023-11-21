<?php
session_start();

if (isset($_SESSION['id_gerente'])) {
    $id_gerente = $_SESSION['id_gerente'];
} else {
    // Se o gerente não estiver autenticado, talvez você precise redirecionar para a página de login
    header("Location: index.php");
    exit(); // Certifique-se de sair do script após redirecionar
}

// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "banco";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

$id_gerente = $_SESSION['id_gerente']; // Supondo que você tenha o ID do gerente na sessão

$sql = "SELECT * FROM cliente WHERE id_gerente = $id_gerente"; // Ajuste o nome da coluna conforme necessário
$result = $conn->query($sql);

if (!$result) {
    echo "Erro na consulta: " . $conn->error;
    exit(); // Encerrar o script em caso de erro na consulta
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Clientes - Banco XYZ</title>
    <!-- Seus estilos CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width,initial-scale=1" />
</head>
<body class="page-home">

<header>
    <h1>Banco XYZ</h1>
    <nav class="header-content">
        <!-- Mensagem de boas-vindas -->
        <?php
        // Conexão com o banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "banco";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Falha na conexão com o banco de dados: " . $conn->connect_error);
        }

        // Obter o nome do gerente
        $id_gerente = $_SESSION['id_gerente'];

        $sql = "SELECT nome FROM gerente WHERE id = $id_gerente";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<p>Bem-vindo, " . $row['nome'] . "</p>";
        }
        ?>
        
        <!-- Botão de Sair -->
        
        <form class="logout-form" method="post" action="logout.php">
            <input type="submit" value="Sair">
        </form>
 
    </nav>
</header>

<div class="container">
    <h2>Lista de Clientes</h2>
    
    <!-- Seção de listagem de clientes -->
    <table>
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "banco";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Falha na conexão com o banco de dados: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM cliente WHERE id_gerente = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_gerente);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["nome"] . "</td>";
                    echo "<td class='actions'>";
                    echo "<a href='visualizar_cliente.php?cliente_id=" . $row["id"] . "'>Visualizar</a>";
                    echo "<a href='excluir_cliente.php?cliente_id=" . $row["id"] . "'>Excluir</a>";
                    echo "<a href='adicionar_cartao.php?cliente_id=" . $row["id"] . "'>Adicionar Cartão</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Nenhum cliente cadastrado.</td></tr>";
            }
            
        } else {
            echo "Erro na execução da consulta: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
        ?>
    </table>
    
    <!-- Botão para cadastrar novo cliente -->
    <a href="cadastro_cliente.php" class="new-client-button">Cadastrar Novo Cliente</a>
</div>

</body>
</html>
