<?php
include 'conexao.php';

// Selecionar todos os registros da tabela usuarios
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);
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
    <?php echo date("d/m/Y H:i:s"); ?>
    <?php
      if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
      }
    ?>
    <h2>Lista de Usuários</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Cadastrado em:</th>
            <th>Ações</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Exibir os registros na tabela
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nome"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . date("d/m/Y H:i:s", strtotime($row["create"])). "</td>";
                echo "<td>
                        <a href='editar.php?id=" . $row["id"] . "'>Editar</a> |
                        <a href='excluir.php?id=" . $row["id"] . "'>Excluir</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nenhum usuário encontrado.</td></tr>";
        }
        ?>
    </table>
    <br>
    <a href="adicionar.php">Adicionar novo usuário</a>
</body>
</html>
