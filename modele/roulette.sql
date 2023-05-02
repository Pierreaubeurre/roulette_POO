DROP DATABASE IF EXISTS BD_ROULETTE;
CREATE DATABASE BD_ROULETTE CHARACTER SET utf8;

USE BD_ROULETTE;

CREATE USER IF NOT EXISTS 'Roulette'@'localhost' IDENTIFIED BY 'roulette';
GRANT ALL PRIVILEGES ON *.* TO 'Roulette'@'localhost';

CREATE TABLE Eleve
(
    nom_Eleve                VARCHAR(20),
    prenom_Eleve             VARCHAR(20),
    classe                   VARCHAR(20),

    idEleve                  INTEGER(150) NOT NULL AUTO_INCREMENT,

    PRIMARY KEY (idEleve)
);

CREATE TABLE Evaluation
(
    date_Evaluation          DATE DEFAULT CURDATE(),
    nom_Evaluation           VARCHAR(20) NOT NULL UNIQUE,

    idEvaluation             INTEGER(150) NOT NULL AUTO_INCREMENT,

    PRIMARY KEY (idEvaluation)
);

CREATE TABLE Note
(
    absence                  BOOLEAN,
    resultat_Note            FLOAT NULL,

    idNote                   INTEGER(150) NOT NULL AUTO_INCREMENT,
    idEleve                  INTEGER(150) NOT NULL,
    idEvaluation             INTEGER(150) NOT NULL,

    FOREIGN KEY (idEleve) REFERENCES Eleve(idEleve) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (idEvaluation) REFERENCES Evaluation(idEvaluation) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY (idNote)
);

/*

INSERT INTO Eleve (nom_Eleve,prenom_Eleve,classe)
VALUES
    ("DECHAPPE","GAETAN","SLAM"),
    ("COLLARD","THIBAULT","SLAM"),
    ("SCHMITT","THOMAS","SLAM"),
    ("HUBERT","LEA","SLAM"),
    ("SARAZIN","KAREN","SLAM"),
    ("TEXEIRA","RYAN","SLAM"),
    ("HUREAUX","SAMUEL","SLAM"),
    ("SACCO","MATHÉO","SLAM"),
    ("LAMABINET","THEO","SLAM"),
    ("GOUVERNEUR","THEO","SLAM"),
    ("SOHIER","ENZO","SISR"),
    ("SAUVAGE","GUILLAUME","SISR"),
    ("TEST","TEST","TEST");

*/

INSERT INTO Eleve (nom_Eleve,prenom_Eleve,classe)
VALUES
    ("DECHAPPE","GAETAN","SLAM"),
    ("NOM1","PRENOM1","SLAM"),
    ("NOM2","PRENOM2","SLAM"),
    ("NOM3","PRENOM3","SLAM"),
    ("NOM4","PRENOM4","SLAM"),
    ("NOM5","PRENOM5","SLAM"),
    ("NOM6","PRENOM7","SLAM"),
    ("NOM7","PRENOM7","SLAM"),
    ("NOM8","PRENOM8","SLAM");