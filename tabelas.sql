CREATE DATABASE lista_compras;

USE lista_compras;

CREATE TABLE compras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mes VARCHAR(20),
    item VARCHAR(255),
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ano INT,
	status VARCHAR(20) DEFAULT 'pendente'
);

ALTER TABLE compras
ADD ano INT;

ALTER TABLE compras
ADD status VARCHAR(20) DEFAULT 'pendente';
