<?php
session_start();
include('../../conexao.php'); // Certifique-se de que o caminho está correto

// Verifique se os campos necessários foram preenchidos
if(empty($_POST['nomeCompleto']) || empty($_POST['cpf']) || empty($_POST['email'])){
    $_SESSION['mensagem'] = "Preencha todos os campos obrigatórios.";
    header('Location: ../indexCadastrarFuncionario.php');
    exit();
}

// Receba os dados do formulário
$nomeCompleto = strtoupper(mysqli_real_escape_string($conexao, $_POST['nomeCompleto'])); // Deixa o nome em maiúsculas
$cpf = preg_replace("/[^0-9]/", "", mysqli_real_escape_string($conexao, $_POST['cpf'])); // Remove pontos e traços do CPF
$email = mysqli_real_escape_string($conexao, $_POST['email']);

// Gere a senha usando os últimos 4 dígitos do CPF
$senha = substr($cpf, -4); // Extrai os últimos 4 dígitos do CPF

// Inserir o registro na tabela 'funcionario'
$queryFuncionario = "INSERT INTO funcionario (funcionario_cpf, nome, senha, email, data_do_registro, cargo) VALUES ('$cpf', '$nomeCompleto', MD5('$senha'), '$email', NOW(), 'FUNCIONARIO')";

if (mysqli_query($conexao, $queryFuncionario)) {
    // Obtém o ID gerado na tabela 'funcionario' para usar como chave estrangeira em 'geral'
    $idFuncionario = mysqli_insert_id($conexao);

    // Insere os dados na tabela 'geral' com a referência ao ID do funcionário
    $queryGeral = "INSERT INTO geral (id_funcionario, cpf, nome, senha, email, data_do_registro, cargo) VALUES ('$idFuncionario', '$cpf', '$nomeCompleto', MD5('$senha'), '$email', NOW(), 'FUNCIONARIO')";

    if (mysqli_query($conexao, $queryGeral)) {
        $_SESSION['mensagem'] = "Cadastro realizado com sucesso!";
    } else {
        $_SESSION['mensagem'] = "Erro ao cadastrar na tabela 'geral': " . mysqli_error($conexao);
    }
} else {
    $_SESSION['mensagem'] = "Erro ao cadastrar na tabela 'funcionario': " . mysqli_error($conexao);
}

header('Location: ../indexCadastrarFuncionario.php');
exit();
?>
