<?php

    session_start();
    
    require('include/bdd.php');

    if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])) {
            
        // VARIABLE
        $pseudo = $_POST['pseudo'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // VERIFIE SI MOT DE PASSR IDENTIQUES
        if ($password != $confirm_password) {
            header('Location: ?error=1&password=1');
            exit();
        }

        //VERIFIE SI EMAIL DEJA UTILISE

        $req = $bdd->prepare('SELECT count(*) as NumberEmail FROM spa_users WHERE email = ?');
        $req->execute(array($email));

        while ($email_verification = $req->fetch()) {
            if ($email_verification['NumberEmail'] != 0) {
                header('Location: ?error=1&email=1');
                exit();
            }
        }

        //HASH
        $secret = sha1($email).time();
        $secret = sha1($secret).time().time();

        // CRYPTAGE DE MOT DE PASSE
        $password = 'SF'.sha1($password.'2020').'2021';

        //ENVOI DE LA REQUETE

        $req = $bdd->prepare('INSERT INTO spa_users (pseudo,email,code,secret) VALUES (?, ?, ?, ?)');
        $req->execute(array($pseudo,$email,$password,$secret));
        header('Location: index.php?success=1');
        exit();

    }




?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPA - INSCRIPTION </title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php 
        require('include/header.php'); 
    ?>

<div class="form">
    <form action="inscription.php" method="post">

        <h1>INSCRIPTION</h1>

        <?php

        // AFFICHER LES ERREURS
        if (isset($_GET['error'])) {
            if (isset($_GET['password'])) {
                echo '<p id="error">Les mots de passes ne sont pas identiques.</p>';
            }elseif (isset($_GET['email'])) {
                echo '<p id="error">L\'adresse mail est deja prise.</p>';
            }
        }

        if (isset($_GET['success'])) {
            echo '<p id="succes">Votre inscription prise en compte</p>';
        }

        ?>

        <label for="pseudo">Pseudo</label>
        <input class="input" type="text" id="pseudo" name="pseudo" required>

        <label for="email">Adresse e-mail :</label>
        <input class="input" type="email" id="email" name="email" required>

        <label for="password">Mot de passe:</label>
        <input class="input" type="password" id="password" name="password" required>

        <label for="confirm_password">Retapez votre mot de passe :</label>
        <input class="input" type="password" id="confirm_password" name="confirm_password" required>

        
        <button class="button_inscription" type="submit" name="bouton">S'inscrire</button>
        

        
    </form>
    <a href="connexion.php">Déjà inscrit ?</a>
</div>
<?php require('include/footer.php'); ?>

</body>
</html>