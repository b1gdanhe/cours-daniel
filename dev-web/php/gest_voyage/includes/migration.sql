CREATE TABLE voyageurs (
    id_voyageur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255),
    prenom VARCHAR(255),
    ville VARCHAR(255),
    region VARCHAR(255)
);

CREATE TABLE logements (
    code INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255),
    capacite INT,
    type VARCHAR(255),
    lieu VARCHAR(255)
);

CREATE TABLE sejours (
    id_sejour INT AUTO_INCREMENT PRIMARY KEY,
    id_voyageur INT,
    code_logement VARCHAR(255),
    debut DATE,
    fin DATE,
    FOREIGN KEY (id_voyageur) REFERENCES voyageurs(id_voyageur),
    FOREIGN KEY (code_logement) REFERENCES logements(code)
);



CREATE TABLE activites (
    code_logement INT,
    code_activite INT AUTO_INCREMENT PRIMARY KEY,
    description TEXT,
    PRIMARY KEY (code_logement, code_activite),
    FOREIGN KEY (code_logement) REFERENCES logements(code)
);