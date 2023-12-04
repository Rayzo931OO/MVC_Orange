drop if exist mvc_orange;

create new databases mvc_orange;

use mvc_orange;

CREATE TABLE user (
   id_utilisateur INT PRIMARY KEY AUTO_INCREMENT UNIQUE,
   nom VARCHAR(50) NOT NULL,
   prenom VARCHAR(50) NOT NULL,
   email VARCHAR(100) NOT NULL,
   code_postal VARCHAR(5) NOT NULL,
   adresse VARCHAR(100) NOT NULL,
   telephone VARCHAR(20) NOT NULL mot_de_passe VARCHAR(16) NOT NULL,
   mot_de_passe VARCHAR(16) NOT NULL,
   date_inscription DATETIME NOT NULL,
   date_modification DATETIME,
   role VARCHAR(10) NOT NULL
);

CREATE TABLE client (
   id_client INT PRIMARY KEY AUTO_INCREMENT UNIQUE,
   id_utilisateur INT,
   info_additionnel VARCHAR(255),
   FOREIGN KEY (id_utilisateur) REFERENCES user(id_utilisateur)
);

CREATE TABLE technicien (
   id_technicien INT PRIMARY KEY AUTO_INCREMENT UNIQUE,
   id_utilisateur INT,
   expertise VARCHAR(255),
   FOREIGN KEY (id_utilisateur) REFERENCES user(id_utilisateur)
);

CREATE TABLE admin (
   id_admin INT PRIMARY KEY AUTO_INCREMENT UNIQUE,
   id_utilisateur INT,
   grade_admin INT,
   FOREIGN KEY (id_utilisateur) REFERENCES user(id_utilisateur)
);

CREATE TABLE intervention (
  id INT PRIMARY KEY AUTO_INCREMENT,
  date_debut DATETIME NOT NULL,
  date_fin DATETIME,
  status VARCHAR(50) NOT NULL,
  description VARCHAR(200) NOT NULL,
  id_materiel INT NOT NULL,
  id_technicien INT NOT NULL,
  FOREIGN KEY (id_materiel) REFERENCES materiel(id_materiel),
  FOREIGN KEY (id_technicien) REFERENCES technicien(id_technicien)
);

CREATE TABLE materiel (
  id_materiel INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(50) NOT NULL,
  description VARCHAR(100) NOT NULL,
  id_client INT NOT NULL,
  categorie VARCHAR(50) NOT NULL,
  FOREIGN KEY (id_client) REFERENCES client(id_client)
);

CREATE TRIGGER insert_user
AFTER
INSERT ON user for each row
BEGIN
if new.role = 'client' then
INSERT INTO client VALUES (null, new.id_utilisateur, "info_additionnel");
ELSE IF new.role = 'technicien' then
INSERT INTO technicien VALUES (null, new.id_utilisateur, "expertise");
ELSE IF new.role = 'admin1' then
INSERT INTO admin VALUES (null, new.id_utilisateur, 1);
ELSE IF new.role = 'admin2' then
INSERT INTO admin VALUES(null, new.id_utilisateur, 2);
ELSE IF new.role = 'admin3' then
INSERT INTO admin VALUES(null, new.id_utilisateur, 3);
end if;
END;

CREATE TRIGGER delete_user
AFTER
INSERT ON user for each row
BEGIN
if new.role = 'client' then
INSERT INTO client VALUES (null, new.id_utilisateur, "info_additionnel");
ELSE IF new.role = 'technicien' then
INSERT INTO technicien VALUES (null, new.id_utilisateur, "expertise");
ELSE IF new.role = 'admin1' then
INSERT INTO admin VALUES (null, new.id_utilisateur, 1);
ELSE IF new.role = 'admin2' then
INSERT INTO admin VALUES(null, new.id_utilisateur, 2);
ELSE IF new.role = 'admin3' then
INSERT INTO admin VALUES(null, new.id_utilisateur, 3);
end if;
END;

-- insert into user a new user with null id
INSERT INTO user VALUES(null,'Doe','John','john.doe@example.com','75000','123 Main St','0123456789','password123',now(),null,'admin1');