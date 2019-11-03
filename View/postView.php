

<p><a href="index.php">Accueil</a></p>
    <h2>
        <?php echo $post['title'] ?> ecrit Par <?php echo  $post['username'] ?>
    </h2>
    <h3>
        Categorie : <?php echo  $post['name'] ?>
    </h3>
    <p>
        <?php echo $post['content'] ?>
    </p>
    <img src="<?php echo $post['imagePath']?>" alt=" ">


<h2>Commentaires</h2>

<form method="POST" action="index.php?action=addComment&amp;id=<?php echo $post['id'] ?>">
    <input type='text' id='content' name='content' placeholder='Commentaire'>
    <input type='submit'>
</form>

<?php
while ($comment = $comments->fetch())
{
    ?>
    <p>
        <?php echo $comment['content']. ' ecrit par ' . $comment['username'] ?>
    </p>
    <?php
}
$content = ob_get_clean();
?>

<?php require('home.php') ?>
