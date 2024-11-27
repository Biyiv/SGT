CREATE TABLE "Utilisateur" (
  "username" varchar PRIMARY KEY,
  "nom" varchar NOT NULL,
  "prenom" varchar NOT NULL,
  "mail" varchar NOT NULL,
  "mdp" varchar NOT NULL
);

CREATE TABLE "Tache" (
  "id" integer PRIMARY KEY,
  "titre" varchar NOT NULL,
  "description" text,
  "echeance" datetime NOT NULL,
  "priorite" varchar NOT NULL,
  "creePar" Utilisateur NOT NULL,
  "dateCreation" datetime NOT NULL
);

CREATE TABLE "Commentaire" (
  "id" integer PRIMARY KEY,
  "commentaire" text NOT NULL,
  "tache" Tache NOT NULL,
  "dateCreation" datetime DEFAULT 'CURRENT_TIMESTAMP'
);

ALTER TABLE "Commentaire" ADD FOREIGN KEY ("tache") REFERENCES "Tache" ("commentaire");

ALTER TABLE "Tache" ADD FOREIGN KEY ("creePar") REFERENCES "Utilisateur" ("username");
