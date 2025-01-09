<?php
include("conecta.php");

$id = $_GET['id'];


//define a pasta para onde enviaremos o arquivo
$diretorio = "img/";

$sql = "SELECT * FROM lista WHERE idLista=$id";
$resultado = mysqli_query($conexao, $sql);
$lista = mysqli_fetch_assoc($resultado);

unlink($diretorio . $lista['imagem']);
$sql = "DELETE FROM lista WHERE idLista = $id";
mysqli_query($conexao, $sql);


header('Location: listar.php');
