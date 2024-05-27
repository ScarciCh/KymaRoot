DROP DATABASE IF EXISTS  KymaTest;
CREATE DATABASE KymaTest;
USE KymaTest;

CREATE TABLE CategoriaUtente (
    idCategoria int,
    nomeCategoria varchar(20),
    canRead boolean,
    canModify boolean,
    canDelete boolean,

    PRIMARY KEY(idCategoria)
);

CREATE TABLE Utente(
    idUtente int AUTO_INCREMENT,
    username varchar(20) UNIQUE,
    pwd varchar(100),
    tipologiaUtente int,

    PRIMARY KEY(idUtente),
    FOREIGN KEY(tipologiaUtente) REFERENCES CategoriaUtente(idCategoria)
);

CREATE TABLE Documenti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    owner VARCHAR(255) NOT NULL,
    date_uploaded DATE NOT NULL,
    file_path VARCHAR(255) NOT NULL
);

INSERT INTO CategoriaUtente(idCategoria, nomeCategoria, canRead, canModify, canDelete) VALUES (1, "Generico", true, false, false);
INSERT INTO CategoriaUtente(idCategoria, nomeCategoria, canRead, canModify, canDelete) VALUES (2, "Admin", true, true, true);

INSERT INTO Utente(username, pwd, tipologiaUtente) VALUES ("franco", "f123", 2);
INSERT INTO Utente(username, pwd, tipologiaUtente) VALUES ("dario", "d123", 1);