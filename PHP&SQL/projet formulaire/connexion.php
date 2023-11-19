<?php


    
    require('include/bdd.php');
    session_start();
    if (isset($_SESSION['connect'])) {
        header('Location: index.php');
    }

    

    if (!empty($_POST['email']) && !empty($_POST['mdp'])) {
        
        // VARIABLES

        $email = $_POST['email'];
        $mdp = $_POST['mdp'];

        // CRYPTAGE DE MOT DE PASSE
        $mdp = 'SF'.sha1($mdp.'2020').'2021';

        //VERIFIE SI EMAIL EMAIL + CODE BON
        $req = $bdd->prepare('SELECT * FROM users WHERE email = ?');
        $req->execute(array($email));

        while ($user = $req->fetch()) {
            if ($mdp == $user['password']) {
                $_SESSION['connect'] = 1;
                $_SESSION['pseudo'] = $user['pseudo'];

                if (isset($_POST['connection'])) {
                    setcookie('log',$user['secret'],time()+365*24*3600,'/',null,false,true);
                }

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
    <title>Connexion</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>SE CONNECTER</h1>
    </header>

    <div class="container">
    
        <p id="info">Connectez vous, <a href="index.php">Vous n'etes pas encore inscrit</a></p>

        <?php

        // AFFICHER LES ERREURS
        if (isset($_GET['error'])) {
            
            echo '<p id="error">Votre email ou mot de passe pas bon</p>';
            
        }

        if (isset($_GET['success'])) {
            echo '<p id="succes">Votre connexion est reussi</p>';
        }

        ?>

        <div id="form">

            <form action="" method="post">
                <table>
                    <tr>
                        <td>Email :</td>
                        <td><input type="email" name="email" id="" placeholder="Ex : Felix" required></td>
                    </tr>
                    <tr>
                        <td>Mot de passe :</td>
                        <td><input type="password" name="mdp" id="" placeholder="***" required></td>
                    </tr>
                    
                </table>  
                <p><label for=""><input type="checkbox" name="connection" id="">Connection Automatique</label></p> 
                <div class="button">
                    <input type="submit" name="bouton" id="button" value="Se Connecter">
                </div>    
                
            


            </form>
        </div>
    </div> 
</body>
</html>