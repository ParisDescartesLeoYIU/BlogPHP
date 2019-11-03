
<p><a href="index.php">Retour à la page d'accueil </a></p>
<h2>Ajouter une nouvelle Categorie</h2>

<form method="POST" action="index.php?action=addCategory" >
    <input type='text' id='name' name='name' placeholder='nom'>
    <input type='submit'>
</form>

<?php
$content = ob_get_clean();
?>

<?php require('home.php') ?>