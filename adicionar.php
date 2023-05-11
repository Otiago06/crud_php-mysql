<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $nome = trim(ucfirst($_POST["nome"]));
    $email = trim(strtolower($_POST["email"]));

    // Inserir os dados na tabela usuarios
    $sql = "INSERT INTO usuarios (nome, email) VALUES ('$nome', '$email')";
    
    if ($conn->query($sql) === TRUE) {
        // Redirecionar para a página inicial após a inserção
        header("Location: index.php");
        exit;
    } else {
        echo "Erro ao adicionar usuário: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD em PHP/MySQL</title>
</head>
<body>
    <h2>Adicionar Usuário</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label>Nome:</label>
        <input type="text" name="nome" required><br><br>
        <label>Email:</label>
        <input type="text" name="email" required><br><br>
        <input type="submit" value="Adicionar">
        &nbsp;
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>