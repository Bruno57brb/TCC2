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
                    <form action="cadastrar-servidor.php" method="POST">
                        <h5 class="center-align">CADASTRAR-SE</h5>

                        <div class="input-field">
                            <input type="text" id="nome" name="Nome" class="validate" required autofocus>
                            <label for="nome">Nome</label>
                        </div>
                        <div class="input-field">
                            <input type="text" id="SIAPE" name="SIAPE" class="validate" required>
                            <label for="SIAPE">SIAPE</label>
                        </div>

                        <div class="input-field">
                            <input type="Email" id="Email" name="Email" class="validate" required>
                            <label for="Email">Email</label>
                        </div>
                        <div class="input-field senha-container">
                            <input type="password" id="senha" name="Senha" class="validate" required>
                            <label for="senha">Senha</label>
                            <img id="olho" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABDUlEQVQ4jd2SvW3DMBBGbwQVKlyo4BGC4FKFS4+TATKCNxAggkeoSpHSRQbwAB7AA7hQoUKFLH6E2qQQHfgHdpo0yQHX8T3exyPR/ytlQ8kOhgV7FvSx9+xglA3lM3DBgh0LPn/onbJhcQ0bv2SHlgVgQa/suFHVkCg7bm5gzB2OyvjlDFdDcoa19etZMN8Qp7oUDPEM2KFV1ZAQO2zPMBERO7Ra4JQNpRa4K4FDS0R0IdneCbQLb4/zh/c7QdH4NL40tPXrovFpjHQr6PJ6yr5hQV80PiUiIm1OKxZ0LICS8TWvpyyOf2DBQQtcXk8Zi3+JcKfNafVsjZ0WfGgJlZZQxZjdwzX+ykf6u/UF0Fwo5Apfcq8AAAAASUVORK5CYII=" />
                        </div>

                        <div class="input-field">
                            <select id="Perfil" name="Perfil" required>
                                <option value="" disabled selected>Selecione a Categoria</option>
                                <option value="1">Coordenação</option>
                                <option value="2">Nutricionista</option>
                                <option value="3">Psicóloga</option>
                                <option value="4">enfermeira</option>
                                <option value="5">Médico</option>
                            </select>
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
    $SIAPE = mysqli_real_escape_string($conexao, $_POST['SIAPE']);
    $email = mysqli_real_escape_string($conexao, $_POST['Email']);
    $senha = mysqli_real_escape_string($conexao, $_POST['Senha']);
    $perfil = mysqli_real_escape_string($conexao, $_POST['Perfil']);

    // Hash da senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Inserir no banco de dados
    $sql = "INSERT INTO usuario (Nome, SIAPE, Email, senha, Perfil) VALUES ('{$nome}', '{$SIAPE}', '{$email}', '{$senha_hash}', '{$perfil}')";
    
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
    <script>
        // Função para mostrar o formulário de cadastro
    
      

        $(document).ready(function() {
            $('#olho').click(function(e) {
                e.preventDefault();
                var senha = $('#senha');

                if (senha.attr('type') === 'password') {
                    senha.attr('type', 'text');
                    $(this).css('opacity', '0.8');
                } else {
                    senha.attr('type', 'password');
                    $(this).css('opacity', '0.6');
                }
            });

            // Inicialização do seletor
            $('select').formSelect();
        });
    </script>
</body>

</html>
</body>

</html>