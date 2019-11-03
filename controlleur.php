<?php

require('model/postManager.php');
//Fonction du Controlleur


function showPosts() {
    $posts = getAllPosts();
    require('view/allPostView.php');
}


function accueil() {
    $posts = getPosts();
    require('view/accueilView.php');
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
        header('Location: index.php?action=accueil');
    }

}

function addPost($title,  $content, $imagePath, $idUser ,$idCategory) {
    $newPost = newPost($title,  $content, $imagePath, $idUser, $idCategory);
    if ($newPost == false) {
        die('Impossible de poster');
    }
    else {
        header('Location: index.php?action=accueil');
    }
}

function addComment($idPost, $autheur, $content) {
    require('model/commentsManager.php');
    $newComment = postComment($idPost, $autheur, $content);
    if ($newComment === false) {
        die('Impossible de mettre un commentaire');
    }
    else {
        header('Location: index.php?action=showPost&id=' . $idPost);
    }
}


// delete un message
function delete() {

    $delete = deletePost($_GET['id']);
    header('Location: index.php?action=accueil');
}

function deleteCommentaire() {
    $postid = deleteComment($_GET['id']);

    header('Location: index.php?action=showPost&id='.$postid);
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
        header('Location: index.php?action=accueil');
    }
    elseif(!$correctPassword) {
        echo 'Vous vous etes tromper de Mot de passe';

    }
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
