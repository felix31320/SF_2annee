/*

<?php 

try
{
	// On se connecte à MySQL
	$mysqlClient = new PDO('mysql:host=localhost;dbname=camping;charset=utf8', 'root', 'root');

}

catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

?>

*/

CREATE DATABASE camping




-- Compteur(n compteur, libellé, #n emplacement) --


CREATE TABLE compteurs (
    n_compteur INT NOT NULL,
    libelle VARCHAR(50),
    n_empl INT,
    PRIMARY KEY (n_compteur),
    CONSTRAINT FK_compteurs_emplacements
        FOREIGN KEY (n_empl)
        REFERENCES Emplacements(n_emplacement)
);


-- Types Emplacement(id type emplacement, type) --


CREATE TABLE Types_Emplacements(
    id INT,
    id_type_emplacement VARCHAR(50),
    `type` VARCHAR(50),
    PRIMARY KEY(id)
);


-- Emplacements(n° emplacement, place parking, ombre, electricite, nb points, #id type emplacement, #id zone) --


CREATE TABLE Emplacements(
    n_emplacement INT NOT NULL,
    place_parking INT NOT NULL DEFAULT 0,
    ombre BOOLEAN,
    electricite BOOLEAN,
    nb_points INT,
    id INT,
    id_zone INT,
    PRIMARY KEY (n_emplacement),
    CONSTRAINT FK_emplacement_type
    FOREIGN KEY (id) REFERENCES Types_Emplacements(id),
    CONSTRAINT FK_emplacement_zones
    FOREIGN KEY (id_zone) REFERENCES zones(id_zone)
);


-- Zones(id zone, nom zone) --


CREATE TABLE zones(
    id_zone INT,
    nom_zone VARCHAR(50),
    PRIMARY KEY (id_zone)
);


-- Types activités(id type actvité, thème) --


CREATE TABLE Types_activités (
    id_type_activité INT,
    thème VARCHAR(50),
    PRIMARY KEY (id_type_activité)
);


-- Activités(réf activité, prix, #id zone, #id type activité) --


CREATE TABLE Activités(
    ref_activité INT,
    prix INT,
    id_zone INT,
    id_type_activité INT,
    PRIMARY KEY (ref_activité),
    CONSTRAINT FK_activités_zones
    FOREIGN KEY (id_zone) REFERENCES zones(id_zone),
    CONSTRAINT FK_activités_types_activités
    FOREIGN KEY (id_type_activité) REFERENCES Types_activités(id_type_activité)
);


-- Valeur point(n° valeur, date début valeur point, date fin valeur point, prix de 1 point, #n° emplacement) --


CREATE TABLE Valeur_point(
    n_valeur INT,
    date_debut_valeur_point DATE,
    date_fin_valeur_point DATE,
    prix_de_1_point INT,
    n_emplacement INT NOT NULL,
    PRIMARY KEY (n_valeur),
    CONSTRAINT FK_valvue_emplacement
    FOREIGN KEY (n_emplacement) REFERENCES Emplacements(n_emplacement)
);


-- Facture(n° facture, date de réservation, accompte, solde) --


CREATE TABLE Facture (
    n_facture INT,
    `date de réservation` DATE,
    accompte BOOLEAN,
    solde BOOLEAN,
    PRIMARY KEY (n_facture)
);


-- Client( n client, nom, prenom, adresse, telephone, mail, contact) --


CREATE TABLE Clients(
    n_client INT,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    adresse VARCHAR(50),
    telephone VARCHAR(50),
    mail VARCHAR(50),
    contact BOOLEAN,
    PRIMARY KEY (n_client)
)

-- Fracturer(#n compteur, #n facture, compteurArrivee, compteurDepart) --

CREATE TABLE Fracturer(
    compteurArrivee INT,
    compteurDepart INT,
    n_facture INT,
    n_compteur INT,
    CONSTRAINT FK_compteur_Facture
    FOREIGN KEY (n_facture) REFERENCES Facture(n_facture),
    CONSTRAINT FK_Fracture_compteurs
    FOREIGN KEY (n_compteur) REFERENCES compteurs(n_compteur)
);

-- ReserverEmplacement ( DateDebutReservation, DateFinReservation, #n emplacement, # n client, #n facteur) --

CREATE TABLE ReserverEmplacement(
    DateDebutReservation DATE,
    DateFinReservation DATE,
    n_emplacement INT,
    n_client INT,
    n_facture INT,
    CONSTRAINT FK_emplacements_clients
    FOREIGN KEY (n_client) REFERENCES Clients(n_client),
    CONSTRAINT FK_clients_emplacements
    FOREIGN KEY (n_emplacement) REFERENCES Emplacements(n_emplacement),
    CONSTRAINT FK_Clients_Fractuer
    FOREIGN KEY (n_facture) REFERENCES Facture(n_facture)
);


-- ReserverActivite (DateActivite, HeureDebut, HeureFin, #n client, #ref activite, #n facture) --

CREATE TABLE ReserverActivite(
    DateActivite DATE,
    HeureDebut TIME, 
    HeureFin TIME, 
    n_client INT, 
    ref_activité INT, 
    n_facture INT, 
    CONSTRAINT FK_activite_reserver
    FOREIGN KEY(n_client) REFERENCES Clients(n_client),
    CONSTRAINT FK_activite_emplacement
    FOREIGN KEY(ref_activité) REFERENCES activités(ref_activité),
    CONSTRAINT FK_activite_facture 
    FOREIGN KEY(n_facture) REFERENCES Facture(n_facture)
);



CREATE DATABASE Entreprise


CREATE TABLE Entreprise(
    id_ent INT NOT NULL,
    nom_ent INT,
    secti_ent VARCHAR(50),
    liste_ent INT,
    CA_ent INT,
    PRIMARY KEY (id_ent)

);

CREATE TABLE Produit(
    id_pro INT NOT NULL,
    nom_pro INT,
    cat_pro VARCHAR(50),
    qua_pro INT,
    prix_pro INT,
    PRIMARY KEY (id_pro)
);

CREATE TABLE Clients(
    id_client INT NOT NULL,
    np_client VARCHAR(50),
    adresse_client VARCHAR(50),
    pai_client INT,
    PRIMARY KEY (id_client)
);

CREATE TABLE FaireAvis(
    avis_FA INT,
    id_client INT,
    id_pro INT,
    CONSTRAINT FK_FA_client
    FOREIGN KEY(id_client) REFERENCES Clients(id_client),
    CONSTRAINT FK_FA_pro
    FOREIGN KEY(id_pro) REFERENCES Produit(id_pro)
)