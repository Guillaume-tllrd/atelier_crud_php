<?php
if (isset($_GET["id"])&& !empty($_GET["id"])){
    // déja ça va vérifier si la var est défini avec isset et ensuite si il y a l'id dqns l'url


require_once("connect.php"); // ne pas oublier de connecter avec require_once
// echo $_GET["id"];
$id = strip_tags($_GET["id"]);

$sql = "SELECT * FROM users WHERE id = :id";
$query = $db->prepare($sql); // on prépare la requête, on demande la $db mais il faut la connecter avec require
// on accroche la valeur id de la requête à celle de la variable $id
$query->bindValue(":id", $id, PDO::PARAM_INT);
$query->execute();

$user = $query->fetch();

// on vérifie si l'utilisateur existe dans l'url
    if(!$user){ // si on n'a pas d'utilisateur on redirige vers l'index.php
        header("Location: index.php");
    }else{
        require_once("disconnect.php"); // on se déconnecte si il n'y a pas du'tilisateurs
    }
// print_r($user)
} else {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de <?= $user["first_name"] . " " . $user["last_name"] ?></title>
</head>
<body>
    <h1><?= $user["first_name"] . " " . $user["last_name"] ?></h1>
</body>
</html>