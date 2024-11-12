use ponto_morandi;

CREATE TABLE IF NOT EXISTS ponto (
    id_ponto INT AUTO_INCREMENT PRIMARY KEY,
    id_funcionario INT NOT NULL,
    nome_funcionario VARCHAR(100) NOT NULL,
    ponto_entrada TIME NOT NULL,
    ponto_saida TIME DEFAULT NULL,
    data_registro DATE NOT NULL,
    FOREIGN KEY (id_funcionario) REFERENCES funcionario(id_funcionario)
);

drop table ponto;


SELECT *
FROM ponto;

-- limpa os dados da tabela
TRUNCATE TABLE ponto;
