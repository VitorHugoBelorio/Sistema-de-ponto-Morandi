-- Cria o data base
CREATE DATABASE IF NOT EXISTS ponto_morandi;

USE ponto_morandi;

-- Cria a tabela
CREATE TABLE IF NOT EXISTS colaborador(
pk_colaborador_cpf CHAR(14) NOT NULL,
nome varchar(100) NOT NULL,
senha VARCHAR(10) NOT NULL,
email VARCHAR(200) NOT NULL,
data_do_registro DATETIME NOT NULL
);

-- Traz as informações que foram inseridas para conferir se houve o registro
SELECT *
FROM colaborador;

-- Insere o valor na tabela
USE ponto_morandi;
INSERT INTO colaborador VALUES (
    "12345677788",
    "Vitor Hugo Belório Simão",
    "1234",
    "vitor@gmail.com",
    NOW()
);