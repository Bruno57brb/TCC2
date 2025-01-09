<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="../css/login.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" href="../img/user.png">
    <link href="../css/bootstrap.css" rel="stylesheet">

    <title>LOGIN</title>
    <style>
 <?php
     include_once"../css/cadastrar_servidor.css";
   ?>
   </style>
</s>

<body>
    <header>
        <div class="header-container">
            <div class="header-text">
                <h1>SIGAE</h1>
                <p>Sistema Integrado de Gerenciamento da Assistência Estudantil</p>
            </div>
            <div class="header-logo">
                <img class="right" src="../img/assistencia_estudantil.png" alt="Logo da Assistência Estudantil">
            </div>
        </div>
    </header>
       <!-- Formulário de Cadastro -->
    <div class="cad-container">
        <div class="cad-box">
               
                <div class="col s12 m8 offset-m2 l6 offset-l3">
                    <form action="cadastrar-aluno.php" method="POST">
                        <h5 class="center-align">CADASTRARO DE ALUNO</h5>

                        <div class="input-field">
                            <input type="text" id="nome" name="Nome" class="validate" required autofocus>
                            <label for="nome">Nome</label>
                        </div>
                        <div class="input-field">
                            <input type="text" id="matricula" name="matricula" class="validate" required>
                            <label for="matricula">matricula</label>
                        </div>

                        <div class="input-field">
                            <input type="Email" id="Email" name="Email" class="validate" required>
                            <label for="Email">Email</label>
                        </div>
                        <div class="input-field">
                            <input type="text" id="turma" name="turma" class="validate" required>
                            <label for="turma">turma</label>
                        </div>
                        <div class="input-field">
                            <input type="text" id="CPF" name="CPF" class="validate" required>
                            <label for="CPF">CPF</label>
                        </div>
                        <div class="input-field">
                            <input type="date" id="dataNasc" name="dataNasc" class="validate" required>
                            <label for="dataNasc">data de nascimento</label>
                        </div>
              

                        <div class="row">
                            <div class="col s12">
                                <button type="submit" class="btn waves-effect waves-light blue">Cadastrar</button>
                            </div>
                            <div class="col s12">
                                <a href="../main.php" class="btn waves-effect waves-light green" onclick="showLogin()">voltar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<<?php
// Conexão com o banco de dados
$conexao = mysqli_connect("localhost", "root", "", "assistencia");

// Verifica se a conexão foi bem-sucedida
if (!$conexao) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Verifica se o método de requisição é POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Escapa as entradas para evitar SQL Injection
    $nome = mysqli_real_escape_string($conexao, $_POST['Nome']);
    $matricula = mysqli_real_escape_string($conexao, $_POST['matricula']);
    $email = mysqli_real_escape_string($conexao, $_POST['Email']);
    $turma = mysqli_real_escape_string($conexao, $_POST['turma']);
    $CPF = mysqli_real_escape_string($conexao, $_POST['CPF']);




    // Inserir no banco de dados
    $sql = "INSERT INTO usuario (Nome, matricula, Email, turma, CPF) VALUES ('{$nome}', '{$matricula}', '{$email}', '{$turma}', '{$CPF}')";
    
    if (mysqli_query($conexao, $sql)) {
        echo "Usuário registrado com sucesso!";
    } else {
        echo "Erro ao registrar usuário: " . mysqli_error($conexao);
    }
}

// Fecha a conexão
mysqli_close($conexao);
?>
    <?php include_once "../footer2.php"; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</body>

</html>
</body>

</html>