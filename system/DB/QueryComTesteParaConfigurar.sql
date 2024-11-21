-- Deve estar Inserido os cadastros para rodar

CREATE TABLE IF NOT EXISTS expediente (
    id_expediente INT AUTO_INCREMENT PRIMARY KEY,
    inicio_expediente TIME NOT NULL,
    fim_expediente TIME NOT NULL,
    duracao_intervalo TIME NOT NULL,
    latitude DECIMAL(9,6) NOT NULL,
    longitude DECIMAL(9,6) NOT NULL
);

INSERT INTO expediente (inicio_expediente, fim_expediente, duracao_intervalo, latitude, longitude) 
VALUES ('08:00:00', '17:00:00', '01:00:00', '-51.409714', '-22.094307');

SELECT * FROM expediente;
SHOW TABLES;

DROP table expediente;