<?php
    // Configuração do banco de dados
    $host = "localhost"; // Endereço do servidor do banco de dados
    $username = "root"; // Nome de usuário do banco de dados
    $password = ""; // Senha do banco de dados
    $database = "ponto_morandi"; // Nome do banco de dados

    // Criando a conexão
    $conn = new mysqli($host, $username, $password, $database);

    // Verificando a conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }
    echo "Conexão bem-sucedida!";

    // Verifica se o formulário foi enviado via POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Captura os valores dos campos email e senha
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Preparando a consulta SQL para buscar o colaborador pelo email
        $stmt = $conn->prepare("SELECT senha, organizador FROM colaborador WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        // Verifica se o email existe no banco de dados
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($senha_db, $is_organizador);
            $stmt->fetch();

            // Compara a senha informada com a senha armazenada
            if ($senha === $senha_db) {
                
                // Verifica o valor de 'organizador' para redirecionar o usuário com base no tipo
                if ($is_organizador == 1) { // Se o colaborador for um organizador
                    header("Location: http://localhost/html/indexHomeOrganizador.html");
                } else { // Se o colaborador for comum
                    header("Location: http://localhost/html/indexHomeFuncionario.html");
                }
                exit;
            } else {
                // Senha incorreta
                echo "Senha incorreta.";
            }
        } else {
            // Email não encontrado
            echo "Email não encontrado.";
        }

        $stmt->close();
    } 

    $conn->close();
?>
