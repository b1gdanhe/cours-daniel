CREATE DATABASE gest_immo DEFAULT CHARACTER SET = 'utf8mb4';

use gest_immo;

CREATE TABLE IF NOT EXISTS immeubles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    address VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS appartements (
    id INT PRIMARY KEY AUTO_INCREMENT,
    number INT NOT NULL CHECK (number > 0),
    area INT NOT NULL CHECK (area > 0),
    level INT NOT NULL CHECK (level > 0),
    immeuble_id INT,
    FOREIGN KEY (immeuble_id) REFERENCES immeubles (id) CASCADE ON DELETE
);

CREATE TABLE IF NOT EXISTS persons (
    id INT PRIMARY KEY AUTO_INCREMENT,
    lastname VARCHAR(50) NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    jobs VARCHAR(50) NOT NULL,
    appartement_id INT,
    FOREIGN KEY (appartement_id) REFERENCES appartements (id)
);

CREATE TABLE IF NOT EXISTS owners (
    appartement_id INT,
    FOREIGN KEY (appartement_id) REFERENCES appartements (id),
    person_id INT,
    FOREIGN KEY (person_id) REFERENCES persons (id),
    quote_part DECIMAL(5, 2) NOT NULL
);