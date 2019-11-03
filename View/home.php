
//template de la vue

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>TP PHP Blog</title>
    </head>

    <body>
    <h1> Bienvenue dans mon blog </h1>
        <?php
        if(!empty($_SESSION['username'])) {
         ?>
        <h2> Bonjour <?php echo $_SESSION['username']?></h2>
        <li><a href="index.php?action=disconnectUser">Se deconnecter</a></li>

        <?php
        }
        if(empty($_SESSION['username'])) {
        ?>
            <li><a href="index.php?action=showLogin">Connexion/Inscription</a></li>

        <?php
        }
        else {
        ?>
           <li><a href="index.php?action=showCategory"> Creer categorie</a></li>
           <li><a href="index.php?action=showPosting"> Ecrire un article </a></li>

        <?php } ?>

        <?php echo $content ?>
    </body>
</html>