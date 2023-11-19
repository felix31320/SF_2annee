<?php

    require('include/bdd.php');
    session_start();

    if (isset($_SESSION['connect'])) {
        header('Location: index.php');
    }


    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        
        // VARIABLES

        $email = $_POST['email'];
        $password = $_POST['password'];

        // CRYPTAGE DE MOT DE PASSE
        $password = 'SF'.sha1($password.'2020').'2021';

        //VERIFIE SI EMAIL EMAIL + CODE BON
        $req = $bdd->prepare('SELECT * FROM spa_users WHERE email = ?');
        $req->execute(array($email));

        while ($user = $req->fetch()) {
            
            if ($password == $user['code']) {

                $_SESSION['connect'] = 1;
                $_SESSION['pseudo'] = $user['pseudo'];


                header('Location: index.php');
                exit();
            }else {
                header('Location: connexion.php?error=1');
                exit();
            }
        }
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPA - CONNEXION</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php 
        require('include/header.php'); 
    ?>

<div class="form">
    <form action="connexion.php" method="post">

        <h1>CONNEXION</h1>

        <?php

        // AFFICHER LES ERREURS
        if (isset($_GET['error'])) {
            
            echo '<p id="error">Votre email ou mot de passe pas bon</p>';
            
        }

        if (isset($_GET['success'])) {
            echo '<p id="succes">Votre connexion est reussi</p>';
        }

        ?>

        <label for="email">Adresse e-mail :</label>
        <input class="input" type="email" id="email" name="email" required>

        <label for="password">Mot de passe:</label>
        <input class="input" type="password" id="password" name="password" required>


        <button class="button_inscription" type="submit" name="bouton">S'inscrire</button>
        

        
    </form>
        Première visite ? <a href="inscription.php">Inscrivez-vous</a>
</div>
<?php require('include/footer.php'); ?>

</body>
</html>