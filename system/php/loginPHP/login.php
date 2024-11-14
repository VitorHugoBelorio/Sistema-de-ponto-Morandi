<?php
session_start();
include('../../conexao.php'); // Certifique-se de que o caminho está correto

if (empty($_POST['email']) || empty($_POST['senha'])) {
    header('Location: ../../index.php');
    exit();
}

$email = mysqli_real_escape_string($conexao, $_POST['email']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

$query = "SELECT email, senha, cargo FROM geral WHERE email = '{$email}' AND senha = MD5('{$senha}');";
$result = mysqli_query($conexao, $query);
$row = mysqli_fetch_assoc($result);

if ($row) {
    $_SESSION['email'] = $email;
    $_SESSION['cargo'] = $row['cargo']; // Armazena o cargo do usuário na sessão

    // Verifica o cargo e redireciona para a tela correspondente
    if ($row['cargo'] == 'ORGANIZADOR') {
        header('Location: ../indexHomeOrganizador.php');
    } elseif ($row['cargo'] == 'FUNCIONARIO') {
        header('Location: ../indexHomeFuncionario.php');
    } elseif ($row['cargo'] == 'DIRETOR') {
        header('Location: ../indexHomeDiretor.php');
    }
    exit();
} else {
    $_SESSION['nao_autenticado'] = true;
    header('Location: ../../index.php');
    exit();
}
?>
