-- Cria o data base
CREATE DATABASE IF NOT EXISTS ponto_morandi;

drop database ponto_morandi;

USE ponto_morandi;

-- Cria a tabela
CREATE TABLE IF NOT EXISTS geral (
    pk_id_geral INT AUTO_INCREMENT PRIMARY KEY,
    id_funcionario INT,  -- ID referente à tabela funcionario
    id_organizador INT,  -- ID referente à tabela organizador
    id_diretor INT,      -- ID referente à tabela diretor
    cpf CHAR(14) NOT NULL,
    nome VARCHAR(100) NOT NULL,
    senha CHAR(32) NOT NULL,       -- Armazena o hash MD5 da senha
    email VARCHAR(200) NOT NULL,
    data_do_registro DATETIME NOT NULL,
    cargo VARCHAR(40) NOT NULL     -- Armazena o cargo da pessoa
);


CREATE TABLE IF NOT EXISTS funcionario (
	pk_id_funcionario INT AUTO_INCREMENT PRIMARY KEY,
    funcionario_cpf CHAR(14) NOT NULL,
    nome VARCHAR(100) NOT NULL,
    senha CHAR(32) NOT NULL,  -- Define senha como CHAR(32) para armazenar o hash MD5
    email VARCHAR(200) NOT NULL,
    data_do_registro DATETIME NOT NULL, 
    cargo VARCHAR(40) NOT NULL
);

CREATE TABLE IF NOT EXISTS organizador (
	pk_id_organizador INT AUTO_INCREMENT PRIMARY KEY,
    organizador_cpf CHAR(14) NOT NULL,
    nome VARCHAR(100) NOT NULL,
    senha CHAR(32) NOT NULL,  -- Define senha como CHAR(32) para armazenar o hash MD5
    email VARCHAR(200) NOT NULL,
    data_do_registro DATETIME NOT NULL, 
    cargo VARCHAR(40) NOT NULL
);

CREATE TABLE IF NOT EXISTS diretor (
	pk_id_diretor INT AUTO_INCREMENT PRIMARY KEY,
    diretor_cpf CHAR(14) NOT NULL,
    nome VARCHAR(100) NOT NULL,
    senha CHAR(32) NOT NULL,  -- Define senha como CHAR(32) para armazenar o hash MD5
    email VARCHAR(200) NOT NULL,
    data_do_registro DATETIME NOT NULL, 
    cargo VARCHAR(40) NOT NULL
);

-- Inserindo um registro na tabela diretor
INSERT INTO diretor (diretor_cpf, nome, senha, email, data_do_registro, cargo)
VALUES ('12312312312', 'Carlos Oliveira', MD5('1234'), 'vitor@gmail.com', NOW(), 'DIRETOR');

-- Inserindo na tabela geral para um diretor
INSERT INTO geral (id_diretor, cpf, nome, senha, email, data_do_registro, cargo)
VALUES (1, '12312312312', 'Vitor', MD5('1234'), 'vitor@gmail.com', NOW(), 'DIRETOR');



TRUNCATE TABLE geral;
TRUNCATE TABLE funcionario;
TRUNCATE TABLE organizador;
TRUNCATE TABLE diretor;

