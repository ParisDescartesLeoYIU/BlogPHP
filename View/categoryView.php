

// Vu de la page des Catégories


<p><a href="index.php">Retour à la page d'accueil </a></p>
<h2>Ajouter une nouvelle Categorie</h2>

<form method="POST" action="index.php?action=addCategory" >
    <input type='text' id='name' name='name' placeholder='nom'>
    <input type='submit'>
</form>


<h3>Les categories existantes sont : </h3>

<?php
foreach($categories as $category) {
?>
   <li> <?php echo $category['name'] ;?></li>

<?php

}

$content = ob_get_clean();
require('home.php') ?>