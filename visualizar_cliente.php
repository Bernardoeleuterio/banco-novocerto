<!DOCTYPE html>
<html>
<head>
    <title>Visualizar Cliente - Banco XYZ</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
    session_start();

    // Verifica se o gerente está logado
    if (!isset($_SESSION['nome_gerente'])) {
        header("Location: login.php"); // Redireciona para a página de login se não estiver logado
        exit();
    }

    // Verifica se o ID do cliente foi fornecido via GET
    if (isset($_GET['cliente_id'])) {
        $cliente_id = $_GET['cliente_id'];

        // Conexão com o banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "banco";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Falha na conexão com o banco de dados: " . $conn->connect_error);
        }

        // Recupera informações do cliente pelo ID
        $sql = "SELECT * FROM cliente WHERE id = $cliente_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $cliente_nome = $row['nome'];
            $cliente_email = $row['email'];
            $cliente_cpf = $row['cpf'];
            $cliente_telefone = $row['telefone'];
            $id_cartao = isset($row['id_cartao']) ? $row['id_cartao'] : null;
            
            
            if ($id_cartao !== null) {
                $sql_cartao = "SELECT numero_cartao FROM cartao WHERE id = $id_cartao";
                $result_cartao = $conn->query($sql_cartao);
        
                if ($result_cartao->num_rows > 0) {
                    $row_cartao = $result_cartao->fetch_assoc();
                    $numero_cartao = $row_cartao['numero_cartao'];
                } else {
                    $numero_cartao = "N/A";
                }
            } else {
                $numero_cartao = "N/A"; // Define como "N/A" caso o ID do cartão não esteja definido para o cliente
            }
        
            // Adicione outras informações que deseja exibir
            $cpf_formatado = substr($cliente_cpf, 0, 3) . '.' . substr($cliente_cpf, 3, 3) . '.' . substr($cliente_cpf, 6, 3) . '-' . substr($cliente_cpf, -2);
            $telefone_formatado = '(' . substr($cliente_telefone, 0, 2) . ') ' . substr($cliente_telefone, 2, 5) . '-' . substr($cliente_telefone, -4);
            $numero_cartao_formatado = chunk_split($numero_cartao, 4, ' ');
            $numero_cartao_formatado = trim($numero_cartao_formatado); // Remove espaços em branco extras no final, se houver

        } else {
            echo "Cliente não encontrado.";
            exit();
        }
    } else {
        echo "ID do cliente não fornecido.";
        exit();
    }
    ?>

    <div class="container">
        <h2>Informações do Cliente</h2>
        <p><strong>ID:</strong> <?php echo $cliente_id; ?></p>
        <p><strong>Nome:</strong> <?php echo $cliente_nome; ?></p>
        <p><strong>Email:</strong> <?php echo $cliente_email; ?></p>
        <p><strong>Cpf:</strong> <?php echo $cpf_formatado; ?></p>
        <p><strong>Telefone:</strong> <?php echo $telefone_formatado; ?></p>
        <p><strong>Cartão:</strong> <?php echo $numero_cartao_formatado; ?></p>
        <!-- Adicione outras informações aqui -->

        <a href="home.php">Voltar para Lista de Clientes</a>
    </div>
</body>
</html>
