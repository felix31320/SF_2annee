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