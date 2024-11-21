<?php
define('HOST', '127.0.0.1');
define('USUARIO', 'root');
define('SENHA', ''); // Alterar a senha ou por padrão ''
define('DB', 'ponto_morandi');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possível conectar');
?>