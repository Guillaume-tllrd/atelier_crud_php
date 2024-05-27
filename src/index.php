<?php
session_start();
require_once("connect.php");
// require veut dire qu'il est requis/obligatoire pour notre dossier, come on en a besoin plusieur fois on le fait dans une autre page et on va utiliser require_once
$sql = "SELECT * FROM users";


// On prépare la requête 
$query = $db->prepare($sql);
// On exécute  la requête
$query->execute();
// on récupère les données sous forme de tableau associatif
$users = $query-> fetchAll(PDO::FETCH_ASSOC); // fonction prédéfini pour mieux afficher le tableau
// echo "<pre>";
// print_r($users);
// echo "</pre>";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atelier CRUD</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
</head>
<body>
  <h1>Liste des utilisateurs</h1>  
  <?php
  if(!empty($_SESSION["message"])){// si le message n'est pas vide
    echo"<p>" . $_SESSION["message"] . "</p>";
    $_SESSION["message"] = ""; // on vide le message pour ne pas l'avoir tt le temps
  }
  ?>
  <table>
    <thead>
        <td>id</td>
        <td>Prénom</td>
        <td>Nom</td>
        <td>ACTIONS</td>
    </thead>
    <tbody>
     
        <?php

        foreach($users as $user){
        ?>
            <tr>
                <td><?= $user['id'] ?></td> 
                <!-- le< ? sert à remplacer ?PHP -->
                <td><?= $user["first_name"] ?></td>
                <td><?= $user["last_name"] ?></td>
                <td>
                    <a href="user.php?id=<?= $user['id'] ?>"><i class="fa-solid fa-eye"></i></a> 
                    <!-- on construit un lien dynamique avec la balise php, ce qui permet d'incrémenter avec les id  --> 
                    <a href="update.php?id=<?= $user['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a> 
                    <a href="delete.php?id=<?= $user['id'] ?>"><i class="fa-solid fa-trash-can"></i></a>
                </td>
            </tr>
        <?php
        }
        ?>
        <a href="form.php">Ajouter un nouvel utilisateur</a>
    </tbody>
  </table>
</body>
</html>