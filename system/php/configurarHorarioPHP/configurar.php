<?php
//configurar.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "ponto_morandi";

    $conn = new mysqli($host, $username, $password, $database);
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    $inicioExpediente = $_POST['inicioExpediente'];
    $fimExpediente = $_POST['fimExpediente'];
    $intervaloAlmoco = $_POST['intervaloAlmoco'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $inicio = new DateTime($inicioExpediente);
    $fim = new DateTime($fimExpediente);
    $intervalo = new DateInterval("PT" . $intervaloAlmoco . "H");
    $duracao = $inicio->diff($fim);
    $totalHoras = $duracao->h - $intervalo->h;

    if ($totalHoras < 8) {
        $mensagem = "<div class='alert alert-warning'>Período definido inválido: Inferior a 8 horas.</div>";
    } elseif ($totalHoras > 8) {
        $mensagem = "<div class='alert alert-warning'>Período definido inválido: Superior a 8 horas.</div>";
    } else {
        $stmt = $conn->prepare("INSERT INTO expediente (inicio_expediente, fim_expediente, duracao_intervalo, latitude, longitude) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssdd", $inicioExpediente, $fimExpediente, $intervaloAlmoco, $latitude, $longitude);

        if ($stmt->execute()) {
            $mensagem = "<div class='alert alert-success'>Configurações salvas com sucesso!</div>";
        } else {
            $mensagem = "<div class='alert alert-danger'>Erro ao salvar configurações: " . $stmt->error . "</div>";
        }
        $stmt->close();
    }
    $conn->close();
}
?>
