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
   telephone VARCHAR(20) NOT NULL,
   mot_de_passe VARCHAR(255) NOT NULL,
   date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
   role VARCHAR(20) NOT NULL
);

CREATE TABLE user_archive (
   id_utilisateur INT PRIMARY KEY,
   nom VARCHAR(255) NOT NULL,
   prenom VARCHAR(255) NOT NULL,
   email VARCHAR(255) NOT NULL,
   code_postal VARCHAR(5) NOT NULL,
   adresse VARCHAR(255) NOT NULL,
   telephone VARCHAR(20) NOT NULL,
   mot_de_passe VARCHAR(255) NOT NULL,
   date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
   role VARCHAR(20) NOT NULL
);

CREATE TABLE technicien (
   id_technicien INT PRIMARY KEY AUTO_INCREMENT,
   id_utilisateur INT,
   expertise VARCHAR(255),
   FOREIGN KEY (id_utilisateur) REFERENCES user(id_utilisateur)
);

CREATE TABLE admin (
   id_admin INT PRIMARY KEY AUTO_INCREMENT,
   id_utilisateur INT,
   grade_admin INT,
   FOREIGN KEY (id_utilisateur) REFERENCES user(id_utilisateur)
);

CREATE TABLE client (
   id_client INT PRIMARY KEY AUTO_INCREMENT,
   id_utilisateur INT,
   info_additionnel VARCHAR(255),
   FOREIGN KEY (id_utilisateur) REFERENCES user(id_utilisateur)
);

DELIMITER $
CREATE TRIGGER after_insert_user
AFTER INSERT ON user FOR EACH ROW
BEGIN
    IF NEW.role = 'client' THEN
        INSERT INTO client (id_utilisateur, info_additionnel) VALUES (NEW.id_utilisateur, "info_additionnel");
    ELSEIF NEW.role = 'technicien' THEN
        INSERT INTO technicien (id_utilisateur, expertise) VALUES (NEW.id_utilisateur, "expertise");
    ELSEIF NEW.role LIKE 'admin%' THEN
        INSERT INTO admin (id_utilisateur, grade_admin) VALUES (NEW.id_utilisateur, SUBSTRING(NEW.role, 6));
    END IF;
END$
DELIMITER ;

DELIMITER $
CREATE TRIGGER before_delete_user
BEFORE DELETE ON user FOR EACH ROW
BEGIN
    INSERT INTO user_archive SELECT * FROM user WHERE id_utilisateur = OLD.id_utilisateur;
    DELETE FROM client WHERE id_utilisateur = OLD.id_utilisateur;
    DELETE FROM technicien WHERE id_utilisateur = OLD.id_utilisateur;
    DELETE FROM admin WHERE id_utilisateur = OLD.id_utilisateur;
END$
DELIMITER ;

CREATE INDEX idx_user_email ON user(email);
CREATE INDEX idx_client_user ON client(id_utilisateur);
CREATE INDEX idx_technicien_user ON technicien(id_utilisateur);
CREATE INDEX idx_admin_user ON admin(id_utilisateur);

CREATE TABLE categorie (
  id_categorie INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(50) NOT NULL,
  description VARCHAR(100) NOT NULL
);

CREATE TABLE materiel (
  id_materiel INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(50) NOT NULL,
  description VARCHAR(100) NOT NULL,
  id_categorie INT NOT NULL,
  FOREIGN KEY (id_categorie) REFERENCES categorie(id_categorie)
);

CREATE TABLE logiciel (
  id_logiciel INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(50) NOT NULL,
  description VARCHAR(100) NOT NULL,
  version VARCHAR(50) NOT NULL,
  id_categorie INT NOT NULL,
  FOREIGN KEY (id_categorie) REFERENCES categorie(id_categorie)
);

CREATE TABLE intervention (
  id_intervention INT PRIMARY KEY AUTO_INCREMENT,
  date_debut DATETIME NOT NULL,
  date_fin DATETIME,
  date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  status VARCHAR(50) NOT NULL,
  description VARCHAR(200) NOT NULL,
  id_technicien INT NOT NULL,
  id_materiel INT,
  id_logiciel INT,
  id_type_intervention INT NOT NULL,
  FOREIGN KEY (id_technicien) REFERENCES technicien(id_technicien),
  FOREIGN KEY (id_logiciel) REFERENCES logiciel(id_logiciel),
  FOREIGN KEY (id_materiel) REFERENCES materiel(id_materiel)
);

CREATE TABLE type_intervention (
  id_type_intervention INT PRIMARY KEY AUTO_INCREMENT,
  id_intervention INT,
  nom VARCHAR(50) NOT NULL,
  description VARCHAR(200) NOT NULL,
  FOREIGN KEY (id_intervention) REFERENCES intervention(id_intervention)
);

DELIMITER $
CREATE TRIGGER before_delete_intervention
BEFORE DELETE ON intervention FOR EACH ROW
BEGIN
    INSERT INTO intervention_archive SELECT * FROM intervention WHERE id_intervention = OLD.id_intervention;
END$
DELIMITER ;

CREATE TABLE archive_intervention (
  id_intervention INT PRIMARY KEY,
  date_debut DATETIME NOT NULL,
  date_fin DATETIME,
  date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  status VARCHAR(50) NOT NULL,
  description VARCHAR(200) NOT NULL,
  id_materiel INT NOT NULL,
  id_logiciel INT NOT NULL,
  id_technicien INT NOT NULL,
  id_type_intervention INT NOT NULL
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
    id_type_intervention INT
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
        id_type_intervention
    ) VALUES (
        date_debut,
        date_fin,
        status,
        description,
        id_technicien,
        id_logiciel,
        id_materiel,
        id_type_intervention
    );
    RETURN CONCAT('Création faite, id=', last_insert_id());
END$
DELIMITER ;


-- CREATE TABLE jonction_materiel_categorie (
--   id_materiel INT NOT NULL,
--   id_categorie INT NOT NULL,
--   PRIMARY KEY (id_materiel, id_categorie),
--   FOREIGN KEY (id_materiel) REFERENCES materiel(id_materiel),
--   FOREIGN KEY (id_categorie) REFERENCES categorie(id_categorie)
-- );

-- CREATE TABLE jonction_logiciel_categorie (
--   id_logiciel INT NOT NULL,
--   id_categorie INT NOT NULL,
--   PRIMARY KEY (id_logiciel, id_categorie),
--   FOREIGN KEY (id_logiciel) REFERENCES logiciel(id_logiciel),
--   FOREIGN KEY (id_categorie) REFERENCES categorie(id_categorie)
-- );

-- DELIMITER $
-- CREATE TRIGGER insert_materiel
-- AFTER INSERT ON materiel FOR EACH ROW
-- BEGIN
--    INSERT INTO junction_materiel_categorie(id_materiel, id_categorie) VALUES (NEW.id_materiel, NEW.id_categorie);
-- END$
-- DELIMITER ;

-- DELIMITER $
-- CREATE TRIGGER insert_logiciel
-- AFTER INSERT ON logiciel FOR EACH ROW
-- BEGIN
--    INSERT INTO junction_logiciel_categorie(id_logiciel, id_categorie) VALUES (NEW.id_logiciel, NEW.id_categorie);
-- END$
-- DELIMITER ;

CREATE VIEW intervention_view AS (
    SELECT
        intervention.id_intervention AS inter_id,
        intervention.date_debut,
        intervention.date_fin,
        intervention.date_creation,
        intervention.date_modification,
        intervention.status,
        intervention.description AS interDescription,
        intervention.id_technicien,
        intervention.id_logiciel,
        intervention.id_materiel,
        type_intervention.id_type_intervention
    FROM intervention
    INNER JOIN type_intervention ON intervention.id_intervention = type_intervention.id_intervention
);

-- CREATE TABLE intervention (
--   id_intervention INT PRIMARY KEY AUTO_INCREMENT,
--   date_debut DATETIME NOT NULL,
--   date_fin DATETIME,
--   date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--   date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
--   status VARCHAR(50) NOT NULL,
--   description VARCHAR(200) NOT NULL,
--   id_technicien INT NOT NULL,
--   id_type_intervention INT NOT NULL,
--   FOREIGN KEY (id_technicien) REFERENCES technicien(id_technicien)
-- )

CREATE VIEW techniciens_view AS (
    SELECT
        user.id_utilisateur AS user_id,
        user.nom,
        user.prenom,
        user.email,
        user.code_postal,
        user.adresse,
        user.telephone,
        user.mot_de_passe,
        user.date_inscription,
        user.date_modification,
        user.role,
        technicien.id_technicien,
        technicien.expertise
    FROM user
    INNER JOIN technicien ON user.id_utilisateur = technicien.id_utilisateur
);
CREATE VIEW admin_view AS (
    SELECT
        user.id_utilisateur AS user_id,
        user.nom,
        user.prenom,
        user.email,
        user.code_postal,
        user.adresse,
        user.telephone,
        user.mot_de_passe,
        user.date_inscription,
        user.date_modification,
        user.role,
        admin.id_admin,
        admin.grade_admin
    FROM user
    INNER JOIN admin ON user.id_utilisateur = admin.id_utilisateur
);
CREATE VIEW client_view AS (
    SELECT
        user.id_utilisateur AS user_id,
        user.nom,
        user.prenom,
        user.email,
        user.code_postal,
        user.adresse,
        user.telephone,
        user.mot_de_passe,
        user.date_inscription,
        user.date_modification,
        user.role,
        client.id_client,
        client.info_additionnel
    FROM user
    INNER JOIN client ON user.id_utilisateur = client.id_utilisateur
);

CREATE VIEW type_intervention_view AS (
   SELECT * FROM type_intervention
);
CREATE VIEW categorie_view AS (
   SELECT * FROM categorie
);
CREATE VIEW materiel_view AS (
   SELECT * FROM categorie
);
CREATE VIEW logiciel_view AS (
   SELECT * FROM categorie
);


INSERT INTO user (nom, prenom, email, code_postal, adresse, telephone, mot_de_passe, role) VALUES
('Dupont', 'Jean', 'jean.dupont@email.com', '75001', '123 Rue de Paris', '0123456789', 'password123', 'client'),
('Martin', 'Alice', 'alice.martin@email.com', '69001', '456 Avenue de Lyon', '0987654321', 'motdepasse456', 'technicien'),
('Bernard', 'Lucas', 'lucas.bernard@email.com', '31000', '789 Rue de Toulouse', '1122334455', 'password789', 'admin1'),
('Petit', 'Chloé', 'chloe.petit@email.com', '33000', '321 Rue de Bordeaux', '2233445566', 'passe321', 'client');
INSERT INTO categorie (nom, description) VALUES
('Ordinateurs', 'Catégorie pour tous les ordinateurs'),
('Imprimantes', 'Catégorie pour toutes les imprimantes'),
('Logiciels de Sécurité', 'Catégorie pour les logiciels de sécurité'),
('Périphériques', 'Catégorie pour les périphériques informatiques');
INSERT INTO materiel (nom, description, id_categorie) VALUES
('Ordinateur Portable', 'Un ordinateur portable de haute performance',1),
('Imprimante Laser', 'Imprimante laser haute performance',2),
('Disque Dur Externe', 'Disque dur externe de 1To',3),
('Souris sans fil', 'Souris ergonomique sans fil',4);
INSERT INTO logiciel (nom, description, version, id_categorie) VALUES
('Antivirus Pro', 'Logiciel antivirus avancé', '2023',2),
('Photoshop', "Logiciel de traitement d'image", '2023',4),
("Système d'exploitation XYZ", "Nouveau système d'exploitation", '10.0',1);
INSERT INTO type_intervention (nom, description) VALUES
('Installation logicielle', 'Installation de divers logiciels'),
('Réparation matériel', 'Réparation de divers équipements informatiques'),
('Mise à jour système', "Mise à jour de systèmes d'exploitation et logiciels"),
('Nettoyage informatique', 'Nettoyage physique et logiciel des systèmes informatiques');
-- INSERT INTO technicien (id_utilisateur, expertise) VALUES
-- (2, 'Réseaux'),
-- (3, 'Maintenance');

-- INSERT INTO admin (id_utilisateur, grade_admin) VALUES
-- (3, 2);

-- INSERT INTO client (id_utilisateur, info_additionnel) VALUES
-- (1, 'Informations client Dupont'),
-- (4, 'Informations client Petit');
INSERT INTO intervention (date_debut, date_fin, status, description, id_technicien,id_materiel,id_logiciel, id_type_intervention) VALUES
('2023-01-01 08:00:00', '2023-01-01 12:00:00', 'En cours', "Installation d'antivirus",1,1,null,1);
-- INSERT INTO jonction_materiel_categorie (id_materiel, id_categorie) VALUES
-- (1, 1);

-- INSERT INTO jonction_logiciel_categorie (id_logiciel, id_categorie) VALUES
-- (1, 3);