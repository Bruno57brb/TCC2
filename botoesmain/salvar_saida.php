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
    $tipo = $_POST['tipo'];

    // Conectando ao banco de dados
    $conexao = conectar();


    $stmt = $conexao->prepare("INSERT INTO registros (nome, data, horario, turma, motivo, matricula, tipo) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die('Erro ao preparar a query: ' . $conexao->error);
    }

    // Bind dos parâmetros
    $stmt->bind_param('sssssss', $nome, $data, $horario, $turma, $motivo, $matricula, $tipo);

    // Executa a query
    if ($stmt->execute()) {
        echo "Saída registrada com sucesso!";
    } else {
        echo "Erro ao registrar saída: " . $stmt->error;
    }

    // Fecha o statement e a conexão
    $stmt->close();
    $conexao->close();
}
?>
