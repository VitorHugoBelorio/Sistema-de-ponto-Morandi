USE ponto_morandi;

CREATE TABLE IF NOT EXISTS ponto (
    id_ponto INT AUTO_INCREMENT PRIMARY KEY,
    id_funcionario INT DEFAULT NULL,  -- Pode ser NULL, se não for um funcionário
    id_organizador INT DEFAULT NULL,  -- Pode ser NULL, se não for um organizador
    nome_funcionario VARCHAR(100) NOT NULL,
    ponto_entrada TIME NOT NULL,
    ponto_saida TIME DEFAULT NULL,
    data_registro DATE NOT NULL,
    FOREIGN KEY (id_funcionario) REFERENCES funcionario(pk_id_funcionario) ON DELETE CASCADE,
    FOREIGN KEY (id_organizador) REFERENCES organizador(pk_id_organizador) ON DELETE CASCADE
);

-- Para garantir a consistência, removendo tabelas existentes (opcional)
DROP TABLE IF EXISTS ponto;

-- Para visualizar os registros
SELECT * FROM ponto;

-- Limpar todos os dados da tabela
TRUNCATE TABLE ponto;
