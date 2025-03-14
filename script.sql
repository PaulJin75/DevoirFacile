
CREATE TABLE Utilisateurs (
    ID_utilisateur INT PRIMARY KEY AUTO_INCREMENT,
    Nom VARCHAR(50),
    Email VARCHAR(100),
    Mot_passe VARCHAR(60),
    Est_admin BOOLEAN DEFAULT FALSE -- TRUE pour admin, FALSE pour client
);


CREATE TABLE Matieres (
    ID_matiere INT PRIMARY KEY AUTO_INCREMENT,
    Libelle_matiere VARCHAR(50)
);


CREATE TABLE Niveaux (
    ID_niveau INT PRIMARY KEY AUTO_INCREMENT,
    Libelle_niveau VARCHAR(50)
);


CREATE TABLE Disponibilites (
    ID_disponibilite INT PRIMARY KEY AUTO_INCREMENT,
    Date_heure DATETIME 
);


CREATE TABLE Cours (
    ID_cours INT PRIMARY KEY AUTO_INCREMENT,
    Tarif DECIMAL(10,2),
    ID_client INT,
    ID_matiere INT,
    ID_niveau INT,
    ID_disponibilite INT,
    FOREIGN KEY (ID_client) REFERENCES Utilisateurs(ID_utilisateur),
    FOREIGN KEY (ID_matiere) REFERENCES Matieres(ID_matiere),
    FOREIGN KEY (ID_niveau) REFERENCES Niveaux(ID_niveau),
    FOREIGN KEY (ID_disponibilite) REFERENCES Disponibilites(ID_disponibilite)
);


CREATE TABLE Etats_cours (
    ID_etat INT PRIMARY KEY AUTO_INCREMENT,
    Libelle_etat VARCHAR(50)
);


CREATE TABLE Cours_Etats (
    ID_cours INT,
    ID_etat INT,
    PRIMARY KEY (ID_cours, ID_etat),
    FOREIGN KEY (ID_cours) REFERENCES Cours(ID_cours),
    FOREIGN KEY (ID_etat) REFERENCES Etats_cours(ID_etat)
);


CREATE TABLE Paiements (
    ID_paiement INT PRIMARY KEY AUTO_INCREMENT,
    Date_paiement DATETIME,
    Montant DECIMAL(10,2)
);


CREATE TABLE Cours_Paiements (
    ID_cours INT,
    ID_paiement INT,
    PRIMARY KEY (ID_cours, ID_paiement),
    FOREIGN KEY (ID_cours) REFERENCES Cours(ID_cours),
    FOREIGN KEY (ID_paiement) REFERENCES Paiements(ID_paiement)
);


CREATE TABLE Etats_paiements (
    ID_etat_paiement INT PRIMARY KEY AUTO_INCREMENT,
    Libelle_etat_paiement VARCHAR(50) 
);


CREATE TABLE Paiements_Etats (
    ID_paiement INT,
    ID_etat_paiement INT,
    PRIMARY KEY (ID_paiement, ID_etat_paiement),
    FOREIGN KEY (ID_paiement) REFERENCES Paiements(ID_paiement),
    FOREIGN KEY (ID_etat_paiement) REFERENCES Etats_paiements(ID_etat_paiement)
);