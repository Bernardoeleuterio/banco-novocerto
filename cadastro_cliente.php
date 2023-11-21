<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Cliente - Banco XYZ</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="scripts.js"></script>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
</head>
<body class="page-cadastro-cliente">

<header>
    <h1>Cadastro de Cliente</h1>
    <!-- Adicione aqui a lógica para exibir o nome do gerente se necessário -->
</header>

<div class="container">
    <form method="post" action="processar_cadastro.php">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="telefone">Telefone:</label>
        <input type="tel" id="telefone" name="telefone" required>

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required><br>

        <!-- Outros campos e validações podem ser adicionados conforme necessário -->
        <br>

        <input type="submit" value="Cadastrar">
    </form>
    <a href="home.php">Voltar para Lista de Clientes</a>
</div>
<script> 

    // Função para remover caracteres não numéricos
    // Função para remover caracteres não numéricos
function removeNonNumericChars(input) {
    return input.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
}

document.getElementById('telefone').addEventListener('input', function (e) {
    var input = e.target;
    var value = input.value.replace(/\D/g, ''); // Remove não dígitos
    if (value.length <= 10) {
        input.value = value.replace(/^(\d{2})(\d{4})(\d{4})/, '($1) $2-$3'); // Formato para telefone
    } else {
        input.value = value.substring(0, 11).replace(/^(\d{2})(\d{5})(\d{4})/, '($1) $2-$3'); // Limita a 11 dígitos e formata
    }
});

document.getElementById('cpf').addEventListener('input', function (e) {
    var input = e.target;
    input.value = input.value.replace(/\D/g, ''); // Remove caracteres não numéricos

    // Limita o tamanho máximo do CPF
    var value = input.value.substring(0, 11);

    // Formatação do CPF
    if (value.length > 3 && value.length <= 6) {
        input.value = value.replace(/^(\d{3})(\d{1,3})/, '$1.$2');
    } else if (value.length > 6 && value.length <= 9) {
        input.value = value.replace(/^(\d{3})(\d{3})(\d{1,3})/, '$1.$2.$3');
    } else if (value.length > 9 && value.length <= 11) {
        input.value = value.replace(/^(\d{3})(\d{3})(\d{3})(\d{1,2})/, '$1.$2.$3-$4');
    } else {
        input.value = value; // Se for maior que 11 caracteres, mantém apenas os 11 primeiros
    }
});

// Função para formatar e remover caracteres não numéricos antes do envio do formulário
document.querySelector('form').addEventListener('submit', function (e) {
    var cpfInput = document.getElementById('cpf');
    cpfInput.value = removeNonNumericChars(cpfInput.value); // Remove caracteres não numéricos antes de enviar
});

document.querySelector('form').addEventListener('submit', function (e) {
    var telefoneInput = document.getElementById('telefone');
    telefoneInput.value = removeNonNumericChars(telefoneInput.value); // Remove caracteres não numéricos antes de enviar
});

</script>
</body>
</html>


