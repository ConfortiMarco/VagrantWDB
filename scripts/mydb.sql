DROP DATABASE IF EXISTS marco_conforti;
CREATE DATABASE marco_conforti;
USE marco_conforti;

CREATE TABLE IF NOT EXISTS utente(
	id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    cognome VARCHAR(255) NOT NULL,
    data_nascita DATE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    salario_orario DOUBLE,
    password VARCHAR(255) NOT NULL,
    tipo VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS categoria(
	id INT PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS componente(
	id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    prezzo DOUBLE NOT NULL
);

CREATE TABLE IF NOT EXISTS apparecchioelettronico(
	id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    modello VARCHAR(255) NOT NULL,
    data_produzione DATE NOT NULL,
    data_acquisto DATE NOT NULL,
    prezzo DOUBLE NOT NULL,
    categoria_id INT NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES categoria(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS fattura(
	id INT PRIMARY KEY AUTO_INCREMENT,
    apparecchioelettronico_id INT UNIQUE NOT NULL,
    utente_id INT NOT NULL,
    FOREIGN KEY (apparecchioelettronico_id) REFERENCES apparecchioelettronico(id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (utente_id) REFERENCES utente(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS apparecchioelettronico_dipendente(
	utente_id INT NOT NULL,
    apparecchioelettronico_id INT NOT NULL,
    ore_lavoro INT NOT NULL,
    PRIMARY KEY(utente_id,apparecchioelettronico_id),
    FOREIGN KEY (apparecchioelettronico_id) REFERENCES apparecchioelettronico(id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (utente_id) REFERENCES utente(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS apparecchioelettronico_componente(
	apparecchioelettronico_id INT NOT NULL,
    componente_id INT NOT NULL,
    quantita INT NOT NULL,
    PRIMARY KEY(apparecchioelettronico_id,componente_id),
    FOREIGN KEY (apparecchioelettronico_id) REFERENCES apparecchioelettronico(id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (componente_id) REFERENCES componente(id) ON UPDATE CASCADE ON DELETE CASCADE
);


CREATE USER 'application_user'@'10.10.20.10' IDENTIFIED BY 'Admin$00';
GRANT ALL PRIVILEGES ON marco_conforti.* TO 'application_user'@'10.10.20.10' WITH GRANT OPTION;;
FLUSH PRIVILEGES;