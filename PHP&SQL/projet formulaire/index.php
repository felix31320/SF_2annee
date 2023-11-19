<?php

    session_start();

    require('include/bdd.php');

    //VERIFIE SI CHAMPS PAS VIDES

    if (!empty($_POST['pseudo']) && !empty($_POST['mail']) && !empty($_POST['mdp']) && !empty($_POST['mdpc'])) {
        
        // VARIABLE
        $pseudo = $_POST['pseudo'];
        $mail = $_POST['mail'];
        $mdp = $_POST['mdp'];
        $mdpc = $_POST['mdpc'];

        // VERIFIE SI MOT DE PASSR IDENTIQUES
        if ($mdp != $mdpc) {
            header('Location: ?error=1&mdp=1');
            exit();
        }

        //VERIFIE SI EMAIL DEJA UTILISE

        $req = $bdd->prepare('SELECT count(*) as NumberEmail FROM users WHERE email = ?');
        $req->execute(array($mail));

        while ($email_verification = $req->fetch()) {
            if ($email_verification['NumberEmail'] != 0) {
                header('Location: ?error=1&email=1');
                exit();
            }
        }

        //HASH
        $secret = sha1($mail).time();
        $secret = sha1($secret).time().time();

        // CRYPTAGE DE MOT DE PASSE
        $mdp = 'SF'.sha1($mdp.'2020').'2021';

        //ENVOI DE LA REQUETE

        $req = $bdd->prepare('INSERT INTO users (pseudo,email,password,secret) VALUES (?, ?, ?, ?)');
        $req->execute(array($pseudo,$mail,$mdp,$secret));
        header('Location: index.php?success=1');
        exit();

    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>INSCRIPTION</h1>
    </header>
    
    <div class="container">


        <?php if (!isset($_SESSION['connect'])) { ?>

        
        <p id="info">Bienvenue sur mon site, pour en voir plus, inscrivez-vous. Sinon <a href="connexion.php">Connectez-vous</a></p>

        <?php

        // AFFICHER LES ERREURS
        if (isset($_GET['error'])) {
            if (isset($_GET['mdp'])) {
                echo '<p id="error">Les mots de passes ne sont pas identiques.</p>';
            }elseif (isset($_GET['email'])) {
                echo '<p id="error">L\'adresse mail est deja prise.</p>';
            }
        }

        if (isset($_GET['success'])) {
            echo '<p id="succes">Votre inscription prise en compte</p>';
        }

        ?>

        <div id="form">
            <form action="" method="post">
                <table>
                    <tr>
                        <td>Pseudo :</td>
                        <td><input type="text" name="pseudo" id="" placeholder="Ex : Felix" required></td>
                    </tr>
                    <tr>
                        <td>Adresse Mail :</td>
                        <td><input type="email" name="mail" id="" placeholder="exmple@gmail.com" required></td>
                    </tr>
                    <tr>
                        <td>Mot de passe :</td>
                        <td><input type="password" name="mdp" id="" placeholder="***" required></td>
                    </tr>
                    <tr>
                        <td>Confirmation de Mot de passe :</td>
                        <td><input type="password" name="mdpc" id="" placeholder="***" required></td>
                    </tr>

                </table>
                <div class="button">
                    <input type="submit" name="bouton" id="button" value="Inscription">
                </div>    
                



            </form>
        </div>
    
        <?php }else{ ?>

        <p id="info" >Bonjour <?php echo $_SESSION['pseudo'] ?><br><a href="include/deconnexion.php">Deconnexion</a></p>
        
        
        <?php } ?>

        


    </div>







    
</body>
</html>