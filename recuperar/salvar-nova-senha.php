<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado da Recuperação</title>
    <!-- Importando o Materialize CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <!-- Ícones do Materialize -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body class="green lighten-4">
    <div class="container">
        <div class="row center-align" style="margin-top: 50px;">
            <div class="col s12 m8 offset-m2">
                <div class="card z-depth-3">
                    <div class="card-content">
                        <span class="card-title green-text text-darken-3">Recuperação de Senha</span>
                        <div class="result-message">
                            <?php
                            $email = $_POST['email'];
                            $token = $_POST['token'];
                            $senha = $_POST['senha'];
                            $repetirSenha = $_POST['repetirSenha'];

require_once "conexao.php";
$conexao = conectar();
$sql = "SELECT * FROM `recuperar_senha` WHERE email='$email' AND token='$token'";
$resultado = executarSQL($conexao, $sql);
$recuperar = mysqli_fetch_assoc($resultado);

if ($recuperar == null) {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Erro!',
            text: 'Email ou token incorreto. Tente fazer um novo pedido de recuperação de senha.',
            confirmButtonText: 'Ok'
        }).then(() => {
            window.location.href = '../index.php';
        });
    </script>";
    die();
}

// Verificar a validade do pedido (data_criacao) e se já foi usado
date_default_timezone_set('America/Sao_Paulo');
$agora = new DateTime('now');
$data_criacao = DateTime::createFromFormat('Y-m-d H:i:s', $recuperar['data_criacao']);
$umDia = DateInterval::createFromDateString('1 day');
$dataExpiracao = date_add($data_criacao, $umDia);

if ($agora > $dataExpiracao) {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Link expirado!',
            text: 'Essa solicitação de recuperação de senha expirou! Faça um novo pedido de recuperação de senha.',
            confirmButtonText: 'Ok'
        }).then(() => {
            window.location.href = '../index.php';
        });
    </script>";
    die();
}

if ($recuperar['usado'] == 1) {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Link já utilizado!',
            text: 'Esse pedido de recuperação de senha já foi utilizado anteriormente! Para recuperar a senha faça um novo pedido de recuperação de senha.',
            confirmButtonText: 'Ok'
        }).then(() => {
            window.location.href = '../index.php';
        });
    </script>";
    die();
}

if ($senha != $repetirSenha) {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Erro!',
            text: 'As senhas não conferem. Por favor, tente novamente.',
            confirmButtonText: 'Ok'
        }).then(() => {
            window.history.back();
        });
    </script>";
    die();
}

// Atualizar a senha e marcar o token como usado
$sql2 = "UPDATE usuario SET senha='$senha' WHERE email='$email'";
executarSQL($conexao, $sql2);

$sql3 = "UPDATE `recuperar_senha` SET usado=1 WHERE email='$email' AND token='$token'";
executarSQL($conexao, $sql3);

echo "
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Sucesso!',
        text: 'Sua senha foi alterada com sucesso! Agora você pode fazer login no sistema.',
        confirmButtonText: 'Ok'
    }).then(() => {
        window.location.href = '/tcc/login.php';
    });
</script>";
?>
