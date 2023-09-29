DROP TABLE IF EXISTS Equipe,Repas,Resultats,Matchs,Parcours,Tournoi,Users CASCADE;

CREATE TABLE Equipe(
                       idEquipe serial primary key,
                       nom text not null
);

CREATE TABLE Repas(
    nom varchar(50) primary key
);

CREATE TABLE Resultats(
                          idResultat serial primary key,
                          equipe_id int not null,
                          resultat_donne int not null,
                          foreign key (equipe_id) references Equipe(idEquipe)
);

CREATE TABLE Matchs(
                      idMatch serial primary key,
                      date time not null
);

CREATE TABLE Parcours(
                         idParcours serial primary key,
                         debut text not null,
                         fin text not null,
                         diffuculte int not null
);

CREATE TABLE Tournoi(
                        idTournoi serial primary key,
                        annee int not null
);

CREATE TABLE Users (
                      email text PRIMARY KEY ,
                      nom text not null,
                      prenom text not null,
                      numTel int not null,
                      password varchar not null,
                      equipe_id int,
                      repas_nom text,
                      isValidate boolean not null,
                      isAdmin boolean not null,
                      isCaptain boolean not null,
                      isOrganisateur boolean not null,
                      havePayed boolean not null,
                      nbParticipation int not null,
                      foreign key (equipe_id) references Equipe(idEquipe),
                      foreign key (repas_nom) references Repas(nom)
);

alter table Resultats add column match_id int not null references Matchs(idMatch);
alter table Matchs add column parcours_id int not null references Parcours(idParcours);
alter table Matchs add column tournoi_id int not null references Tournoi(idTournoi);
alter table Matchs add column equipeCholeId int not null references Equipe(idEquipe);
alter table Matchs add column equipeDecholeId int not null references Equipe(idEquipe);
alter table Matchs add column resultatChole int not null references Resultats(idResultat);
alter table Matchs add column resultatDechole int not null references Resultats(idResultat);