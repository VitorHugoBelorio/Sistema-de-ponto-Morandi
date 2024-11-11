<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Organizador - Sistema de Ponto Eletrônico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styleCadastroOrganizador.css">
</head>

<body>
    <!-- Cabeçalho -->
    <header class="bg-white p-3 text-center border-bottom">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="header-title">Cadastrar Novo Organizador</h1>
            <a href="indexHomeOrganizador.php" class="btn btn-primary">Voltar</a>
        </div>
    </header>

    <!-- Mensagem de Sucesso ou Erro -->
    <div class="container my-4">
        <?php
        if (isset($_SESSION['mensagem'])):
        ?>
            <div class="alert <?php echo ($_SESSION['mensagem'] == 'Cadastro realizado com sucesso!') ? 'alert-success' : 'alert-danger'; ?> text-center">
                <?php echo $_SESSION['mensagem']; ?>
            </div>
        <?php
            unset($_SESSION['mensagem']); // Remove a sessão para que a mensagem não seja exibida novamente
        endif;
        ?>
    </div>

    <!-- Formulário de Cadastro -->
    <div class="container my-5 card-container">
        <h2 class="text-center mb-4">Cadastro de Funcionário</h2>
        <form action="cadastrarOrganizadorPHP/cadastrarOrganizador.php" method="POST">
            <div class="mb-3">
                <label for="nomeCompleto" class="form-label">Nome Completo</label>
                <input type="text" class="form-control" id="nomeCompleto" name="nomeCompleto" placeholder="Digite o nome completo" required>
            </div>
            <div class="mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Digite o CPF" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Digite o e-mail" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success w-100 py-3">Cadastrar</button>
            </div>
        </form>
    </div>

    <!-- Rodapé -->
    <footer>
        <p>&copy; 2024 Morandi Hortaliças. Todos os direitos reservados.</p>
    </footer>

    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
