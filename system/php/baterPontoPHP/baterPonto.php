<?php
session_start();
include('../../conexao.php'); // Certifique-se de que o caminho está correto

// Define o fuso horário
date_default_timezone_set('America/Sao_Paulo');

// Verifica se senha e localização foram informadas
if (empty($_POST['senha']) || empty($_POST['latitude']) || empty($_POST['longitude'])) {
    $_SESSION['mensagem_erro'] = "Erro: Senha e/ou localização não informada.";
    header('Location: ../indexPonto.php');
    exit();
}

$senhaInformada = mysqli_real_escape_string($conexao, $_POST['senha']);
$senhaMD5 = md5($senhaInformada);
$latitude_usuario = $_POST['latitude'];
$longitude_usuario = $_POST['longitude'];

// Obtenha a latitude e longitude de referência do banco de dados (expediente)
$query_exp = "SELECT latitude, longitude FROM expediente LIMIT 1";
$result_exp = mysqli_query($conexao, $query_exp);
$expediente = mysqli_fetch_assoc($result_exp);

if ($expediente) {
    $latitude_ref = $expediente['latitude'];
    $longitude_ref = $expediente['longitude'];

    // Função para calcular a distância entre dois pontos (Haversine)
    function calcularDistancia($lat1, $lon1, $lat2, $lon2) {
        $raioTerra = 6371; // Raio da Terra em quilômetros
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $raioTerra * $c;
    }

    $raioPermitido = 10.0; // 100 metros

    $distancia = calcularDistancia($latitude_usuario, $longitude_usuario, $latitude_ref, $longitude_ref);

    if ($distancia > $raioPermitido) {
        $_SESSION['mensagem_erro'] = "Erro: Você está fora da área permitida para registrar o ponto.";
        header('Location: ../indexPonto.php');
        exit();
    }
} else {
    $_SESSION['mensagem_erro'] = "Erro: Localização de referência não encontrada.";
    header('Location: ../indexPonto.php');
    exit();
}

$query = "SELECT id_funcionario, nome FROM funcionario WHERE senha = '{$senhaMD5}';";
$result = mysqli_query($conexao, $query);
$row = mysqli_fetch_assoc($result);

if ($row) {
    $nome_funcionario = $row['nome'];
    $id_funcionario = $row['id_funcionario'];

    $query_verificacao = "SELECT * FROM ponto WHERE id_funcionario = '{$id_funcionario}' AND data_registro = CURDATE();";
    $result_verificacao = mysqli_query($conexao, $query_verificacao);
    $registro = mysqli_fetch_assoc($result_verificacao);

    $hora_atual = date('H:i'); // Horário atual com horas e minutos

    if (!$registro) {
        $query_registro_entrada = "INSERT INTO ponto (id_funcionario, nome_funcionario, ponto_entrada, data_registro) VALUES ('{$id_funcionario}', '{$nome_funcionario}', '{$hora_atual}', CURDATE())";
        if (mysqli_query($conexao, $query_registro_entrada)) {
            $_SESSION['mensagem_sucesso'] = "Sucesso! O seu ponto de entrada foi registrado, " . htmlspecialchars($nome_funcionario) . ".";
            header('Location: ../indexPonto.php');
            exit();
        } else {
            $_SESSION['mensagem_erro'] = "Erro ao registrar o ponto de entrada.";
        }
    } else {
        if ($registro['ponto_saida'] == NULL) {
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
header('Location: ../indexPonto.php');
exit();
?>
