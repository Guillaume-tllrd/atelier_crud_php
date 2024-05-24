<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Ajouter un utilisateur</h1>
    <form action="create.php" method="post"> 
        <label for="first_name">Prénom</label>
        <input type="text" name="first_name" required>
        <label for="last_name">Nom</label>
        <input type="text" name="last_name" required> 
        <!-- required permet de sécurisé en front end mais il faut aussi sécurisé en backend avec une conditionn if else  -->
        <button>Ajouter</button>
    </form>
    <a href="index.php">Retour</a>
    <?php print_r($_POST);?> 
    <!-- la variable superglobal _POST permet de récupérer la valeur du formulaire -->
</body>
</html>