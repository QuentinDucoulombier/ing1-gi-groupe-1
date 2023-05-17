<?php

$connexion = mysqli_connect("localhost","loossimon","S1m0n?021308","sitedatachallenge");
if($connexion->connect_error){
    die("Connection Failed!".$connexion->connect_error);
}

?>