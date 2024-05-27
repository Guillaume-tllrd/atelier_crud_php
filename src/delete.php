<?php
// On va d'abord vérifier si l'utilisateur existe avant de vouloir essayer de le supprimer. Ainsi on garde la même requête de users pour savoir si l'utilisateur existe:

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
    } else {
        // Sinon on gère la suppression de l'utilisateur
        $sql = "DELETE FROM users WHERE id =:id";
        
        $query = $db->prepare($sql); // on prépare la requête, on demande la $db mais il faut la connecter avec require
// on accroche la valeur id de la requête à celle de la variable $id
$query->bindValue(":id", $id, PDO::PARAM_INT);
$query->execute();
header("Location: index.php");

    }
// print_r($user)
} else {
    header("Location: index.php");
}
?>