DROP DATABASE IF EXISTS  KymaTest;
CREATE DATABASE KymaTest;
USE KymaTest;

CREATE TABLE CategoriaUtente (
    idCategoria int,
    canRead boolean,
    canModify boolean,
    canDelete boolean,

    PRIMARY KEY(idCategoria)
);

CREATE TABLE Utente(
    idUtente int AUTO_INCREMENT,
    username varchar(20),
    password varchar(50),
    tipo int,

    PRIMARY KEY(idUtente),
    FOREIGN KEY(tipo) REFERENCES CategoriaUtente(idCategoria)
);
