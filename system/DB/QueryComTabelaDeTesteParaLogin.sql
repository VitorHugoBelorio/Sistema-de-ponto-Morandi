-- Cria o data base
CREATE DATABASE IF NOT EXISTS ponto_morandi;

USE ponto_morandi;


-- Cria a tabela
CREATE TABLE IF NOT EXISTS colaborador(
    pk_colaborador_cpf CHAR(14) NOT NULL,
    nome VARCHAR(100) NOT NULL,
    senha VARCHAR(10) NOT NULL,
    email VARCHAR(200) NOT NULL,
    data_do_registro DATETIME NOT NULL, 
    organizador TINYINT(1) NOT NULL
);

DROP TABLE colaborador;

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
    NOW(),
	1
);

INSERT INTO colaborador VALUES (
    "22233344455",
    "Ronaldo",
    "1234",
    "ronaldo@gmail.com",
    NOW(),
    0
);