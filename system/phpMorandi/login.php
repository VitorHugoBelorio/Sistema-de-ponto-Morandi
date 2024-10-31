<?php
// Verifica se o formulário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os valores dos campos email e senha
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Exemplo de credenciais para validação (substitua por verificação no banco de dados)
    $emailValido = "usuario@example.com";
    $senhaValida = "senha123";

    // Verifica as credenciais
    if ($email === $emailValido && $senha === $senhaValida) {
        // Login bem-sucedido: redireciona o usuário para a página principal
        header("Location: http://localhost/html/indexHomeOrganizador.html");
        exit;
    } else {
        // Login falhou: redireciona de volta para o formulário com mensagem de erro
        echo("As informações passadas estão incorretas");
        header("Location: http://localhost/index.html");
        exit;
    }
} 
?>
