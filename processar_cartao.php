
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cliente_id']) && isset($_POST['numero_cartao'])) {
        $cliente_id = $_POST['cliente_id'];
        $numero_cartao = $_POST['numero_cartao'];

        // Conexão com o banco de dados (substitua pelos seus dados)
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "banco";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Falha na conexão com o banco de dados: " . $conn->connect_error);
        }

        // Prepara a consulta para inserir o cartão associado ao cliente
        $sql_insert_cartao = "INSERT INTO cartao (numero_cartao) VALUES (?)";
        $stmt_insert_cartao = $conn->prepare($sql_insert_cartao);

        if ($stmt_insert_cartao) {
            $stmt_insert_cartao->bind_param("s", $numero_cartao);

            if ($stmt_insert_cartao->execute()) {
                // Obtém o ID do cartão recém-inserido
                $cartao_id = $stmt_insert_cartao->insert_id;

                // Atualiza a tabela cliente com o ID do cartão associado
                $sql_update_cliente = "UPDATE cliente SET id_cartao = ? WHERE id = ?";
                $stmt_update_cliente = $conn->prepare($sql_update_cliente);

                if ($stmt_update_cliente) {
                    $stmt_update_cliente->bind_param("ii", $cartao_id, $cliente_id);

                    if ($stmt_update_cliente->execute()) {
                        echo "<p>Cartão adicionado e associado ao cliente com sucesso.</p>";
                        header("Location: home.php");
                    } else {
                        echo "<p>Erro ao associar o cartão ao cliente: " . $stmt_update_cliente->error . "</p>";
                    }

                    $stmt_update_cliente->close();
                } else {
                    echo "<p>Erro na preparação da consulta para associar o cartão ao cliente: " . $conn->error . "</p>";
                }
            } else {
                echo "<p>Erro ao adicionar o cartão: " . $stmt_insert_cartao->error . "</p>";
            }

            $stmt_insert_cartao->close();
        } else {
            echo "<p>Erro na preparação da consulta para adicionar o cartão: " . $conn->error . "</p>";
        }

        $conn->close();
    } else {
        echo "<p>Dados incompletos para adicionar o cartão.</p>";
    }
} else {
    echo "<p>Acesso inválido.</p>";
}
?>
