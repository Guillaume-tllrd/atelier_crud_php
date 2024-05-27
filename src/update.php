<?php
if($_POST){
    if
    (isset($_POST["id"]) && !empty($_POST["id"])
    && isset($_POST["first_name"]) && !empty($_POST["first_name"])
    && isset($_POST["last_name"]) && !empty($_POST["last_name"])
) {
    require_once("connect.php");

    $id = strip_tags($_POST["id"]);
    $first_name = strip_tags($_POST["first_name"]);
    $last_name = strip_tags($_POST["last_name"]);

    $sql = "UPDATE users SET first_name = :first_name, last_name = :last_name WHERE id = :id";

    $query = $db->prepare($sql);
    $query->bindValue(":id", $id, PDO::PARAM_INT); // on met pdo param int car c'est un nbre entier
    $query->bindValue(":first_name", $first_name, PDO::PARAM_STR); // str est la avaleur par défault
    $query->bindValue(":last_name", $last_name, PDO::PARAM_STR);
    $query-> execute();
    hearder("Location: index.php");
}else {
    echo "Remplissez le formulaire!";
}
}
//    On vérifie que l'i de la page existe:
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
    <title>Modifier utilisateur</title>
    
</head>
<body>
    <h1>Modifier <?= $user["first_name"] . " " . $user["last_name"] ?></h1>
    <form action="create.php" method="post"> 
        <label for="first_name">Prénom</label>
        <input type="text" name="first_name" value="<?=$user["first_name"]?>" required> 
         <!-- on récupère dynamiquement le prénom -->
        <label for="last_name">Nom</label>
        <input type="text" name="last_name" value="<?=$user["last_name"]?>" required> 
        <!-- required permet de sécurisé en front end mais il faut aussi sécurisé en backend avec une conditionn if else  -->
        <input type="hidden" name="id" value="<?=$user["id"]?>" required>
        <!-- on peut récupérer l'id en post si -->
        <button>Modifier</button>
    </form>
    <a href="index.php">Retour</a>
    <!-- <?php print_r($_POST);?>  -->
    <!-- la variable superglobal _POST permet de récupérer la valeur du formulaire -->
</body>
</html>