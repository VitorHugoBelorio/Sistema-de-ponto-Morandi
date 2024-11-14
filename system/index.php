<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Morandi Hortaliças</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div class="login-container">
        <h2 class="text-center">Login</h2>

        <!-- Exibe a mensagem de erro se 'nao_autenticado' for true -->
        <?php
        if (isset($_SESSION['nao_autenticado']) && $_SESSION['nao_autenticado']) :
        ?>
            <div class="alert alert-danger text-center">
                Senha ou e-mail incorretos. Tente novamente.
            </div>
        <?php
            unset($_SESSION['nao_autenticado']); // Remove a sessão para evitar exibir o alerta após o próximo acesso
        endif;
        ?>

        <form action="php/loginPHP/login.php" method="POST">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha" required>
            </div>
            <button type="submit" class="btn btn-success btn-block">Entrar</button>
            <div class="text-center mt-3">
                <a href="html/indexRecuperarSenha.html">Esqueceu a senha?</a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
