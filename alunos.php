<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js" defer></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</head>
<body>
    <?php
    session_start();
    include_once "header.php";
    require_once "conexao/conexao.php";
    $conexao = conectar();
    ?>

    <main class="container">
        <h1>Alunos</h1>
        <a href='crud/cadastrar_aluno.php' class="green waves-effect waves-light btn">
            <i class="material-icons right">add</i>Inserir
        </a>

        <table class="highlight">
            <thead>
                <tr>
                    <th>CPF</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Matrícula</th>
                    <th>Turma</th>
                    <th>Data Nascimento</th>
                    <th>Operação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT CPF, nome, email, matricula, turma, dataNasc FROM alunos";
                $resultado = mysqli_query($conexao, $sql);

                if ($resultado) {
                    while ($linha = mysqli_fetch_assoc($resultado)) {
                        $dataNasc = date('d/m/Y', strtotime($linha['dataNasc']));
                        ?>
                        <tr>
                            <td><?php echo $linha['CPF']; ?></td>
                            <td><?php echo $linha['nome']; ?></td>
                            <td><?php echo $linha['email']; ?></td>
                            <td><?php echo $linha['matricula']; ?></td>
                            <td><?php echo $linha['turma']; ?></td>
                            <td><?php echo $dataNasc; ?></td>
                            <td>
                                <a href="#modal<?php echo $linha['CPF']; ?>" class="btn-floating btn-small waves-effect waves-light red modal-trigger">
                                    <i class="material-icons">delete</i>
                                </a>
                                <!-- Modal Structure -->
                                <div id="modal<?php echo $linha['CPF']; ?>" class="modal">
                                    <div class="modal-content">
                                        <h2>Atenção!</h2>
                                        <p>Você confirma a exclusão do cliente: <?php echo $linha['nome']; ?>?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="excluir.php" method="POST">
                                            <input type="hidden" name="CPF" value="<?php echo $linha['CPF']; ?>">
                                            <button type="submit" name="btn-deletar" class="modal-action modal-close waves-red btn red darken-1">Excluir</button>
                                            <button type="button" class="modal-action modal-close btn waves-light green">Cancelar</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='8'>Erro ao buscar dados: " . mysqli_error($conexao) . "</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <br>
        <a href='relatorio.php' class="blue waves-effect waves-light btn">
            <i class="material-icons right">add</i>Gerar relatório
        </a>
        <a href='main.php' class="red 3 waves-effect waves-light btn right">
            <i class="material-icons right">arrow_back</i>Voltar
        </a>
    </main>
    <style>
    html, body {
    height: 100%; /* Faz com que o conteúdo ocupe 100% da altura da janela */
    margin: 0; /* Remove margens padrão */
    display: flex;
    flex-direction: column; /* Define direção da coluna para manter footer no final */
}

main {
    flex: 1; /* Faz o main crescer para ocupar o espaço restante */
}

footer {
    background-color: #4caf50; /* Cor de fundo do footer */
    color: white;
    text-align: center;
    padding: 10px 0;
    position: relative;
    bottom: 0;
    width: 100%;
}
</style>
    <?php
include_once"footer.php";
?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelectorAll('.modal');
            M.Modal.init(elems, {
                opacity: 0.7,
                inDuration: 100,
                outDuration: 120,
                dismissible: true,
                startingTop: '10%',
                endingTop: '15%'
            });
        });
    </script>



</body>

</html>
