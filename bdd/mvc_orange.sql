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
   sexe ENUM("Homme","Femme") NOT NULL,
   mot_de_passe VARCHAR(255) NOT NULL,
  --  avatar VARCHAR(400),
   date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
   date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
   date_archive TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   role ENUM("client","admin","superviseur","technicien") NOT NULL
);

CREATE TABLE user_archive (
   id_utilisateur INT PRIMARY KEY,
   nom VARCHAR(255) NOT NULL,
   prenom VARCHAR(255) NOT NULL,
   email VARCHAR(255) NOT NULL,
   code_postal VARCHAR(5) NOT NULL,
   adresse VARCHAR(255) NOT NULL,
   telephone VARCHAR(50) NOT NULL,
    sexe ENUM("Homme","Femme") NOT NULL,
   mot_de_passe VARCHAR(255) NOT NULL,
  --  avatar VARCHAR(400),
   date_inscription TIMESTAMP NOT NULL,
   date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
   date_archive TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
   role ENUM("client","admin","superviseur","technicien") NOT NULL
);

/**
 * Ce déclencheur est exécuté avant la suppression d'une ligne dans la table "user".
 * Il effectue les actions suivantes :
 * 1. Insère la ligne à supprimer dans la table "user_archive".
 * 2. Supprime les interventions liées en fonction du rôle de l'utilisateur.
 *    - Si le rôle est "client", supprime les interventions où l'utilisateur est le client.
 *    - Si le rôle est "technicien", supprime les interventions où l'utilisateur est le technicien.
 *    - Si le rôle est "admin", aucune action spécifique n'est effectuée.
 */
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
  priorite enum ('Mineur', 'Urgente') NOT NULL,
  id_technicien INT NULL,
  id_client INT NOT NULL,
  id_materiel INT,
  FOREIGN KEY (id_client) REFERENCES user(id_utilisateur) ON DELETE CASCADE,
  FOREIGN KEY (id_technicien) REFERENCES user(id_utilisateur) ON DELETE CASCADE,
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
  priorite enum ('Mineur', 'Urgente') NOT NULL,
  id_client INT NOT NULL,
  id_materiel INT NOT NULL,
  id_technicien INT NOT NULL
);

DELIMITER $
CREATE FUNCTION create_intervention(
    date_inter DATETIME,
    status VARCHAR(50),
    description VARCHAR(200),
    priorite ENUM('Mineur', 'Urgente'),
    id_technicien INT,
    id_materiel INT,
    id_client INT
)
RETURNS VARCHAR(200)
BEGIN
    INSERT INTO intervention (
        date_inter,
        status,
        description,
        priorite,
        id_technicien,
        id_materiel,
        id_client
    ) VALUES (
        date_inter,
        status,
        description,
        priorite,
        id_technicien,
        id_materiel,
        id_client
    );
    RETURN CONCAT('Création faite, id=', last_insert_id());
END$
DELIMITER ;

DELIMITER $
CREATE FUNCTION update_user(
   u_id_utilisateur INT,
   u_nom VARCHAR(255),
   u_prenom VARCHAR(255) ,
   u_code_postal VARCHAR(5),
   u_adresse VARCHAR(255),
   u_telephone VARCHAR(50),
   u_sexe ENUM("Homme","Femme")
)
RETURNS BOOLEAN
BEGIN
    UPDATE user
    SET nom = u_nom,
        prenom = u_prenom,
        code_postal = u_code_postal,
        adresse = u_adresse,
        telephone = u_telephone,
        sexe = u_sexe
    WHERE id_utilisateur = u_id_utilisateur;
    RETURN true;
END$
DELIMITER ;

DELIMITER $
CREATE FUNCTION update_user_with_role(
   u_id_utilisateur INT,
   u_nom VARCHAR(255),
   u_prenom VARCHAR(255) ,
   u_code_postal VARCHAR(5),
   u_adresse VARCHAR(255),
   u_telephone VARCHAR(50),
   u_sexe ENUM("Homme","Femme"),
   u_role ENUM("client","admin","superviseur","technicien")
)
RETURNS BOOLEAN
BEGIN
    UPDATE user
    SET nom = u_nom,
        prenom = u_prenom,
        code_postal = u_code_postal,
        adresse = u_adresse,
        telephone = u_telephone,
        sexe = u_sexe,
        role = u_role
    WHERE id_utilisateur = u_id_utilisateur;
    RETURN true;
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
CREATE VIEW superviseur_view AS (
    SELECT *
    FROM user
    WHERE role = 'superviseur'
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

CREATE VIEW nbIntersUrgentes as (
    select u.nom, u.prenom, count(i.id_intervention) as nbInterventions
    from user u, intervention i
    where u.id_utilisateur = i.id_technicien and i.priorite = 'Urgente' and i.status = 'En cours'
    group by u.nom, u.prenom
    order by u.nom, u.prenom
);


INSERT INTO user (nom, prenom, email, code_postal, adresse, telephone, sexe , mot_de_passe, role) VALUES
('Dupont', 'Jean', 'client1@email.com', '75001', '123 Rue de Paris', '0123456789','Homme' , 'password123', 'client'),
('Martin', 'Alice', 'technicien@email.com', '69001', '456 Avenue de Lyon', '0987654321', 'Femme' , 'password123', 'technicien'),
('Bernard', 'Lucas', 'admin@email.com', '31000', '789 Rue de Toulouse', '1122334455', 'Homme' , 'password123', 'admin'),
('Petit', 'Chloé', 'client2@email.com', '33000', '321 Rue de Bordeaux', '2233445566', 'Femme' , 'password123', 'client'),
('Lea', 'Mathilde', 'superviseur@email.com', '33300', '323 Rue de Bordeaux', '1234567789', 'Femme' , 'password123', 'superviseur');

INSERT INTO materiel (nom, description) VALUES
('Ordinateur Portable', 'Un ordinateur portable de haute performance'),
('Imprimante Laser', 'Imprimante laser haute performance'),
('Disque Dur Externe', 'Disque dur externe de 1To'),
('Souris sans fil', 'Souris ergonomique sans fil');

INSERT INTO intervention (date_inter, status, description,priorite, id_technicien,id_materiel, id_client) VALUES
('2023-01-01 08:00:00', 'En cours', "Installation d'antivirus","Urgente",null,1,4);
-- INSERT INTO jonction_materiel_categorie (id_materiel, id_categorie) VALUES
-- (1, 1);

-- INSERT INTO jonction_logiciel_categorie (id_logiciel, id_categorie) VALUES
-- (1, 3);


-- j'aimerais avoir une requete qui permet de filtrer les interventions par priorité urgent en haut et mineur en bas

-- SELECT * FROM intervention ORDER BY FIELD(priorite, 'Urgente', 'Mineur');

-- j'aimerais une vue qui me donnera les nom et prenom de technicien et le nombre d'interventions qu'ils ont qui sont à la fois en cours et urgentes



