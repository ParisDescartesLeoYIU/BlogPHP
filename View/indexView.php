<?php

while ($donnees = $posts->fetch())
{
    ?>
    <div class="news">
        <br>
        <h2>
            <?php echo $donnees['title']; ?> par <?php echo $donnees['username']; ?>
        </h2>

        <p>
            Catégorie : <?php echo $donnees['name']; ?>
            <em><a href="index.php?action=showPost&amp;id=<?= $donnees['id'] ?>">Voir plus</a></em>
            <br>
        </>
    </div>
    <?php
}
$posts->closeCursor();
$content = ob_get_clean();
?>

<?php require('home.php') ?>