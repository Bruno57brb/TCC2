<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>Cadastrar Usuário</title>
</head>
<body>
</body>
</html>

<?php
// Verificar se todos os dados foram enviados pelo formulário
if (isset($_POST['Nome'], $_POST['matricula'], $_POST['Email'], $_POST['turma'], $_POST['CPF'])) {
    // Receber os dados do formulário
    $Nome = $_POST['Nome'];
    $matricula = $_POST['matricula'];
    $Email = $_POST['Email'];
    $turma = $_POST['turma'];
    $CPF = $_POST['CPF'];  
    $dataNasc = $_POST['dataNasc'];

    // Conectar ao BD
    require_once "../conexao/conexao.php";
    $conexao = conectar();

    // Preparar a consulta para verificar se o usuário já existe
    $stmt = $conexao->prepare("SELECT * FROM alunos WHERE matricula = ?");
    $stmt->bind_param("s", $matricula); // 's' indica que o parâmetro é uma string
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o usuário já existe
    if ($result->num_rows > 0) {
        echo "Usuário já existe.";
    } else {



        // Preparar a consulta para inserir o novo usuário
        $stmt = $conexao->prepare("INSERT INTO alunos (Nome, matricula, Email, turma, CPF, dataNasc) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $Nome, $matricula, $Email, $turma, $CPF, $dataNasc); // 's' indica que todos os parâmetros são strings





        
        // Executar a inserção
        if ($stmt->execute()) {
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Sucesso! Usuário Cadastrado',
                text: 'Pessoa cadastrada com sucesso.',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = '../main.php';
            });
            </script>";
        } else {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Erro ao cadastrar',
                text: 'Falha ao cadastrar.',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = '../cadastrar_aluno.php'; // Redireciona de volta para o formulário
            });
            </script>";
        }
    }

    // Fecha o statement
    $stmt->close();
    // Fecha a conexão
    $conexao->close();
} 
?>