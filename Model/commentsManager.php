<?php

include_once('dbManager.php');


function postComment($idPost, $content)
{
    $db = dbConnect();
    $comments = $db->prepare('INSERT INTO comments(idPost,content) VALUES(?, ?)');
    $newComment = $comments->execute(array($idPost,  $content));

    return $newComment;
}

