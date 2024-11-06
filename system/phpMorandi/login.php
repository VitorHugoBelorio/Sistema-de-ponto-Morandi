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
        $stmt = $conn->prepare("SELECT senha FROM colaborador WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        // Verifica se o email existe no banco de dados
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($senha_db);
            $stmt->fetch();

            // Compara a senha informada com a senha armazenada
            if ($senha === $senha_db) {
                // Login bem-sucedido: redireciona o usuário para a página principal
                header("Location: http://localhost/html/indexHomeOrganizador.html");
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
