<!DOCTYPE html>
<html>
<head>
    <title>Adicionar Cartão - Banco XYZ</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width,initial-scale=1" />
</head>
<body class="page-adicionar-cartao">

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
    } else {
        echo "<p>Nenhum ID de cliente recebido para associar o cartão.</p>";
        exit(); // Encerra o script se não houver ID de cliente
    }
    
    ?>

    <h2>Adicionar Cartão</h2>

    <form method="post" action="processar_cartao.php" onsubmit="formatAndSubmit(event)">
        <input type="hidden" name="cliente_id" value="<?php echo $cliente_id; ?>">
        <label for="numero_cartao">Número do Cartão:</label>
        <input type="text" id="numero_cartao" name="numero_cartao" required maxlength="16" onkeypress="return isNumberKey(event)">
        <input type="submit" value="Adicionar Cartão">
    </form>

    <a href="home.php">Voltar para Lista de Clientes</a>
</div>

<script>
    // Função para permitir apenas números no campo
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }

    // Função para formatar o número do cartão e enviar apenas os números do cartão
    function formatAndSubmit(event) {
        event.preventDefault(); // Previne o envio padrão do formulário
        var cardInput = document.getElementById('numero_cartao');
        var cardNumber = cardInput.value.replace(/\D/g, ''); // Remove não dígitos
        var formattedNumber = '';

        // Formatação do número do cartão (adapte conforme necessário)
        for (var i = 0; i < cardNumber.length; i++) {
            if (i > 0 && i % 4 === 0) {
                formattedNumber += ' '; // Adiciona um espaço a cada 4 dígitos
            }
            formattedNumber += cardNumber.charAt(i);
        }

        cardInput.value = formattedNumber.trim(); // Atualiza o valor no campo

        // Remove espaços em branco antes de enviar o formulário
        cardInput.value = cardNumber;

        // Envio do formulário
        cardInput.form.submit(); // Envia o formulário após a formatação e remoção de espaços
    }
</script>

</body>
</html>
