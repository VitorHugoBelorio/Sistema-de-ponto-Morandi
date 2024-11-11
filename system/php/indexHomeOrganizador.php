<?php
include('loginPHP/verifica_login.php'); // impede que o usuário entre sem realizar o login
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Sistema de Ponto Eletrônico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styleHomeOrganizador.css">
</head>
<body>
<!-- Cabeçalho -->
<header class="bg-white p-3 text-center border-bottom">
    <div class="container d-flex justify-content-between align-items-center">
        <h1 class="header-title">Sistema de Ponto Eletrônico</h1>
        <a href="logoutPHP/logout.php" class="btn btn-primary">Sair</a>
    </div>
</header>

<div class="container my-5">
    <!-- Seção para o Dono da Empresa -->
    <div class="card-container">
        <div class="text-center mb-4">
            <h2 class="header-title">Acesso do Dono da Empresa</h2>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-3 mb-3">
                <a href="indexCadastrarFuncionario.php" class="btn btn-success w-100 py-3">Cadastrar Funcionário</a>
            </div>
            <div class="col-md-6 col-lg-3 mb-3">
                <a href="indexRemoverFuncionario.php" class="btn btn-success w-100 py-3">Remover Funcionário</a>
            </div>
            <div class="col-md-6 col-lg-3 mb-3">
                <a href="indexConfigurar.php" class="btn btn-success w-100 py-3">Configurar Horários</a>
            </div>
            <div class="col-md-6 col-lg-3 mb-3">
                <a href="indexRelatorio.php" class="btn btn-success w-100 py-3">Gerar Relatório</a>
            </div>
        </div>
    </div>

</div>

<!-- Rodapé -->
<footer>
    <p>&copy; 2024 Morandi Hortaliças. Todos os direitos reservados.</p>
</footer>

<!-- Scripts Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
