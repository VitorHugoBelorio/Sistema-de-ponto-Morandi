<?php
session_start();
include('../../conexao.php'); // Certifique-se de que o caminho está correto

if(empty($_POST['email']) || empty($_POST['senha'])){
    header('Location: ../../index.php');
    exit();
}

$email = mysqli_real_escape_string($conexao, $_POST['email']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

$query = "SELECT email, senha, cargo FROM funcionario WHERE email = '{$email}' AND senha = MD5('{$senha}');";
$result = mysqli_query($conexao, $query);
$row = mysqli_fetch_assoc($result);

if ($row) {
    $_SESSION['email'] = $email;
    $_SESSION['cargo'] = $row['cargo']; // Armazena o valor binário do cargo na sessão
    // $_SESSION['nome'] = $row['nome']; // -> usar para personalizar depois (entrar na home e dizer "olá, fulano").

    // Verifica o cargo e redireciona para a tela correspondente
    if ($row['cargo'] == 1) {
        header('Location: ../indexHomeOrganizador.php');
    } else {
        header('Location: ../indexHomeFuncionario.php');
    }
    exit();
} else {
    $_SESSION['nao_autenticado'] = true;
    header('Location: ../../index.php');
    exit();
}
?>
