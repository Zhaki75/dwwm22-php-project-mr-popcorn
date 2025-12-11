<?php

    $title = "Liste des films";
    $description = "Découvrez les la liste complète de mes films : notes, commentaires et fiches detaillées.
    Répertoire cinéma mis à jour régulièrement.";
    $keywords = "Cinéma, repertoire, film, dwwm22";

?>

<?php include_once __DIR__ . "/../partials/head.php"; ?>

<?php include_once __DIR__ . "/../partials/nav.php"; ?>


            <!-- Main: Le contenu spécifique à cette page -->

            <main class="container">
                <h1 class="text-center my-3 display-5">Liste des films</h1>

                <div class="d-flex justify-content-end align-items-center my-3">
                    <a href="/create.php" class="btn btn-primary">
                       <i class="fa-solid fa-plus"></i> 
                        Ajouter un film
                    </a>
                </div>
            </main>

    <?php include_once __DIR__ . "/../partials/footer.php"; ?>

    <?php include_once __DIR__ . "/../partials/foot.php"; ?>