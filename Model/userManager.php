<?php

include_once('connect.php');

function addUser($username, $password) {

    $db = dbConnect();
    $req = $db->prepare('INSERT INTO users(username, password) VALUES (?, ?)');
    $newUser =  $req->execute(array($username, $password));
    return $newUser;
}


function logUser($username) {

    $db = dbConnect();
    $req = $db->prepare('SELECT id, password FROM users WHERE username = ?');
    $req->execute(array($username));
    $resultat = $req->fetch();
    return $resultat;
}
