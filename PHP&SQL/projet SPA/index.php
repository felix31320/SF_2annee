<?php
    require('include/bdd.php');

    session_start();


    // afficher tous les animaux
    $req = $bdd->prepare('SELECT *, DATE_FORMAT(date_add, "%d/%m/%Y") AS date_test FROM spa_animal ORDER BY date_add DESC');
    $req->execute(array());
    


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACCUEIL</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        require('include/header.php');
    ?>

    <?php if (!isset($_SESSION['connect'])) { ?>

        <section>
            <div>
                <h1>Bienvenu sur l'espace de l'association SPA</h1>
                <h3>Donnez deuxième chance aux animaux</h3>
            </div>
        </section>

    <?php }else{ ?>

        <p id="info" >Couou Collège <?php echo $_SESSION['pseudo'] ?> !</p>
        <p id="petitinfo">Liste des nos animaux au spa</p>


        <?php

        // afficher tous les animaux
        while ($profilAnimal = $req->fetch()) {
        ?>

            <div class="containerTable">
                <div class="table">
                    <img src="images/<?php echo $profilAnimal['image']; ?>" alt="">
                    <p>Nom : <?php echo $profilAnimal['nom']; ?></p>
                    <p>Espace : <?php echo $profilAnimal['type']; ?></p>
                    <p>Age : <?php echo $profilAnimal['age']; ?></p>
                    <p id="arriveDepuis">Arrive depuis le <?php echo $profilAnimal['date_test']; ?></p>
                </div>
            </div>
            
        
        <?php 
        } 
        ?>



  <?php  } ?>

    <?php
        require('include/footer.php');
    ?>
    
</body>
</html>