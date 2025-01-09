<?php
include '../conexao/conexao.php';

$conexao = conectar();

$matricula = isset($_GET['matricula']) ? $_GET['matricula'] : '';

// Obter a data atual no formato YYYY-MM-DD
$dataAtual = date('Y-m-d');

// Montar a consulta
$sql = "SELECT nome, matricula, turma, cpf
        FROM alunos 
        WHERE matricula = '$matricula'"; // Filtrar pelo dia atual




// Executar a consulta
$resultado = mysqli_query($conexao, $sql);

// Retornar os dados
$dados = [];
while ($linha = mysqli_fetch_assoc($resultado)) {
    $dados = $linha;
}
echo json_encode($dados);