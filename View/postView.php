

<p><a href="index.php">Accueil</a></p>
    <h2>
        <?php
        echo $post['title'] ?>
    </h2>
    <h3>ecrit Par <?php echo  $post['username'] ?>
        dans la Categorie : <?php echo  $post['name'] ?>
    </h3>
    <p>
        <?php echo $post['content'] ?>
    </p>
    <img src="<?php echo $post['imagePath']?>" alt=" ">

<?php

if (!empty($_SESSION['username'])&&$_SESSION['username']===$post['username']) {

?>


    <form method="POST" action="index.php?action=delete&amp;id=<?php echo $post['id'] ?>">
        <input type='submit'value="Delete">
    </form>


<?php
}
?>


<h2>Commentaires</h2>

<?php
 if (!empty($_SESSION['username'])){
?>
<form method="POST" action="index.php?action=addComment&amp; id=<?php echo $post['id'] ?>">
    <input type='text' id='content' name='content' placeholder='Commentaire'>
    <input type='submit'>
</form>

<?php
 }
while ($comment = $comments->fetch())
{
    ?>
    <h3><?php echo $comment['content'];?>       </h3>

        <p><?php echo ' ecrit par '.$comment['autheur'] ?> </p>
        <?php if (!empty($_SESSION['username'])&&$_SESSION['username']===$comment['autheur']) {

        ?>




    <form method="POST" action="index.php?action=deleteComment&amp;id=<?php echo $comment['commentid'] ?>">
        <input type='submit'value="Delete Commentaire">
    </form>



    <?php
    }
}

$content = ob_get_clean();
require('home.php') ?>
