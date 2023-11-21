<!DOCTYPE html>
<html>
<head>
    <title>Excluir Cliente - Banco XYZ</title>
    <link rel="stylesheet" type="text/css" href="style.css"> <!-- Seus estilos CSS -->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
</head>
<body class="page-excluir-cliente">

<header>
    <h1>Banco XYZ</h1>
    <nav class="header-content">
        
    </nav>
</header>

<div class="container">
    <?php
    // Verifica se o ID do cliente foi recebido via GET
    if (isset($_GET['cliente_id'])) {
        $cliente_id = $_GET['cliente_id'];
        ?>
        <p>Tem certeza de que deseja excluir este cliente?</p>
        <form method="post" action="processar_exclusao.php">
            <input type="hidden" name="cliente_id" value="<?php echo $cliente_id; ?>">
            <input type="submit" value="Confirmar Exclusão">
        </form>
        <?php
    } else {
        echo "<p>Nenhum ID de cliente recebido para exclusão.</p>";
    }
    ?>
    <a href="home.php">Voltar para Lista de Clientes</a>
</div>

</body>
</html>
