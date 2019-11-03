

// Vue pour le poste d'article

<p><a href="index.php">Retour à la page d'accueil </a></p>

<h2>Ecrire un nouveau post</h2>

<form method="POST" action="index.php?action=addPost" enctype="multipart/form-data">


        <input type='text' id='title' name='title' placeholder='Titre'>
        <input type='text' id='content' name='content' placeholder='Contenu'>

        <select name="category" id="category">
            <?php

                foreach($categories as $category) {
            ?>
                <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
            <?php
             }
             ?>
        </select>
        <div>
            <label class="custom-file-label" for="imagePath">Selectionnez une image</label>
            <input type="file" class="custom-file-input" id="imagePath" name="imagePath">
        </div>
                <input type='submit'>
            </form>



    <?php

$content = ob_get_clean();
require('home.php') ?>