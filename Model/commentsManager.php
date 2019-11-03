<?php

include_once('connect.php');

function postComment($idPost, $autheur , $content)
{
    $db = dbConnect();
    $comments = $db->prepare('INSERT INTO comments(idPost,autheur,content) VALUES(?, ?, ?)');
    $newComment = $comments->execute(array($idPost, $autheur, $content));

    return $newComment;
}