<?php
    require('include/bdd.php');

    session_start();

    //recherche un animal
    $recherche = $_POST['recherche'];

    $reqrecherche = $bdd->prepare('SELECT *, DATE_FORMAT(date_add, "%d/%m/%Y") AS date_test FROM spa_animal WHERE id_animal = ? OR nom = ? OR type = ? OR age = ? OR DATE_FORMAT(date_add, "%d/%m/%Y") = ? ORDER BY date_add DESC');
    $reqrecherche->execute(array($recherche, $recherche, $recherche , $recherche, $recherche));

    
    // afficher tous les animaux
    $req = $bdd->prepare('SELECT *, DATE_FORMAT(date_add, "%d/%m/%Y") AS date_test FROM spa_animal ORDER BY date_add DESC');
    $req->execute(array());
    

    // cliquer supprimer
    if (isset($_POST['delete'])) {
        $delete = $_POST['delete'];

        $reqdelete = $bdd->prepare('DELETE FROM spa_animal WHERE id_animal = ?');
        $reqdelete->execute(array($delete));

        header('Location: listedesanimaux.php');
        exit();
    }
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
        

        <?php } else { ?>

            <p id="info"> Liste des animaux</p>

            <form class="formRecherche" action="" method="post">
                <input id="recherche" type="text" name="recherche" placeholder="Rechercher...">
                <input id="ok" type="submit" value="ok">
            </form>

            <?php

            //recherche un animal
            if (isset($_POST['recherche'])) {

                echo '<table id="liste">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Type d\'animal</th>
                    <th>Age</th>
                    <th>Date</th>
                    <th>Photo</th>
                    <th>Adopté</th>
                </tr>';


                while ($trouve = $reqrecherche->fetch()) {
                    
        
                    echo '
                    <tr>
                        <td>' . $trouve['id_animal'] . '</td>
                        <td>' . $trouve['nom'] . '</td>
                        <td>' . $trouve['type'] . '</td>
                        <td>' . $trouve['age'] . ' ans </td>
                        <td>' . $trouve['date_test'] . ' </td>
                        
                        <td>
                            <button id="voirButton" onclick="openPopup(\'' . $trouve['id_animal'] . '\')">Voir</button>

                            <div id="overlay' . $trouve['id_animal'] . '" class="overlay"></div>

                            <div id="popup' . $trouve['id_animal'] . '" class="popup">
                                <span class="closeBtn" onclick="closePopup(\'' . $trouve['id_animal'] . '\')">&times;</span>
                                <img class="popimage" src="images/' . $trouve['image'] . '" alt="">
                            </div>
                        </td>

                        <form method="post" action="">
                            <td>
                                <button id="deleteButton" type="submit" name="delete" value="' . $trouve['id_animal'] . '">Supprimer</button>
                            </td>
                        </form>
                        
                        ';
                }

                echo '</table>';

            }else{

                    // afficher tous les animaux
                    echo '<table id="liste">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Type d\'animal</th>
                        <th>Age</th>
                        <th>Date</th>
                        <th>Photo</th>
                        <th>Adopté</th>
                    </tr>';

                    while ($listeAnimal = $req->fetch()) {
                        echo '
                        <tr>
                            <td>' . $listeAnimal['id_animal'] . '</td>
                            <td>' . $listeAnimal['nom'] . '</td>
                            <td>' . $listeAnimal['type'] . '</td>
                            <td>' . $listeAnimal['age'] . ' ans </td>
                            <td>' . $listeAnimal['date_test'] . '</td>

                            <td>
                                <button id="voirButton" onclick="openPopup(\'' . $listeAnimal['id_animal'] . '\')">Voir</button>

                                <div id="overlay' . $listeAnimal['id_animal'] . '" class="overlay"></div>

                                <div id="popup' . $listeAnimal['id_animal'] . '" class="popup">
                                    <span class="closeBtn" onclick="closePopup(\'' . $listeAnimal['id_animal'] . '\')">&times;</span>
                                    <img class="popimage" src="images/' . $listeAnimal['image'] . '" alt="">
                                </div>
                            </td>

                            <form method="post" action="">
                                <td>
                                    <button id="deleteButton" type="submit" name="delete" value="' . $listeAnimal['id_animal'] . '">Supprimer</button>
                                </td>
                            </form>
                        </tr>';
                    }

                    echo '</table>';
                    ?>




                <?php } ?>

    <?php } ?>

    <?php
    require('include/footer.php');
    ?>

    <script>
        function openPopup(animalId) {
            document.getElementById('overlay' + animalId).style.display = 'block';
            document.getElementById('popup' + animalId).style.display = 'block';
        }

        function closePopup(animalId) {
            document.getElementById('overlay' + animalId).style.display = 'none';
            document.getElementById('popup' + animalId).style.display = 'none';
        }
    </script>

</body>
</html>
