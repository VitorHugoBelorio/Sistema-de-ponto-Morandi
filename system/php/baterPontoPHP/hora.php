<?php
// hora.php

// Define o fuso horário
date_default_timezone_set('America/Sao_Paulo');

// Retorna a hora atual
echo json_encode(['hora' => date('H:i')]);
?>