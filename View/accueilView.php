
// Vue de la Page d'accueil

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
            <em><a href="index.php?action=showPost&amp;id=<?php echo $donnees['id'] ?> " ><br>Voir plus</a></em>
            <br>
        </>
    </div>

    <?php
}
$posts->closeCursor();
?>
<em><a href="index.php?action=showPosts">Afficher tous les articles</a></em>
<?php


$content = ob_get_clean();
require('home.php')
?>



