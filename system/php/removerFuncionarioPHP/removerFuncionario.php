<?php
session_start();
include('../../conexao.php');

// Verifica se a requisição veio pelo POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['erro_remocao'] = "Requisição inválida.";
    header('Location: ../indexRemoveFuncionario.php');
    exit();
}

// Verifica se o CPF foi enviado pelo formulário
if (empty($_POST['cpf'])) {
    $_SESSION['erro_remocao'] = "CPF não pode estar vazio.";
    header('Location: ../indexRemoverFuncionario.php');
    exit();
}

// Remove caracteres não numéricos do CPF
$cpf = preg_replace('/\D/', '', $_POST['cpf']);

// Verifica se o CPF está no formato correto (11 dígitos)
if (strlen($cpf) !== 11) {
    $_SESSION['erro_remocao'] = "CPF inválido. Certifique-se de digitar 11 números.";
    header('Location: ../indexRemoveFuncionario.php');
    exit();
}

// Sanitiza o input
$cpf = mysqli_real_escape_string($conexao, $cpf);

// Inicia uma transação para consistência no banco de dados
mysqli_begin_transaction($conexao);

try {
    // Verifica se o funcionario existe
    $query_busca = "SELECT pk_id_funcionario FROM funcionario WHERE funcionario_cpf = '{$cpf}'";
    $result_busca = mysqli_query($conexao, $query_busca);

    if (mysqli_num_rows($result_busca) === 0) {
        $_SESSION['erro_remocao'] = "funcionario não encontrado.";
        header('Location: ../indexRemoveFuncionario.php');
        exit();
    }

    $funcionario = mysqli_fetch_assoc($result_busca);
    $id_funcionario = $funcionario['pk_id_funcionario'];

    // Exclui o funcionario das tabelas
    $query_geral = "DELETE FROM geral WHERE id_funcionario = '{$id_funcionario}'";
    if (!mysqli_query($conexao, $query_geral)) {
        throw new Exception("Erro ao remover o funcionario da tabela geral.");
    }

    $query_funcionario = "DELETE FROM funcionario WHERE pk_id_funcionario = '{$id_funcionario}'";
    if (!mysqli_query($conexao, $query_funcionario)) {
        throw new Exception("Erro ao remover o funcionário da tabela funcionário.");
    }

    mysqli_commit($conexao);
    $_SESSION['sucesso_remocao'] = "Funcionário removido com sucesso.";
    header('Location: ../indexRemoveFuncionario.php');
    exit();
} catch (Exception $e) {
    mysqli_rollback($conexao);
    $_SESSION['erro_remocao'] = $e->getMessage();
    header('Location: ../indexRemoveFuncionario.php');
    exit();
} finally {
    mysqli_close($conexao);
}
?>
