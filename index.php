<?php
require('model/postManager.php');
session_start();


if (isset($_GET['action'])){

    switch ($_GET['action']) {


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
                 var_dump($_POST['name']);
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
                    addComment($_GET['id'], $_POST['content']);
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
            require('view/categoryView.php');
            break;

        case 'showLogin' :
            require('view/loginView.php');
            break;

        case 'showPosting':
            $categories = getCategories();
            require('view/postingView.php');
            break;

        case 'disconnectUser':
            session_destroy();
            header('Location: index.php?action=showPosts');
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

        default:
            showPosts();
            break;
    }
}
else {
    showPosts();

}

function showPosts() {
    $posts = getPosts();
    require('view/indexView.php');
}

function showPost() {
    $post = getPost($_GET['id']);
    $comments = getComments($_GET['id']);
    require('view/postView.php');
}

function addCategory($name) {

    require('model/categoryManager.php');
    $newCategory = postCategory($name);
    if ($newCategory === false) {
        die('Ajout impossible de categorie');
    }
    else {
        header('Location: index.php?action=showPosts');
    }

}

function addPost($title,  $content, $imagePath, $idUser ,$idCategory) {
    $newPost = newPost($title,  $content, $imagePath, $idUser, $idCategory);
    if ($newPost == false) {
        die('Impossible de poster');
    }
    else {
        header('Location: index.php?action=showPosts');
    }
}

function addComment($idPost, $content) {
    require('model/commentsManager.php');
    $newComment = postComment($idPost, $content);
    if ($newComment === false) {
        die('Impossible de mettre un commentaire');
    }
    else {
        header('Location: index.php?action=showPost&id=' . $idPost);
    }
}
function newUser($username, $password) {
    require('model/userManager.php');
    $hashpassword = password_hash($password, PASSWORD_DEFAULT);
     addUser($username, $hashpassword);

    header('Location: index.php?action=showLogin');

}

function verifyUser($username, $password) {

    require('model/userManager.php');
    $result = logUser($username);
    $correctPassword = (password_verify($password, $result['password']));
    if($correctPassword) {
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $result['id'];
        header('Location: index.php?action=showPosts');
    }
    elseif(!$correctPassword) {
        echo 'Vous vous etes tromper de Mot de passe';

    }
}

function disconnectUser() {
    session_destroy();
    header('Location: index.php?action=showPosts');
}

function getImgUrl()
{
    $target_dir = "./image/";
    $target_file = $target_dir . basename($_FILES['imagePath']['name']);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if($imageFileType == "jpg" OR $imageFileType == "png" OR $imageFileType == "jpeg"
        OR $imageFileType == "gif" ){
        move_uploaded_file($_FILES['imagePath']['tmp_name'], $target_file);
    }
    else {
        echo "vous n'avez pas mis d'image";
    }
    return $target_file;
}
