<?php


include_once('connect.php');


function postCategory($name)
{
    $db = dbConnect();
    $categories = $db->prepare('INSERT INTO categories(name) VALUES(?)');
    $newCategorie = $categories->execute(array($name));

    return $newCategorie;
}

