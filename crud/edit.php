<?php

// Conectar ao BD
include ("conexao.php");

// receber os dados do formulário
$nome = $_POST['username'];
$senha = $_POST['senha'];


//cadastra no banco
$sql = "UPDATE usuario SET 
    nome = '$nome', senha = '$senha',  WHERE matricula = $matricula";

if (mysqli_query($conexao, $sql)) {
  echo "<script>
  Swal.fire({
      icon: 'success',
      title: 'Sucesso Usuario Cadastrado ',
      test: 'pessoa cdastrada com sucesso',
      showConfirmButton: false,
      timer: 1500
    }).then(() =>{
      window.location.href='../index.php';
  });</script> ";
    exit();
  }else{
      echo "<script>
      Swal.fire({
          icon: 'error',
          title: 'Erro ao cadastrar',
          test: 'falha ao cadastrar',
          showConfirmButton: false,
          timer: 1500
        }).then(() =>{
          window.location.href='../index.php';
      });</script> ";
        exit();
      
  }

header('location: index.php');

