<?php
include '../conexao/conexao.php';

$conexao = conectar();

$busca = isset($_GET['busca']) ? $_GET['busca'] : '';

// Montar a consulta
$sql = "SELECT nome, matricula, turma, tipo, data, horario, motivo FROM registros WHERE 1";
if (!empty($busca)) {
    $sql  .=" AND (nome LIKE '%$busca%' OR matricula LIKE '%$busca%' OR turma LIKE '%$busca%')";
}
$sql .= " ORDER BY nome ASC";

// Executar a consulta
$resultado = mysqli_query($conexao, $sql);

// Verificar erro
if (!$resultado) {
    echo json_encode(['erro' => mysqli_error($conexao)]);
    exit;
}

// Retornar os dados
$dados = [];
while ($linha = mysqli_fetch_assoc($resultado)) {
    $dados[] = $linha;
}
echo json_encode($dados);


