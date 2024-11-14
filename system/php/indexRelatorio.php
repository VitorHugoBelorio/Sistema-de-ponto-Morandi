<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório do Dia - Sistema de Ponto Eletrônico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styleRelatorio.css">
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
            <h1 class="header-title">Relatório do Dia</h1>
            <a href="<?php echo $linkVoltar; ?>" class="btn btn-primary">Voltar</a>
        </div>
    </header>

    <!-- Conteúdo da Tabela de Relatório -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Funcionários e Horários do Dia</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-success">
                    <tr>
                        <th>Nome Completo</th>
                        <th>CPF</th>
                        <th>Horário de Entrada</th>
                        <th>Horário de Saída</th>
                        <th>Total de Horas Trabalhadas</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Exemplo de Linha de Funcionário -->
                    <tr>
                        <td>João da Silva</td>
                        <td>123.456.789-00</td>
                        <td>08:00</td>
                        <td>17:00</td>
                        <td>8h</td>
                    </tr>
                    <tr>
                        <td>Maria Souza</td>
                        <td>987.654.321-00</td>
                        <td>09:00</td>
                        <td>18:00</td>
                        <td>8h</td>
                    </tr>
                    <!-- Adicione outras linhas dinamicamente conforme os dados -->
                </tbody>
            </table>
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
