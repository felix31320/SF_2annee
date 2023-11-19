<?php
    session_start();
    
    require('include/bdd.php');

    
    if (!empty($_POST['nom']) && !empty($_POST['type']) && !empty($_POST['age']) && !empty($_FILES['image'])) {
        
        $nom = $_POST['nom'];
        $type = $_POST['type'];
        $age = $_POST['age'];
        $image = $_FILES['image'];
        

        // deposer un image dans un dossier images/
        if ($_FILES['image']['size'] <= 3000000) {

            $imageName = $_FILES['image']['name'];
           
            move_uploaded_file($_FILES['image']['tmp_name'], 'images/'.$imageName);

            
            $req = $bdd->prepare('INSERT INTO spa_animal (nom, type, age, image) VALUES (?, ?, ?, ?)');
            $req->execute(array($nom, $type, $age, $imageName));
            
            header('Location: ajoutanimaux.php?success=1');
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPA - AJOUT UN ANIMAL </title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php 
        require('include/header.php'); 
    ?>

<div class="form">
    <form action="ajoutanimaux.php" method="post" enctype="multipart/form-data">

        <h1>Ajout nouveau animal</h1>

        <?php

        // AFFICHER LES ERREURS
        // if (isset($_GET['error'])) {
        //     if (isset($_GET['password'])) {
        //         echo '<p id="error">Les mots de passes ne sont pas identiques.</p>';
        //     }elseif (isset($_GET['email'])) {
        //         echo '<p id="error">L\'adresse mail est deja prise.</p>';
        //     }
        // }

        if (isset($_GET['success'])) {
            echo '<p id="succes">Animal bien ajouté</p>';
        }

        ?>

        <label >Nom</label>
        <input class="input" type="text" id="nom" name="nom" required>

        <label >Type d'animal</label>
        
        <label class="container">Chat
            <input type="radio" name="type" checked value="chat">
            <span class="checkmark"></span>
        </label>
        <label class="container">Chien
            <input type="radio" name="type" value="chien">
            <span class="checkmark"></span>
        </label>
        <label class="container">Lapin
            <input type="radio" name="type" value="lapin">
            <span class="checkmark"></span>
        </label>
        <label class="container">Cheval
            <input type="radio" name="type" value="cheval">
            <span class="checkmark"></span>
        </label>
        <label class="container">Poney
            <input type="radio" name="type" value="poney">
            <span class="checkmark"></span>
        </label>
        <label class="container">Race inconnue
            <input type="radio" name="type" value="Race Inconnue">
            <span class="checkmark"></span>
        </label>

        <label for="age">Age</label>
        <input class="input" type="text" id="age" name="age" required>

        <label for="image">Inserer la photo</label>
        <input type="file" id="image" name="image" required>

        
        <button class="button_inscription" type="submit" name="bouton">Ajouter</button>
        

        
    </form>
    
</div>
<?php require('include/footer.php'); ?>

</body>
</html>