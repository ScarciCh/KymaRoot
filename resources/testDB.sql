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
    password varchar(100),
    tipologiaUtente int,

    PRIMARY KEY(idUtente),
    FOREIGN KEY(tipologiaUtente) REFERENCES CategoriaUtente(idCategoria)
);

INSERT INTO CategoriaUtente(idCategoria, nomeCategoria, canRead, canModify, canDelete) VALUES (1, "Generico", true, false, false);
INSERT INTO CategoriaUtente(idCategoria, nomeCategoria, canRead, canModify, canDelete) VALUES (2, "Admin", true, true, true);

INSERT INTO Utente(username, password, tipologiaUtente) VALUES ("francobattiato", "gravita123", 2);
INSERT INTO Utente(username, password, tipologiaUtente) VALUES ("luciodalla", "caruso123", 1);