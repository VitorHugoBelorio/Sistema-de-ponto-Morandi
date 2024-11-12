-- Cria o data base
CREATE DATABASE IF NOT EXISTS ponto_morandi;

drop database ponto_morandi;

USE ponto_morandi;

-- Criação da tabela funcionario
CREATE TABLE IF NOT EXISTS funcionario (
    id_funcionario INT AUTO_INCREMENT PRIMARY KEY, -- Se auto incrementa, não precisa passar (usado para referenciar na hora de bater o ponto)
    pk_funcionario_cpf CHAR(14) NOT NULL UNIQUE,  -- Define o CPF como único
    nome VARCHAR(100) NOT NULL,
    senha CHAR(32) NOT NULL,  -- Define senha como CHAR(32) para armazenar o hash MD5
    email VARCHAR(200) NOT NULL,
    data_do_registro DATETIME NOT NULL, 
    cargo TINYINT(1) NOT NULL
);

-- Inserção dos registros
INSERT INTO funcionario (pk_funcionario_cpf, nome, senha, email, data_do_registro, cargo) VALUES
    ("12345677788", "Vitor Hugo Belório Simão", MD5("1234"), "vitor@gmail.com", NOW(), 1),
    ("22233344455", "Ronaldo", MD5("1234"), "ronaldo@gmail.com", NOW(), 0);

-- Seleção para verificação dos dados inseridos
SELECT * FROM funcionario;