<?php

$connexion = mysqli_connect("localhost","loossimon","","");
if($connexion->connect_error){
    die("Connection Failed!".$connexion->connect_error);
}

?>