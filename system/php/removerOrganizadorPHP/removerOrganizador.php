<?php
session_start();
include('../../conexao.php');

// Verifica se a requisição veio pelo POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['erro_remocao'] = "Requisição inválida.";
    header('Location: ../indexRemoverOrganizador.php');
    exit();
}

// Verifica se o CPF foi enviado pelo formulário
if (empty($_POST['cpf'])) {
    $_SESSION['erro_remocao'] = "CPF não pode estar vazio.";
    header('Location: ../indexRemoverOrganizador.php');
    exit();
}

// Remove caracteres não numéricos do CPF
$cpf = preg_replace('/\D/', '', $_POST['cpf']);

// Verifica se o CPF está no formato correto (11 dígitos)
if (strlen($cpf) !== 11) {
    $_SESSION['erro_remocao'] = "CPF inválido. Certifique-se de digitar 11 números.";
    header('Location: ../indexRemoverOrganizador.php');
    exit();
}

// Sanitiza o input
$cpf = mysqli_real_escape_string($conexao, $cpf);

// Inicia uma transação para consistência no banco de dados
mysqli_begin_transaction($conexao);

try {
    // Verifica se o organizador existe
    $query_busca = "SELECT pk_id_organizador FROM organizador WHERE organizador_cpf = '{$cpf}'";
    $result_busca = mysqli_query($conexao, $query_busca);

    if (mysqli_num_rows($result_busca) === 0) {
        $_SESSION['erro_remocao'] = "Organizador não encontrado.";
        header('Location: ../indexRemoverOrganizador.php');
        exit();
    }

    $organizador = mysqli_fetch_assoc($result_busca);
    $id_organizador = $organizador['pk_id_organizador'];

    // Exclui o organizador das tabelas
    $query_geral = "DELETE FROM geral WHERE id_organizador = '{$id_organizador}'";
    if (!mysqli_query($conexao, $query_geral)) {
        throw new Exception("Erro ao remover o organizador da tabela geral.");
    }

    $query_organizador = "DELETE FROM organizador WHERE pk_id_organizador = '{$id_organizador}'";
    if (!mysqli_query($conexao, $query_organizador)) {
        throw new Exception("Erro ao remover o organizador da tabela organizador.");
    }

    mysqli_commit($conexao);
    $_SESSION['sucesso_remocao'] = "Organizador removido com sucesso.";
    header('Location: ../indexRemoverOrganizador.php');
    exit();
} catch (Exception $e) {
    mysqli_rollback($conexao);
    $_SESSION['erro_remocao'] = $e->getMessage();
    header('Location: ../indexRemoverOrganizador.php');
    exit();
} finally {
    mysqli_close($conexao);
}
?>
