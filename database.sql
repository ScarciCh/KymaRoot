DROP DATABASE IF EXISTS KymaRoot_db;
CREATE DATABASE KymaRoot_db;
USE KymaRoot_db;

CREATE TABLE CategoriaUtente (
    idCategoria int AUTO_INCREMENT,
    nomeCategoria varchar(20),
    canRead TINYINT(1) DEFAULT 0,
    canModify TINYINT(1) DEFAULT 0,
    canDelete TINYINT(1) DEFAULT 0,

    PRIMARY KEY(idCategoria)
);

CREATE TABLE FamigliaUtente (
    idFamiglia int AUTO_INCREMENT,
    nomeFamiglia varchar(30),

    PRIMARY KEY(idFamiglia)
);

CREATE TABLE Utente(
    idUtente int AUTO_INCREMENT,
    username varchar(20) UNIQUE,
    pwd varchar(100),
    tipologiaUtente int DEFAULT 1,
    famigliaUtente int DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY(idUtente),
    FOREIGN KEY(tipologiaUtente) REFERENCES CategoriaUtente(idCategoria),
    FOREIGN KEY(famigliaUtente) REFERENCES FamigliaUtente(idFamiglia)
);

CREATE TABLE Documento (
    idDocumento int AUTO_INCREMENT,
    tipologiaDocumento varchar(100),
    oggettoDocumento varchar(200),
    validitaDocumento DATE,
    numeroDocumento varchar(20),
    firmaDocumento varchar(100),
    dataDocumento DATE DEFAULT CURRENT_DATE,
    linkDocumento varchar(500),

    PRIMARY KEY(idDocumento)
);

CREATE TABLE Associazione(
    idAssociazione int AUTO_INCREMENT,
    documento int,
    destinatario int,

    PRIMARY KEY(idAssociazione),
    FOREIGN KEY(documento) REFERENCES Documento(idDocumento),
    FOREIGN KEY(destinatario) REFERENCES FamigliaUtente(idFamiglia)
);

INSERT INTO CategoriaUtente(idCategoria, nomeCategoria, canRead, canModify, canDelete)
VALUES (1, "Non Autorizzato", 0, 0, 0);
INSERT INTO CategoriaUtente(idCategoria, nomeCategoria, canRead, canModify, canDelete)
VALUES (2, "Generico", 1, 0, 0);
INSERT INTO CategoriaUtente(idCategoria, nomeCategoria, canRead, canModify, canDelete)
VALUES (3, "Admin", 1, 1, 1);

INSERT INTO FamigliaUtente(nomeFamiglia) VALUES ("Generica");

INSERT INTO Utente(username, pwd, tipologiaUtente, famigliaUtente)
VALUES ("admin", "$2y$12$IFJH/EmpZH/wWbcWiC8bSeyULPOyU6ePu2qpSyOqFji3tREKeprpe", 3, 1);

INSERT INTO Documento(tipologiaDocumento, oggettoDocumento, validitaDocumento, numeroDocumento, firmaDocumento, linkDocumento)
VALUES ("Tipologia Esempio", "Ex HR", "2024-12-31", "1234", "Firma Esempio","https://docs.google.com/document/d/18DREtSnT7lQXDbiT9kWivjmlIWXYDKO8vBKJwYESZao/edit?usp=sharing");

INSERT INTO Associazione(documento, destinatario) VALUES (1, 1);
