DROP DATABASE IF EXISTS mvc_orange;
CREATE DATABASE mvc_orange;
USE mvc_orange;

CREATE TABLE user (
   id_utilisateur INT PRIMARY KEY AUTO_INCREMENT,
   nom VARCHAR(255) NOT NULL,
   prenom VARCHAR(255) NOT NULL,
   email VARCHAR(255) NOT NULL UNIQUE,
   code_postal VARCHAR(5) NOT NULL,
   adresse VARCHAR(255) NOT NULL,
   telephone VARCHAR(50) NOT NULL,
   mot_de_passe VARCHAR(255) NOT NULL,
  --  avatar VARCHAR(400),
   date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
   date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
   date_archive TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   role ENUM("client","admin","technicien") NOT NULL
);

CREATE TABLE user_archive (
   id_utilisateur INT PRIMARY KEY,
   nom VARCHAR(255) NOT NULL,
   prenom VARCHAR(255) NOT NULL,
   email VARCHAR(255) NOT NULL,
   code_postal VARCHAR(5) NOT NULL,
   adresse VARCHAR(255) NOT NULL,
   telephone VARCHAR(50) NOT NULL,
   mot_de_passe VARCHAR(255) NOT NULL,
  --  avatar VARCHAR(400),
   date_inscription TIMESTAMP NOT NULL,
   date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
   date_archive TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
   role ENUM("client","admin","technicien") NOT NULL
);

DELIMITER $
CREATE TRIGGER before_delete_user
BEFORE DELETE ON user FOR EACH ROW
BEGIN
    INSERT INTO user_archive SELECT * FROM user WHERE id_utilisateur = OLD.id_utilisateur;
END$
DELIMITER ;

CREATE INDEX idx_user_email ON user(email);


CREATE TABLE materiel (
  id_materiel INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(50) NOT NULL,
  description VARCHAR(100) NOT NULL
);

CREATE TABLE intervention (
  id_intervention INT PRIMARY KEY AUTO_INCREMENT,
  date_inter DATETIME,
  date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  status VARCHAR(100) NOT NULL,
  date_archive TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--   status enum ('En cours', 'Termine', 'Annulé') NOT NULL,
  description VARCHAR(200) NOT NULL,
  id_technicien INT NULL,
  id_client INT NOT NULL,
  id_materiel INT,
  FOREIGN KEY (id_client) REFERENCES user(id_utilisateur),
  FOREIGN KEY (id_technicien) REFERENCES user(id_utilisateur),
  FOREIGN KEY (id_materiel) REFERENCES materiel(id_materiel)
);

DELIMITER $
CREATE TRIGGER before_delete_intervention
BEFORE DELETE ON intervention FOR EACH ROW
BEGIN
    INSERT INTO archive_intervention SELECT * FROM intervention WHERE id_intervention = OLD.id_intervention;
END$
DELIMITER ;

CREATE TABLE archive_intervention (
  id_intervention INT PRIMARY KEY,
  date_inter DATETIME,
  date_creation TIMESTAMP NOT NULL,
  date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  date_archive TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  status VARCHAR(100) NOT NULL,
  description VARCHAR(200) NOT NULL,
  id_client INT NOT NULL,
  id_materiel INT NOT NULL,
  id_technicien INT NOT NULL
);

DELIMITER $
CREATE FUNCTION create_intervention(
    date_debut DATETIME,
    date_fin DATETIME,
    status VARCHAR(50),
    description VARCHAR(200),
    id_technicien INT,
    id_logiciel INT,
    id_materiel INT,
    id_client INT
)
RETURNS VARCHAR(200)
BEGIN
    INSERT INTO intervention (
        date_debut,
        date_fin,
        status,
        description,
        id_technicien,
        id_logiciel,
        id_materiel,
        id_client
    ) VALUES (
        date_debut,
        date_fin,
        status,
        description,
        id_technicien,
        id_logiciel,
        id_materiel,
        id_client
    );
    RETURN CONCAT('Création faite, id=', last_insert_id());
END$
DELIMITER ;

CREATE VIEW intervention_view AS
SELECT *
FROM intervention;


CREATE VIEW users_view AS (
    SELECT *
    FROM user
);
CREATE VIEW techniciens_view AS (
    SELECT *
    FROM user
    WHERE role = 'technicien'
);
CREATE VIEW admin_view AS (
    SELECT *
    FROM user
    WHERE role = 'admin'
);
CREATE VIEW client_view AS (
    SELECT *
    FROM user
    WHERE role = 'client'
);

CREATE VIEW materiel_view AS (
   SELECT * FROM materiel
);
CREATE VIEW nbIntersAdmins as (
	select u.nom, u.prenom, count(i.id_intervention) as nbInterventions
	from user u, intervention i
	where u.id_utilisateur = i.id_technicien
	group by u.nom, u.prenom
	order by u.nom, u.prenom
);


INSERT INTO user (nom, prenom, email, code_postal, adresse, telephone, mot_de_passe, role) VALUES
('Dupont', 'Jean', 'client1@email.com', '75001', '123 Rue de Paris', '0123456789', 'password123', 'client'),
('Martin', 'Alice', 'technicien@email.com', '69001', '456 Avenue de Lyon', '0987654321', 'password123', 'technicien'),
('Bernard', 'Lucas', 'admin@email.com', '31000', '789 Rue de Toulouse', '1122334455', 'password123', 'admin'),
('Petit', 'Chloé', 'client2@email.com', '33000', '321 Rue de Bordeaux', '2233445566', 'password123', 'client');

INSERT INTO materiel (nom, description) VALUES
('Ordinateur Portable', 'Un ordinateur portable de haute performance'),
('Imprimante Laser', 'Imprimante laser haute performance'),
('Disque Dur Externe', 'Disque dur externe de 1To'),
('Souris sans fil', 'Souris ergonomique sans fil');

INSERT INTO intervention (date_inter, status, description, id_technicien,id_materiel, id_client) VALUES
('2023-01-01 08:00:00', 'En cours', "Installation d'antivirus",null,1,4);
-- INSERT INTO jonction_materiel_categorie (id_materiel, id_categorie) VALUES
-- (1, 1);

-- INSERT INTO jonction_logiciel_categorie (id_logiciel, id_categorie) VALUES
-- (1, 3);