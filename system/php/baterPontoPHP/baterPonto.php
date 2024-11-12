<?php
// FALTA IMPLEMENTAR A VALIDAÇÃO DAS COORDENADAS.

session_start();
include('../../conexao.php'); // Certifique-se de que o caminho está correto

if (empty($_POST['senha'])) {
    $_SESSION['mensagem_erro'] = "Erro: Nenhuma senha informada.";
    header('Location: ../../indexPonto.php');
    exit();
}

$senhaInformada = mysqli_real_escape_string($conexao, $_POST['senha']);
$senhaMD5 = md5($senhaInformada); // Converte a senha para MD5

// Busca o nome do funcionário pela senha
$query = "SELECT id_funcionario, nome FROM funcionario WHERE senha = '{$senhaMD5}';";
$result = mysqli_query($conexao, $query);
$row = mysqli_fetch_assoc($result);

if ($row) {
    // Se encontrou o funcionário
    $nome_funcionario = $row['nome'];
    $id_funcionario = $row['id_funcionario'];

    // Verifica se o ponto de entrada já foi registrado para o funcionário
    $query_verificacao = "SELECT * FROM ponto WHERE id_funcionario = '{$id_funcionario}' AND data_registro = CURDATE();";
    $result_verificacao = mysqli_query($conexao, $query_verificacao);
    $registro = mysqli_fetch_assoc($result_verificacao);

    // Se não houver registro de ponto para hoje, registra o ponto de entrada
    if (!$registro) {
        $hora_atual = date('H:i:s'); // Hora atual no formato HH:MM:SS
        $query_registro_entrada = "INSERT INTO ponto (id_funcionario, nome_funcionario, ponto_entrada, data_registro) VALUES ('{$id_funcionario}', '{$nome_funcionario}', '{$hora_atual}', CURDATE())";
        if (mysqli_query($conexao, $query_registro_entrada)) {
            $_SESSION['mensagem_sucesso'] = "Sucesso! O seu ponto de entrada foi registrado, " . htmlspecialchars($nome_funcionario) . ".";
            header('Location: ../indexPonto.php');
            exit();
        } else {
            $_SESSION['mensagem_erro'] = "Erro ao registrar o ponto de entrada.";
        }
    } else {
        // Se já houver registro de entrada, verifica o ponto de saída
        if ($registro['ponto_saida'] == NULL) {
            $hora_atual = date('H:i:s'); // Hora atual no formato HH:MM:SS
            $query_registro_saida = "UPDATE ponto SET ponto_saida = '{$hora_atual}' WHERE id_funcionario = '{$id_funcionario}' AND data_registro = CURDATE()";
            if (mysqli_query($conexao, $query_registro_saida)) {
                $_SESSION['mensagem_sucesso'] = "Sucesso! O seu ponto de saída foi registrado, " . htmlspecialchars($nome_funcionario) . ".";
            } else {
                $_SESSION['mensagem_erro'] = "Erro ao registrar o ponto de saída.";
            }
        } else {
            $_SESSION['mensagem_erro'] = "Erro: O ponto de saída já foi registrado.";
        }
    }
} else {
    $_SESSION['mensagem_erro'] = "Erro: Senha não encontrada.";
}

mysqli_close($conexao);

// Redireciona para a página que exibirá a mensagem
header('Location: ../indexPonto.php');
exit();
?>
