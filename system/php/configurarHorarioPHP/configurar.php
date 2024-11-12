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
$intervaloAlmoco = mysqli_real_escape_string($conexao, $_POST['intervaloAlmoco']);
$latitude = mysqli_real_escape_string($conexao, $_POST['latitude']);
$longitude = mysqli_real_escape_string($conexao, $_POST['longitude']);

// Cálculo das horas
$inicio = new DateTime($inicioExpediente);
$fim = new DateTime($fimExpediente);
$intervalo = new DateInterval("PT" . $intervaloAlmoco . "H");
$duracao = $inicio->diff($fim);
$totalHoras = $duracao->h - $intervalo->h;

// Validação da duração
if ($totalHoras < 8) {
    $_SESSION['mensagem'] = "<div class='alert alert-warning'>Período definido inválido: Inferior a 8 horas.</div>";
    header('Location: ../indexConfigurar.php');
    exit();
} elseif ($totalHoras > 8) {
    $_SESSION['mensagem'] = "<div class='alert alert-warning'>Período definido inválido: Superior a 8 horas.</div>";
    header('Location: ../indexConfigurar.php');
    exit();
} else {
    // Verifica se já existe um expediente cadastrado
    $query = "SELECT * FROM expediente LIMIT 1"; // A consulta busca o primeiro registro da tabela expediente
    $result = mysqli_query($conexao, $query);

    if (mysqli_num_rows($result) > 0) {
        // Se já existir um registro, realiza a substituição
        $stmt = $conexao->prepare("UPDATE expediente SET inicio_expediente = ?, fim_expediente = ?, duracao_intervalo = ?, latitude = ?, longitude = ? WHERE 1");
    } else {
        // Caso contrário, insere um novo registro
        $stmt = $conexao->prepare("INSERT INTO expediente (inicio_expediente, fim_expediente, duracao_intervalo, latitude, longitude) VALUES (?, ?, ?, ?, ?)");
    }

    // Associa os parâmetros à consulta preparada
    $stmt->bind_param("sssdd", $inicioExpediente, $fimExpediente, $intervaloAlmoco, $latitude, $longitude);

    if ($stmt->execute()) {
        $_SESSION['mensagem'] = "<div class='alert alert-success'>Configurações salvas com sucesso!</div>";
    } else {
        $_SESSION['mensagem'] = "<div class='alert alert-danger'>Erro ao salvar configurações: " . $stmt->error . "</div>";
    }

    // Fecha a declaração
    $stmt->close();
}

// Limpa a variável de sessão após o redirecionamento
unset($_SESSION['mensagem']);

// Redireciona após o processamento
header('Location: ../indexConfigurar.php');
exit();
?>
