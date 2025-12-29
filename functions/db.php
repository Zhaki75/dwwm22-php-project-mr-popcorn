<?php

    /**
     * Cette fonction permet d'établir une connexion avec la base de données.
     *
     * @return PDO
     */
    function connectToDb(): PDO {
        // Je vais te donner l’accès à la base.

        $dsnDb = 'mysql:dbname=mr-popcorn;host=127.0.0.1;port=3306';
        // où est la base (nom + adresse)
        $userDb = 'root';
        // qui se connecte
        $passwordDb = '';
        // avec quel mot de passe

        // Ce bloc n’a rien à voir avec les films, ni le projet. C’est juste l’adresse de la base.

        try {
            $db = new PDO($dsnDb, $userDb, $passwordDb);
            // J’essaie de me connecter à la base, Si ça marche, je crée $db

            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Si une erreur arrive, je veux une vraie erreur claire.

        } catch (\PDOException $exception) {
            die("Connection to database failed: " . $exception->getMessage());
            // Si la connexion échoue, j’arrête tout et j’affiche le problème.
        }

        return $db;
        // Je donne la connexion aux autres fonctions
    }


    /**
     * Cette fonction permet d'insérer un nouveau film en base de données.
     *
     * @param null|float $ratingRounded
     * @param array $data
     * 
     * @return void
     */
    function insertFilm(null|float $ratingRounded, array $data = []): void {

        // “Je crée une fonction insertFilm Elle reçoit : une note arrondie (ou rien) 
        // un tableau de données du formulaire Elle ne retourne rien, elle agit seulement.”


        // Etablissons une connexion à la base de données.
        $db = connectToDb();

        // Préparons la requête à executer
        try {
            $req = $db->prepare("INSERT INTO film (title, rating, comment, created_at, updated_at)
            -- Ajoute un film avec un titre, une note, un commentaire, et les dates
             VALUES (:title, :rating, :comment, now(), now() )");
            //  Les :title, :rating, :comment sont des emplacements sécurisés.
            
    
            // Passons à la requête, les données necessaires
            $req->bindValue(":title", $data['title']);
            $req->bindValue(":rating", $ratingRounded);
            $req->bindValue(":comment", $data['comment']);
    
            // Exécutons la requête
            $req->execute();
            
            // Fermons le curseur, c'est à dire la connexion à la base de données.
            $req->closeCursor();
        } catch (\PDOException $exception) {
            throw $exception;
        }
    }


    /**
     * Cette fonction permet de récupérer tous les films de la base de données.
     *
     * @return array
     */
    function getFilms(): array {
        // Je crée une fonction qui s’appelle getFilms et elle va renvoyer une liste (un tableau).
        $db = connectToDb();
        // Avant de récupérer les films, je dois me connecter à la base de données.


        // Aller chercher les films dans la base et les renvoyer à index.php
        try {
            $req = $db->prepare("SELECT * FROM film ORDER BY created_at DESC");
            // Je prépare une question SQL à la base.  Question : prends tous les films du plus récent au plus ancien.

            $req->execute();
            // Ok, maintenant pose la question à la base.

            $films = $req->fetchAll();
            // Prends tous les résultats et mets-les dans $films.
            // $films = tableau de films (ce que index.php voulait depuis le début).

            $req->closeCursor(); // Non obligatoire. Je ferme proprement la requête.

        } catch (\PDOException $exception) {           
            throw $exception;
            // S’il y a un problème, je laisse l’erreur remonter.
        }

        return $films;
        // Je rends les films à index.php.”
    }


    /**
     * Cette fonction permet de récupérer un film en fonction de l'identifiant renseigné.
     *
     * @param integer $filmId
     * 
     * @return false|array
     */
    function getFilm(int $filmId): false|array {
        $db = connectToDb();

        try {
            $req = $db->prepare("SELECT * FROM film WHERE id=:id");
            $req->bindValue(":id", $filmId);

            $req->execute();
            $film = $req->fetch();
            $req->closeCursor();
        } catch (\PDOException $exception) {
            throw $exception;
        }

        return $film;
    }


    /**
     * Cette fonction permet de mettre à jour un film dans la base de données.
     *
     * @param null|float $ratingRounded
     * @param integer $filmId
     * @param array $data
     * 
     * @return void
     */
    function updateFilm(null|float $ratingRounded, int $filmId, array $data = []): void {
        $db = connectToDb();

        try {
            $req = $db->prepare("UPDATE film SET title=:title, rating=:rating, comment=:comment, updated_at=now() WHERE id=:id");
    
            $req->bindValue(":title", $data['title']);
            $req->bindValue(":rating", $ratingRounded);
            $req->bindValue(":comment", $data['comment']);
            $req->bindValue(":id", $filmId);
    
            $req->execute();
            $req->closeCursor();
        } catch (\PDOException $exception) {
            throw $exception;
        }
    }


    /**
     * Cette fonction permet de supprimer le film dans la base de données.
     *
     * @param integer $filmId
     * 
     * @return void
     */
    function deleteFilm(int $filmId): void {
        $db = connectToDb();

        try {
            $req = $db->prepare("DELETE FROM film WHERE id=:id");
            $req->bindValue(":id", $filmId);
            $req->execute();
            $req->closeCursor();
        } catch (\PDOException $exception) {
            throw $exception;
        }
    }