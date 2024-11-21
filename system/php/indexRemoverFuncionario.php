<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remover Funcionário - Sistema de Ponto Eletrônico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styleRemoverFuncionario.css">
</head>
<body>
<?php
session_start();

// Verifica o cargo do usuário na sessão para definir o link "Voltar"
$linkVoltar = "";
if (isset($_SESSION['cargo'])) {
    if ($_SESSION['cargo'] == 'ORGANIZADOR') {
        $linkVoltar = "indexHomeOrganizador.php";
    } elseif ($_SESSION['cargo'] == 'DIRETOR') {
        $linkVoltar = "indexHomeDiretor.php";
    }
}
?>

<!-- Cabeçalho -->
<header class="bg-white p-3 text-center border-bottom">
    <div class="container d-flex justify-content-between align-items-center">
        <h1 class="header-title">Remover Funcionário</h1>
        <a href="<?php echo $linkVoltar; ?>" class="btn btn-primary">Voltar</a>
    </div>
</header>

<!-- Formulário de Remoção -->
<div class="container my-5 card-container">
    <h2 class="text-center mb-4">Remoção de Funcionário</h2>

    <!-- Exibe mensagens de feedback se existirem -->
    <?php
    if (isset($_SESSION['sucesso_remocao'])) {
        echo "<div class='alert alert-success text-center'>" . htmlspecialchars($_SESSION['sucesso_remocao']) . "</div>";
        unset($_SESSION['sucesso_remocao']);
    }
    if (isset($_SESSION['erro_remocao'])) {
        echo "<div class='alert alert-danger text-center'>" . htmlspecialchars($_SESSION['erro_remocao']) . "</div>";
        unset($_SESSION['erro_remocao']);
    }
    ?>

    <form action="removerFuncionarioPHP/removerFuncionario.php" method="POST">
        <div class="mb-3">
            <label for="cpf" class="form-label">CPF do Funcionário</label>
            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Digite o CPF" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success w-100 py-3">Remover</button>
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
