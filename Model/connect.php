<?php

function dbConnect ()
{
    try {
        $bdd = new PDO ('mysql:host=localhost;dbname=leodb;charset=utf8','root','root');
        return $bdd;
    }

    catch (PDOException $e) {
        print "Error : " . $e->getMessage();
        die();
    }
}


?>

