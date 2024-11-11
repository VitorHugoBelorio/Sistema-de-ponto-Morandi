-- Cria o data base
CREATE DATABASE IF NOT EXISTS ponto_morandi;

drop database ponto_morandi;

USE ponto_morandi;

-- Cria a tabela
CREATE TABLE IF NOT EXISTS funcionario(
    pk_funcionario_cpf CHAR(14) NOT NULL,
    nome VARCHAR(100) NOT NULL,
    senha CHAR(32) NOT NULL,  -- Define senha como CHAR(32) para armazenar o hash MD5
    email VARCHAR(200) NOT NULL,
    data_do_registro DATETIME NOT NULL, 
    cargo TINYINT(1) NOT NULL
);

DROP TABLE funcionario;

-- Traz as informações que foram inseridas para conferir se houve o registro
SELECT *
FROM funcionario;

USE ponto_morandi;

INSERT INTO funcionario VALUES (
    "12345677788",
    "Vitor Hugo Belório Simão",
    MD5("1234"),  -- Aplica o hash MD5 à senha "1234"
    "vitor@gmail.com",
    NOW(),
    1
);

INSERT INTO funcionario VALUES (
    "22233344455",
    "Ronaldo",
    MD5("1234"),  -- Aplica o hash MD5 à senha "1234"
    "ronaldo@gmail.com",
    NOW(),
    0
);
