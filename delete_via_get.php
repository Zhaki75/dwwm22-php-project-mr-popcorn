<?php

session_start();

    require_once __DIR__ . "/../functions/db.php";

    // 1. Si l'idenfiant du film à modifier n'existe pas,
    if ( !isset($_GET['film_id']) || empty($_GET['film_id']) ) {
        // Alors, rediriger l'utilisateur vers la page d'accueil,
        // Puis arrêter l'exécution du script.
        header("Location: index.php");
        die();
    }

    // 2. Dans le cas contraire,
    // Récupérer l'identifiant en protégeant le système contre les failles de types XSS
    // Convertir l'identifiant en entier
    $filmId = (int) htmlspecialchars($_GET['film_id']);

    // 3. Etablir une connexion avec la base de données
    // Tenter de récupérer le film
    $film = getFilm($filmId);

    // 4. Si le film n'est pas trouvé,
    if ( false === $film ) {
        // Alors, rediriger l'utilisateur vers la page d'accueil,
        // Puis arrêter l'exécution du script.
        header("Location: index.php");
        die();
    }

    // 5. Dans le cas contraire,
    // Effectuer a requête de suppression
    deleteFilm((int) $film['id']);

    // 6. Génerer le message flash de succés
    $_SESSION['success'] = "Le film a été retiré de la liste.";

    // 7. Rediriger vers la page d'acceuil puis arrêter l'execution du script.
    header("Location: index.php");
    die();
    //
    
