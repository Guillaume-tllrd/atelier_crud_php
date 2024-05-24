<?php

if(
    isset($_POST["first_name"]) && !empty($_POST["first_name"])
    && isset($_POST["last_name"]) && !empty($_POST["last_name"]) // la fonction isset est pour savoir si c'est bien défini/déclaré
){


require_once("connect.php");
$first_name = strip_tags($_POST["first_name"]);
$last_name = strip_tags($_POST["last_name"]); // le strip_tags permet d'enlever les caractères bizarres

$sql = "INSERT INTO users (first_name, last_name) VALUES (:first_name, :last_name)" ;

$query = $db->prepare($sql);
$query->bindValue(":first_name", $first_name);
$query->bindValue(":last_name", $last_name); // permet d'associer la valeur de la variable à la variable
$query->execute();
header("Location: index.php"); // après la validation du form on seredirige vers l'index
} else {
    echo "Veuillez remplir le formulaire svp!!!!";
}