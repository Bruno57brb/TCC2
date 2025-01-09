<?php
// Conectar ao BD
include ("conexao.php");

// Consultar dados no banco de dados
$sql = "SELECT * FROM usuario";
$result = mysqli_query($conexao, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Listagem de Usuários</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

<h2>Listagem de Usuários</h2>

<table>
    <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Matrícula</th>
        <th>Telefone</th>
    </tr>
    <?php
    if (mysqli_num_rows($result) > 0) {
        // Output de dados de cada linha
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["nome"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["matricula"] . "</td>";
            echo "<td>" . $row["telefone"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Nenhum usuário encontrado</td></tr>";
    }
    ?>
</table>

</body>
</html>
