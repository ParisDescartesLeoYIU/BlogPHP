
// Vue pour la page de connexion

<p><a href="index.php">Accueil</a></p>
<h1>Connexion</h1>
<form method="POST" action="index.php?action=verifyUser">
    <input type='text' id='username' name='username' placeholder='Login'>
    <input type='password' id='password' name='password' placeholder='Mot de passe'>
    <input type='submit'>
</form>

<h1>Inscription</h1>
<form method="POST" action="index.php?action=newUser">
    <input type='text' id='username' name='username' placeholder='Login'>
    <input type='password' id='password' name='password' placeholder='Mot de passe'>
    <input type='submit'>
</form>

<?php
$content = ob_get_clean();
require('home.php')
?>