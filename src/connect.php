<?php

const DBHOST = "db"; // fait régérence à ce qu'on a écrit dans le docker-compose.yml
const DBNAME= "atelier_crud";
const DBUSER= 'test';
const DBPASS= "test";

$dsn = "mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8"; // variable pour connecter la db

try {
// ici on essaye de se connecter
$db = new PDO($dsn, DBUSER, DBPASS);// FONCTION prédéfini par PHP pour la connexion

} catch(PDOException $error) {
    echo "échec de la connexion: " . $error->getMessage() . "<br>";
}