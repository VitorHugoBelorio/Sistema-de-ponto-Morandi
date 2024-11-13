<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/stylePonto.css">
    <title>Ponto</title>
</head>
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/stylePonto.css">
    <title>Ponto</title>
</head>

<body>
    <!-- Exibe a mensagem de sucesso se 'mensagem_sucesso' estiver definida -->
    <?php
    if (isset($_SESSION['mensagem_sucesso'])) :
    ?>
        <div class="alert alert-success text-center">
            <?php echo $_SESSION['mensagem_sucesso']; ?>
        </div>
    <?php
        unset($_SESSION['mensagem_sucesso']);
    endif;
    ?>

    <!-- Exibe a mensagem de erro se 'mensagem_erro' estiver definida -->
    <?php
    if (isset($_SESSION['mensagem_erro'])) :
    ?>
        <div class="alert alert-danger text-center">
            <?php echo $_SESSION['mensagem_erro']; ?>
        </div>
    <?php
        unset($_SESSION['mensagem_erro']);
    endif;
    ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Ponto</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="indexHomeFuncionario.php">Home</a>
            </div>
        </div>
    </nav>

    <div class="login-container">
        <div id="relogio">Carregando hora...</div>
        <form id="formPonto" action="baterPontoPHP/baterPonto.php" method="POST">
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha" required>
            </div>
            <!-- Campos ocultos para armazenar latitude e longitude -->
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
            <button type="button" class="btn btn-primary btn-block" onclick="obterLocalizacao(event)">Registrar</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        // Função para atualizar a hora do computador do usuário
        function atualizarHoraLocal() {
            const agora = new Date();
            const horas = String(agora.getHours()).padStart(2, '0');
            const minutos = String(agora.getMinutes()).padStart(2, '0');
            const horaFormatada = `${horas}:${minutos}`;

            document.getElementById('relogio').textContent = horaFormatada;
        }

        // Atualiza a hora local a cada segundo
        setInterval(atualizarHoraLocal, 1000);
        atualizarHoraLocal();

        // Obter a localização do usuário
        function obterLocalizacao(event) {
            event.preventDefault();

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(posicao) {
                    // Define as coordenadas no formulário
                    document.getElementById('latitude').value = posicao.coords.latitude;
                    document.getElementById('longitude').value = posicao.coords.longitude;

                    // Envia o formulário após obter a localização
                    document.getElementById('formPonto').submit();
                }, function(error) {
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            alert("Permissão para obter localização foi negada, não foi possível bater o ponto.");
                            break;
                        case error.POSITION_UNAVAILABLE:
                            alert("Localização indisponível.");
                            break;
                        case error.TIMEOUT:
                            alert("Tempo para obter localização esgotado.");
                            break;
                        default:
                            alert("Erro desconhecido ao obter localização.");
                            break;
                    }
                });
            } else {
                alert("Geolocalização não é suportada pelo seu navegador.");
            }
        }
    </script>
</body>

</html>

<body>
    <!-- Exibe a mensagem de sucesso se 'mensagem_sucesso' estiver definida -->
    <?php
    if (isset($_SESSION['mensagem_sucesso'])) :
    ?>
        <div class="alert alert-success text-center">
            <?php echo $_SESSION['mensagem_sucesso']; ?>
        </div>
    <?php
        unset($_SESSION['mensagem_sucesso']);
    endif;
    ?>

    <!-- Exibe a mensagem de erro se 'mensagem_erro' estiver definida -->
    <?php
    if (isset($_SESSION['mensagem_erro'])) :
    ?>
        <div class="alert alert-danger text-center">
            <?php echo $_SESSION['mensagem_erro']; ?>
        </div>
    <?php
        unset($_SESSION['mensagem_erro']);
    endif;
    ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Ponto</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="indexHomeFuncionario.php">Home</a>
            </div>
        </div>
    </nav>

    <div class="login-container">
        <div id="relogio">Carregando hora...</div>
        <form action="baterPontoPHP/baterPonto.php" method="POST">
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        function atualizarHora() {
            $.ajax({
                url: 'baterPontoPHP/hora.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#relogio').text(data.hora);
                },
                error: function() {
                    $('#relogio').text('Erro ao carregar a hora');
                }
            });
        }

        // Atualiza a hora a cada segundo
        setInterval(atualizarHora, 1000);

        // Carrega a hora imediatamente ao carregar a página
        atualizarHora();
    </script>
</body>

</html>
