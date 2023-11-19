<?php 

try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=coursphp;charset=utf8', 'root', 'root');
    echo 'on est connecté';

} catch(Exception $e){
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

//AJOUTER NOUVEAU METIER

//$add_metier = $bdd->exec('INSERT INTO metier(id_user,metier) VALUES(21,"developpeur fullstack")');

// AJOUTER UN NOUVEAU USER

//$add_user = $bdd->exec('INSERT INTO users (prenom,nom,serie_prefere) VALUE("LeFi","Fris","Prison Break")') or die(print_r($bdd->errorInfo()));

// MODIFIER

// $modifier = $bdd->exec('UPDATE users SET serie_prefere="Squid game" WHERE prenom="Maxime"');

// SUPPRIMER

//$supprimer = $bdd->exec('DELETE FROM users WHERE prenom="Alexis"');

//JOINTURE INTERNE : WHERE OR JOIN

// JOINTURE EXTERNES
// LEFT JOIN
// RIGHT JOIN


// LIRE LES INFOS



//$donnes = $bdd->query('SELECT * FROM users,metier WHERE users.id = metier.id_user');
$donnes = $bdd->prepare('SELECT * FROM users INNER JOIN metier ON users.id = metier.id_user');

$donnes->execute(array());

echo '<table border>
    <tr>
        
        <th>prenom</th>
        <th>nom</th>
        <th>Mot de passe</th>
        
    </tr>';

    while ($reponse = $donnes->fetch()) {
        echo '
            <tr>
                
                <td>'.$reponse['prenom'].'</td>
                <td>'.$reponse['nom'].'</td>
                <td>'.sha1($reponse['serie_prefere']).'</td>
                
            </tr>
        
        ';
    }

    $donnes->CloseCursor();

    echo '</table>';

    if (isset($_POST['bouton'])) {
        
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $serie = $_POST['serie'];

        if (!empty($prenom) && !empty($nom) && !empty($serie)) {
            
            $add_user = $bdd->prepare('INSERT INTO users(prenom,nom,serie_prefere) VALUES (?,?,?)');
            $add_user->execute(array($prenom,$nom,$serie));

        }else {
            echo ' un des champs vide';
        }


    }


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

    <form action="connectSQL.php" method="post">

        <label>Prenom : <input type="text" name="prenom" id=""></label><br>
        <label>Nom : <input type="text" name="nom" id=""></label><br>
        <label>Serie Prefere : <input type="text" name="serie" id=""></label><br>
        <input type="submit" name="bouton" value="Envoyer">
    </form>
</body>
</html>