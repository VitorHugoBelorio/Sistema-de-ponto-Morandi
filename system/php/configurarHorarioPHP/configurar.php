<?php
session_start();
include('../../conexao.php'); // Certifique-se de que o caminho está correto

// Verifique se os campos necessários foram preenchidos
if (empty($_POST['inicioExpediente']) || empty($_POST['fimExpediente']) || empty($_POST['intervaloAlmoco']) || empty($_POST['latitude']) || empty($_POST['longitude'])) {
    $_SESSION['mensagem'] = "<div class='alert alert-danger'>Todos os campos devem ser preenchidos!</div>";
    header('Location: ../indexConfigurar.php');
    exit();
}

// Receba os dados do formulário
$inicioExpediente = mysqli_real_escape_string($conexao, $_POST['inicioExpediente']);
$fimExpediente = mysqli_real_escape_string($conexao, $_POST['fimExpediente']);

// Converte o intervalo em uma string de horas
$intervaloAlmoco = sprintf("%02d:00:00", (int)$_POST['intervaloAlmoco']);
$latitude = mysqli_real_escape_string($conexao, $_POST['latitude']);
$longitude = mysqli_real_escape_string($conexao, $_POST['longitude']);

// Cálculo das horas
$inicio = new DateTime($inicioExpediente);
$fim = new DateTime($fimExpediente);
$intervaloHoras = (int)$_POST['intervaloAlmoco'];
$duracao = $inicio->diff($fim);
$totalHoras = $duracao->h + ($duracao->i / 60) - $intervaloHoras;

if ($totalHoras < 8) {
    $_SESSION['mensagem'] = "<div class='alert alert-warning'>Período definido inválido: Inferior a 8 horas.</div>";
    header('Location: ../indexConfigurar.php');
    exit();
} elseif ($totalHoras > 8) {
    $_SESSION['mensagem'] = "<div class='alert alert-warning'>Período definido inválido: Superior a 8 horas.</div>";
    header('Location: ../indexConfigurar.php');
    exit();
} else {
    $query = "SELECT * FROM expediente LIMIT 1";
    $result = mysqli_query($conexao, $query);

    if (mysqli_num_rows($result) > 0) {
        $stmt = $conexao->prepare("UPDATE expediente SET inicio_expediente = ?, fim_expediente = ?, duracao_intervalo = ?, latitude = ?, longitude = ? WHERE 1");
    } else {
        $stmt = $conexao->prepare("INSERT INTO expediente (inicio_expediente, fim_expediente, duracao_intervalo, latitude, longitude) VALUES (?, ?, ?, ?, ?)");
    }

    $stmt->bind_param("sssdd", $inicioExpediente, $fimExpediente, $intervaloAlmoco, $latitude, $longitude);

    if ($stmt->execute()) {
        $_SESSION['mensagem'] = "<div class='alert alert-success'>Configurações salvas com sucesso!</div>";
    } else {
        $_SESSION['mensagem'] = "<div class='alert alert-danger'>Erro ao salvar configurações: " . $stmt->error . "</div>";
    }

    $stmt->close();
}

unset($_SESSION['mensagem']);
header('Location: ../indexConfigurar.php');
exit();
?>
