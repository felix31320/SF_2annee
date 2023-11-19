
<?php

    session_start();
    // session_destroy();

    if (!empty($_POST['pseudo'])) {

        $pseudo = $_POST['pseudo'];

        $_SESSION['pseudo'] =$pseudo;
    }

    // if (!empty($_POST['pseudo'])) {

    //     $pseudo = $_POST['pseudo'];

    //     setcookie('pseudo',$pseudo,time() + 365*24*3600,null,null,false,true);
    // }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ajouter un nouveau Utilisateur</h1>

    <form action="cookies.php" method="post">

        <label>Pseudo : <input type="text" name="pseudo" id=""></label><br>
        
        <input type="submit" name="bouton" value="Envoyer">

        <?php

        // if (!empty($_COOKIE['pseudo'])) {
            
        //     echo '<h2>Bienvenue '.$_COOKIE['pseudo'].'</h2>';
        // }

        if (!empty($_SESSION['pseudo'])) {
            
            echo '<h2>Bienvenue '.$_SESSION['pseudo'].'</h2>';
        }

        ?>

    </form>
</body>
</html>