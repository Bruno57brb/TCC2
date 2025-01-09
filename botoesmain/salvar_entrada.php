
<?php
include '../conexao/conexao.php'; // Inclua sua conexão ao banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtendo os dados do formulário
    $nome = $_POST['nome'];
    $data = $_POST['data'];
    $horario = $_POST['horario'];
    $turma = $_POST['turma']; 
    $motivo = $_POST['motivo'];
    $matricula = $_POST['matricula'];
 


    // Conectando ao banco de dados
    $conexao = conectar();

 
    $stmt = $conexao->prepare("INSERT INTO registros (nome, data, horario,  turma, motivo, matricula) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die('Erro ao preparar a query: ' . $conexao->error);
    }

    // Bind dos parâmetros
    $stmt->bind_param('ssssss', $nome, $data, $horario,  $turma, $motivo, $matricula); // Alterado para incluir dois parâmetros adicionais

    // Executa a query
    if ($stmt->execute()) {
        echo "Entrada registrada com sucesso!";
    } else {
        echo "Erro ao registrar entrada: " . $stmt->error;
    }

    // Fecha o statement e a conexão
    $stmt->close();
    $conexao->close();
}
?>
