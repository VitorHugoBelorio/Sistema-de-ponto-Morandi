<?php include '../php/configurarHorarioPHP/configurar.php'; ?> <!-- Inclui o script PHP que processa os dados -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurar Horários - Sistema de Ponto Eletrônico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styleConfigurar.css">
</head>
<body>
    <header class="bg-white p-3 text-center border-bottom">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="header-title">Configurar Horários</h1>
            <a href="indexHomeOrganizador.php" class="btn btn-primary">Voltar</a>
        </div>
    </header>

    <div class="container my-5 card-container">
        <h2 class="text-center mb-4">Configuração de Horários e Localização</h2>
        
        <!-- Exibe a mensagem de erro ou sucesso se houver -->
        <?php if (isset($mensagem)) echo $mensagem; ?>
        
        <form method="POST">
            <div class="mb-3">
                <label for="inicioExpediente" class="form-label">Início do Expediente</label>
                <input type="time" name="inicioExpediente" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="fimExpediente" class="form-label">Fim do Expediente</label>
                <input type="time" name="fimExpediente" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="intervaloAlmoco" class="form-label">Duração do Intervalo para Almoço (horas)</label>
                <input type="number" name="intervaloAlmoco" class="form-control" placeholder="Ex: 1" required>
            </div>
            <div class="mb-3">
                <label for="latitude" class="form-label">Latitude da Empresa</label>
                <input type="text" name="latitude" class="form-control" placeholder="Digite a latitude" required>
            </div>
            <div class="mb-3">
                <label for="longitude" class="form-label">Longitude da Empresa</label>
                <input type="text" name="longitude" class="form-control" placeholder="Digite a longitude" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success w-100 py-3">Salvar Configurações</button>
            </div>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Morandi Hortaliças. Todos os direitos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
