<?php
session_start();

    // include_once et require_once font la même chose, sauf que si le fichier n’existe pas :

    // require_once → erreur fatale, le script s’arrête

    // include_once → warning, le script continue

    require_once __DIR__ . "/../functions/db.php";
    // J’ai besoin de toutes les fonctions qui parlent à la base de données
    // “Si je n’ai pas accès à la base, je ne peux rien faire → stop si problème.”


    require_once __DIR__ . "/../functions/helpers.php";
    // J’ai besoin des petites fonctions utiles (sécurité, formatage, etc.)


    // 💡 Sans ces lignes, getFilms() n’existerait pas.

    // 1. Etablir une connexion avec la base de données
    // 2. Effectuer la requête de sélection de tous les films de la base de données

    $films = getFilms();
    // Va chercher tous les films dans la base de données, et mets-les dans la variable $films
    // ⚠️ À ce moment-là : PHP ne fait pas encore d’affichage Il prépare les données
    //  - Connexion à la base
    //  - Requête SQL
    //  - Recuperation films
    //  - Retour résultat stocker dans $films

    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>
<?php
    $title = "Liste des films";
    $description = "Découvrez la liste complète de mes films : notes, commentaires et fiches détaillées. Répertoire cinéma mis à jour régulièrement.";
    $keywords = "Cinéma, répertoire, film, dwwm22";
?>
<?php include_once __DIR__ . "/../partials/head.php"; ?>
<!-- “Si la navigation n’est pas là, ce n’est pas grave, je continue.” -->

    <?php include_once __DIR__ . "/../partials/nav.php"; ?>

        <!-- Main: Le contenu spécifique à cette page -->
        <main class="container">
            <h1 class="text-center my-3 display-5">Liste des films</h1>

            <div class="d-flex justify-content-end align-items-center my-3">
                <a href="/create.php" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i> 
                    Ajouter film
                </a>
            </div>

            <?php if(count($films) > 0) : ?>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 mx-auto">

                         <?php if(isset($_SESSION['success']) && !empty($_SESSION['success'])) : ?>  
                            <!-- Affichage du message flash -->
                            <div class="text-center alert alert-success alert-dismissible fade show" role="alert">
                                <?= $_SESSION['success']; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php unset($_SESSION['success']); ?>
                        <?php endif ?>

                            <?php foreach($films as $film) : ?>
                                <article class="film-card bg-white p-4 rounded shadow mb-4">
                                    <h2>Titre: <?= htmlspecialchars($film['title']); ?></h2>
                                    <p>Note: <?= isset($film['rating']) && $film['rating'] !== "" ? displayStars((float) htmlspecialchars($film['rating'])) : 'Non renseignée'; ?></p>
                                    <hr>
                                    <div class="d-flex justify-content-start align-items-center gap-2">
                                        <a href="show.php?film_id=<?= htmlspecialchars($film['id']); ?>" class="btn btn-sm btn-dark">Voir détails</a>
                                        <a href="edit.php?film_id=<?= htmlspecialchars($film['id']); ?>" class="btn btn-sm btn-secondary">Modifier</a>
                                        <form action="/delete.php" method="post">
                                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']); ?>">
                                            <input type="hidden" name="honey_pot" value="">
                                            <input type="hidden" name="film_id" value="<?= htmlspecialchars($film['id']); ?>">
                                            <input type="submit" class="btn btn-sm btn-danger" value="Supprimer" onclick="return confirm('Vous êtes sur de supprimer ce film')">
                                        </form>
                                    </div>
                                </article>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            <?php else :  ?>
                <p class="mt-5">Aucun film ajouté à la liste.</p>
            <?php endif ?>

            
        </main>

    <?php include_once __DIR__ . "/../partials/footer.php"; ?>

<?php include_once __DIR__ . "/../partials/foot.php"; ?>