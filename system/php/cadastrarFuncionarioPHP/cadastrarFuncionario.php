<?php
session_start();
include('../../conexao.php'); // Certifique-se de que o caminho está correto

// Verifique se os campos necessários foram preenchidos
if(empty($_POST['nomeCompleto']) || empty($_POST['cpf']) || empty($_POST['email'])){
    $_SESSION['mensagem'] = true;
    header('Location: ../indexCadastrarFuncionario.php');
    exit();
}

// Receba os dados do formulário
$nomeCompleto = strtoupper(mysqli_real_escape_string($conexao, $_POST['nomeCompleto'])); // Deixa o nome em maiúsculas
$cpf = preg_replace("/[^0-9]/", "", mysqli_real_escape_string($conexao, $_POST['cpf'])); // Remove pontos e traços do CPF
$email = mysqli_real_escape_string($conexao, $_POST['email']);

// Gere a senha usando os últimos 4 dígitos do CPF
$senha = substr($cpf, -4); // Extrai os últimos 4 dígitos do CPF

// Insira os dados no banco de dados, incluindo a senha gerada
$query = "INSERT INTO funcionario (pk_funcionario_cpf, nome, senha, email, data_do_registro, cargo) VALUES ('$cpf', '$nomeCompleto', MD5('$senha'), '$email', NOW(), 1);";

if(mysqli_query($conexao, $query)) {
    $_SESSION['mensagem'] = "Cadastro realizado com sucesso!";
    header('Location: ../indexCadastrarFuncionario.php');
} else {
    $_SESSION['mensagem'] = "Erro ao cadastrar: " . mysqli_error($conexao);
    header('Location: ../indexCadastrarFuncionario.php');
}
exit();
?>
