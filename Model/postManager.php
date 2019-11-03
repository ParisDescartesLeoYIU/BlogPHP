<?php

include_once('connect.php');



function getPosts() {
    $db = dbConnect();

    $posts = $db->query('SELECT posts.id AS id, title, content, username, name, imagePath
                        FROM posts
                        INNER JOIN categories
                        ON categories.id = posts.idCategory
                        INNER JOIN users
                        ON users.id = posts.idUser
                        ORDER BY posts.id DESC 
                        LIMIT 10');

    return $posts;
}


function getTestCategory() {
    $db = dbConnect();
    $categories = $db->query('SELECT * FROM categories LIMIT 1');
    $testCategorie = $categories->fetch();
    return $testCategorie;
}



function getPost($idPost) {
    $db = dbConnect();
    $req = $db->prepare('SELECT posts.id, title, content, username, name, imagePath
                        FROM posts
                        INNER JOIN categories
                        ON categories.id = posts.idCategory
                        INNER JOIN users
                        ON users.id = posts.idUser
                        WHERE posts.id = ?');
    $req->execute(array($idPost));
    $post = $req->fetch();

    return $post;

}


function getAllPosts() {
    $db = dbConnect();
    $posts = $db->query('SELECT posts.id AS id, title, content, username, name, imagePath
                        FROM posts
                        INNER JOIN categories
                        ON categories.id = posts.idCategory
                        INNER JOIN users
                        ON users.id = posts.idUser');
    return $posts;
}


function newPost($title, $content, $imagePath, $idUser, $idCategory) {
    $db = dbConnect();
    $post = $db->prepare('INSERT INTO posts(title, content, imagePath, idUser, idCategory) VALUES(?, ?, ?, ?, ?)');
    $newPost = $post->execute(array($title,  $content, $imagePath, $idUser, $idCategory));
    return $newPost;
}

function getCategories() {
    $db = dbConnect();
    $categories = $db->query('SELECT * FROM categories');
    return $categories;
}

function getComments($idPost){
    $db = dbConnect();
    $comments = $db->prepare('SELECT autheur, comments.content,comments.id AS "commentid" ,posts.id AS "postid"
                                        FROM posts, comments, users 
                                        WHERE posts.id = comments.idPost 
                                        AND posts.idUser = users.id 
                                        AND posts.id = ?');
    $comments->execute(array($idPost));

    return $comments;
}

function deletePost($idPost){

    $db = dbConnect();
    $del = $db->prepare('DELETE FROM posts WHERE posts.id=?');
    $del->execute(array($idPost));
    return $del;
}

function getPostidFromComment($idComment) {

    $db = dbConnect();
    $req = $db->prepare('SELECT idPost FROM comments WHERE id =?');
    $req->execute(array($idComment));
    $Id = $req->fetch();
    return $Id;

}

function deleteComment($idComment){
    $idPost = getPostidFromComment($idComment);
    $db = dbConnect();
    $del = $db->prepare('DELETE FROM comments  WHERE comments.id=? ');
    $del->execute(array($idComment));
    return $idPost['idPost'];
}