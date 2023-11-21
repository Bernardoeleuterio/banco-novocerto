<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cliente_id'])) {
        $cliente_id = $_POST['cliente_id'];

        // Conexão com o banco de dados (substitua pelos seus dados)
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "banco";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Falha na conexão com o banco de dados: " . $conn->connect_error);
        }

        // Prepara a consulta para excluir o cliente
        $sql = "DELETE FROM cliente WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $cliente_id);

        if ($stmt->execute()) {
            echo "<p>Cliente excluído com sucesso.</p>";
            header("Location: home.php"); // Redirecionamento para a página home.php após a exclusão
            exit(); // Certifique-se de sair após o redirecionamento
            
        } else {
            echo "<p>Erro ao excluir o cliente: " . $stmt->error . "</p>";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "<p>Nenhum ID de cliente recebido para exclusão.</p>";
    }
} else {
    echo "<p>Acesso inválido.</p>";
}
?>
