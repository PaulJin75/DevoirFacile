CREATE TABLE Utilisateurs (
    ID_utilisateurs INT PRIMARY KEY AUTO_INCREMENT,
    Nom VARCHAR(30),
    Email VARCHAR(60)
);


CREATE TABLE Administrateur (
    ID_Administrateur INT PRIMARY KEY AUTO_INCREMENT,
    Nom_Administrateur VARCHAR(50),
    Mot_passe VARCHAR(60) 
);


CREATE TABLE Clients (
    ID_Clients INT PRIMARY KEY AUTO_INCREMENT,
    Nom VARCHAR(30),
    Email VARCHAR(50),
    Mot_passe VARCHAR(60),
    ID_utilisateurs INT,
    FOREIGN KEY (ID_utilisateurs) REFERENCES Utilisateurs(ID_utilisateurs)
);


CREATE TABLE Matières (
    ID_Matières INT PRIMARY KEY AUTO_INCREMENT,
    Libelle_matières VARCHAR(25)
);


CREATE TABLE Niveaux (
    ID_Niveaux INT PRIMARY KEY AUTO_INCREMENT,
    Libelle_niveaux VARCHAR(25)
);


CREATE TABLE États_cours (
    ID_États INT PRIMARY KEY AUTO_INCREMENT,
    Libelle_États_cours VARCHAR(25)
);


CREATE TABLE États_Paiements (
    ID_etat_paiements INT PRIMARY KEY AUTO_INCREMENT,
    Libelle_états_Paiements VARCHAR(25)
);


CREATE TABLE Disponibilités (
    ID_Disponibilités INT PRIMARY KEY AUTO_INCREMENT,
    Libelle_Disponibilités VARCHAR(25)
);


CREATE TABLE Paiements (
    ID_Paiements INT PRIMARY KEY AUTO_INCREMENT,
    Date_paiement DATETIME
);


CREATE TABLE Cours (
    ID_Cours INT PRIMARY KEY AUTO_INCREMENT,
    Tarif DECIMAL(10,2),
    Date_cours DATETIME,
    Heure_cours TIME,
    ID_Clients INT,
    FOREIGN KEY (ID_Clients) REFERENCES Clients(ID_Clients)
);


CREATE TABLE Créneaux_horaires (
    ID_Créneaux_horaires INT PRIMARY KEY AUTO_INCREMENT,
    Date_creneaux DATETIME,
    Heure_creneaux TIME,
    ID_Disponibilités INT, 
    FOREIGN KEY (ID_Disponibilités) REFERENCES Disponibilités(ID_Disponibilités)
);


CREATE TABLE avoir_matière (
    ID_utilisateurs INT,
    ID_Matières INT,
    PRIMARY KEY (ID_utilisateurs, ID_Matières),
    FOREIGN KEY (ID_utilisateurs) REFERENCES Utilisateurs(ID_utilisateurs),
    FOREIGN KEY (ID_Matières) REFERENCES Matières(ID_Matières)
);


CREATE TABLE avoir_niveau (
    ID_utilisateurs INT,
    ID_Niveaux INT,
    PRIMARY KEY (ID_utilisateurs, ID_Niveaux),
    FOREIGN KEY (ID_utilisateurs) REFERENCES Utilisateurs(ID_utilisateurs),
    FOREIGN KEY (ID_Niveaux) REFERENCES Niveaux(ID_Niveaux)
);


CREATE TABLE être (
    ID_Cours INT,
    ID_États INT,
    PRIMARY KEY (ID_Cours, ID_États),
    FOREIGN KEY (ID_Cours) REFERENCES Cours(ID_Cours),
    FOREIGN KEY (ID_États) REFERENCES États_cours(ID_États)
);

CREATE TABLE être_états_paiement (
    ID_Paiements INT,
    ID_etat_paiements INT,
    PRIMARY KEY (ID_Paiements, ID_etat_paiements),
    FOREIGN KEY (ID_Paiements) REFERENCES Paiements(ID_Paiements),
    FOREIGN KEY (ID_etat_paiements) REFERENCES États_Paiements(ID_etat_paiements)
);


CREATE TABLE être_disponible (
    ID_Disponibilités INT,
    ID_Créneaux_horaires INT,
    PRIMARY KEY (ID_Disponibilités, ID_Créneaux_horaires),
    FOREIGN KEY (ID_Disponibilités) REFERENCES Disponibilités(ID_Disponibilités),
    FOREIGN KEY (ID_Créneaux_horaires) REFERENCES Créneaux_horaires(ID_Créneaux_horaires)
);


CREATE TABLE réserver (
    ID_Cours INT,
    ID_Disponibilités INT,
    PRIMARY KEY (ID_Cours, ID_Disponibilités),
    FOREIGN KEY (ID_Cours) REFERENCES Cours(ID_Cours),
    FOREIGN KEY (ID_Disponibilités) REFERENCES Disponibilités(ID_Disponibilités)
);


CREATE TABLE correspondre (
    ID_Cours INT,
    ID_Paiements INT,
    PRIMARY KEY (ID_Cours, ID_Paiements),
    FOREIGN KEY (ID_Cours) REFERENCES Cours(ID_Cours),
    FOREIGN KEY (ID_Paiements) REFERENCES Paiements(ID_Paiements)
);