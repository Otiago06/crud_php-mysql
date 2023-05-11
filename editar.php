<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $id = $_POST["id"];
    $nome = trim(ucfirst($_POST["nome"]));
    $email = trim(strtolower($_POST["email"]));

    // Atualizar os dados na tabela usuarios
    $sql = "UPDATE usuarios SET nome='$nome', email='$email' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        // Redirecionar para a página inicial após a atualização
        header("Location: index.php");
        exit;
    } else {
        echo "Erro ao atualizar usuário: " . $conn->error;
    }
} else {
    // Obter o ID do usuário a ser editado
    $id = $_GET["id"];

    // Selecionar o registro do usuário com base no ID
    $sql = "SELECT * FROM usuarios WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Exibir o formulário de edição com os dados do usuário
        $row = $result->fetch_assoc();
        $nome = $row["nome"];
        $email = $row["email"];
    } else {
        // Se o ID não existir, redirecionar para a página inicial
        header("Location: index.php");
        exit;
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
    <h2>Editar Usuário</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo $nome; ?>"><br><br>
        <label>Email:</label>
        <input type="text" name="email" value="<?php echo $email; ?>"><br><br>
        <input type="submit" value="Atualizar">
        &nbsp;
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>