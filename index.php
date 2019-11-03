<?php
session_start();
require('controlleur.php');
// Routeur

if (isset($_GET['action'])){

    switch ($_GET['action']) {

        case 'showPosts':
            showPosts();
            break;

        case 'accueil':

            accueil();
            break;


        case 'showPost':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                showPost();
            }
            else {
                echo '0 article dans la base de données';
            }
            break;



        case 'addCategory':
            if(!empty($_POST['name'])){
                addCategory($_POST['name']);
            }
            else {
                echo 'Veuillez mettre un nom pour la categorie';
            }

            break;


        case 'addPost':

            if (!empty($_SESSION['username']) && !empty($_POST['content'])&& !empty($_POST['title']&& !empty($_POST['category']))){
                $imgUrl = getImgUrl();

                addPost($_POST['title'],  $_POST['content'],  $imgUrl, $_SESSION['id'], $_POST['category']);
            }
            else {

                echo 'Veuillez mettre un titre, une categorie, et du contenue';
            }
            break;

        case 'addComment':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['content'])) {
                    addComment($_GET['id'], $_SESSION['username'],$_POST['content']);
                }
                else {
                    echo 'Veuillez ecrire un commentaire !';
                }
            }
            else {
                echo 'Impossible de mettre un commentaire';
            }
            break;

        case 'showCategory':

            $categories = getCategories();
            require('view/categoryView.php');
            break;

        case 'showLogin' :
            require('view/loginView.php');
            break;

        case 'showPosting':


           $categories = getCategories();
           $testCategory= getTestCategory();
            if ($testCategory=== false){
                echo "Attention Aucune categorie existante, Veuillez Creer une categorie";
                break;
            }
            else{
           require('view/postingView.php');
            break;
            }

        case 'disconnectUser':
            session_destroy();
            header('Location: index.php?action=accueil');
            break;

        case 'newUser':
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                newUser($_POST['username'], $_POST['password']);
            }
            break;

        case 'verifyUser':

            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                verifyUser($_POST['username'], $_POST['password']);
            }
            break;

        case 'delete':
            delete();
            break;


        case 'deleteComment':
            deleteCommentaire();
            break;

        case 'deleteCategorie':
            deleteCategorie();
            break;

        default:
            echo "erreur cette page n'existe pas" ;
            break;
    }
}

//Retour a la page d'accueil
else {
    accueil();

}

