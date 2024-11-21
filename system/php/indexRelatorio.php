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
    include('../conexao.php');

    // Verifica o cargo do usuário na sessão para definir o link "Voltar"
    $linkVoltar = "";
    if (isset($_SESSION['cargo'])) {
        if ($_SESSION['cargo'] == 'ORGANIZADOR') {
            $linkVoltar = "indexHomeOrganizador.php";
        } elseif ($_SESSION['cargo'] == 'DIRETOR') {
            $linkVoltar = "indexHomeDiretor.php";
        }
    }

    // Conectar ao banco de dados
    

    // Query para buscar dados do ponto e expediente
    $query = "SELECT 
            nome_funcionario,
            funcionario_cpf,
            ponto_entrada,
            ponto_saida,
            data_registro,
            inicio_expediente,
            fim_expediente
        FROM ponto
        LEFT JOIN funcionario ON ponto.id_funcionario = funcionario.pk_id_funcionario
        JOIN expediente ON 1 = 1 -- Supondo que há apenas um expediente ativo
        WHERE data_registro = CURDATE(); -- Apenas dados do dia atual
    ";

    // Executa a consulta
    $resultado = mysqli_query($conexao, $query);

    // Verifica se houve erro na execução da consulta
    if (!$resultado) {
        die("Erro ao buscar dados: " . $conexao->error);
    }

    // Processa os resultados da consulta
    $dados = [];
    while ($row = $resultado->fetch_assoc()) {
        $dados[] = $row;
    }

    // Fecha a conexão com o banco de dados
    $conexao->close();

    // Função para calcular horas trabalhadas
    function calcularHorasTrabalhadas($entrada, $saida) {
        $horarioEntrada = new DateTime($entrada);
        $horarioSaida = new DateTime($saida);

        $intervalo = $horarioEntrada->diff($horarioSaida);
        return $intervalo->h . 'h ' . $intervalo->i . 'm';
    }

    // Função para validar se o horário está dentro do expediente
    function validarExpediente($inicioExpediente, $fimExpediente, $entrada, $saida) {
        $inicio = new DateTime($inicioExpediente);
        $fim = new DateTime($fimExpediente);
        $entrada = new DateTime($entrada);
        $saida = new DateTime($saida);

        return ($entrada >= $inicio && $saida <= $fim);
    }
    ?>
    <?php
    
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
                    <?php foreach ($dados as $dado): ?>
                        <tr>
                            <td><?php echo $dado['nome_funcionario']; ?></td>
                            <td><?php echo $dado['funcionario_cpf']; ?></td>
                            <td><?php echo $dado['ponto_entrada']; ?></td>
                            <td><?php echo $dado['ponto_saida'] ?? '---'; ?></td>
                            <td>
                                <?php
                                if ($dado['ponto_saida']) {
                                    if (validarExpediente($dado['inicio_expediente'], $dado['fim_expediente'], $dado['ponto_entrada'], $dado['ponto_saida'])) {
                                        echo calcularHorasTrabalhadas($dado['ponto_entrada'], $dado['ponto_saida']);
                                    } else {
                                        echo '<span class="text-danger">Fora do expediente</span>';
                                    }
                                } else {
                                    echo '---';
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
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
