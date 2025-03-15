CREATE TABLE voyageurs (
    id_voyageur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255),
    prenom VARCHAR(255),
    ville VARCHAR(255),
    region VARCHAR(255)
);

CREATE TABLE sejours (
    id_sejour INT AUTO_INCREMENT PRIMARY KEY,
    id_voyageur INT,
    code_logement VARCHAR(255),
    debut DATE,
    fin DATE,
    FOREIGN KEY (id_voyageur) REFERENCES Voyageur(id_voyageur),
    FOREIGN KEY (code_logement) REFERENCES Logement(code)
);

CREATE TABLE logements (
    code VARCHAR(255) PRIMARY KEY,
    nom VARCHAR(255),
    capacite INT,
    type VARCHAR(255),
    lieu VARCHAR(255)
);

CREATE TABLE activites (
    code_logement VARCHAR(255),
    code_activite VARCHAR(255),
    description TEXT,
    PRIMARY KEY (code_logement, code_activite),
    FOREIGN KEY (code_logement) REFERENCES Logement(code)
);