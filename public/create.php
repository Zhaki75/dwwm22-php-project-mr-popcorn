<?php
/*
*-------------------------------------------------------------
*Traitement des données provenant du formulaire
*-------------------------------------------------------------
*/

// 1. Si les données du formulaire sont envoyées via la méthode POST,

    // Alors,
// 2. Protéger le serveur contre les failles de sécurité

    // 2a. Les failles de type csrf

    // 2b. Les robots spameurs

// 3. Procéder à la validation des données du formulaire

// 4. S'il existe au moins une erreur détectée par le système,
        //Alors,

        // 4a. Sauvegarder les messages d'erreurs en session, pour affichage à l'ecran de l'utilisateur

        // 4b. Sauvergarder les anciennes données provenant du formulaire en session

        // 4c. Effectuer une redirection vers la page de laquelle proviennent les informations
        // Puis arrêter l'exécution du script.

// 5. Dans le cas contraire, 
    // 5a. Arrondir la note à un chiffre après la virgule,

// 6. Etablir une connexion avec la base de données

// 7. Effectuer la rêquete d'insertion du nouveau film dans la table prévue (file)

// 8. Générer le message flash de succés

// 9. Effectuer une redirection vers la page listant les films ajoutés (index.php)

    // Puis arrêter l'execution du script

?>

<?php

    $title = "Nouveau film";
    $description = "Ajout d'un nouveau film.";
    $keywords = "Cinéma, repertoire, film, dwwm22";

?>



<?php include_once __DIR__ . "/../partials/head.php"; ?>

    <?php include_once __DIR__ . "/../partials/nav.php"; ?>

            <!-- Main: Le contenu spécifique à cette page -->

            <main class="container">
                <h1 class="text-center my-3 display-5">Nouveau film</h1>

            <!-- Formulaire d'ajout d'un nouveau film -->
                <div class="container mt-5 ">
                    <div class="row">
                        <div class="col-md-8 col-lg-5 mx-auto p-4 bg-white shadow rounded">
                            <form action="" method="post">
                                <div class="mb-3">
                                    <label for="title">Titre <span class="text-danger">*</span></label>
                                    <input type="text" name="title" id="title" class="form-control" autofocus required>
                                </div>
                                <div class="mb-3">
                                    <label for="rating">Note / 5</label>
                                    <input type="number" min="0" max="5" step=".5" inputmode="decimal" name="title" id="rating" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="comment">Laissez un commentaire</label>
                                    <textarea type="comment" id="comment" class="form-control" rows="4"></textarea>
                                </div>
                                <div>
                                    <input type="submit" value="Ajouter" class="btn btn-primary shadow w-100">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>

    <?php include_once __DIR__ . "/../partials/footer.php"; ?>

<?php include_once __DIR__ . "/../partials/foot.php"; ?>