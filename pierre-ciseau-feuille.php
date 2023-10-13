<?php

if (isset($_POST['choix'])) {

    $choix = $_POST['choix'];


    $Ordinateur = choixOrdinateur();

    $resultat = Resultat($choix, $Ordinateur);

    echo 'Votre choix : '.$choix. '<br>';
    echo 'le choix d ordianteur : '.$Ordinateur.'<br>';

} 

function choixOrdinateur() {
    $options = ["pierre", "papier", "ciseaux"];
    $choix = array_rand($options);
    return $options[$choix];
}


function Resultat($choix, $Ordinateur) {
    if ($choix === $Ordinateur) {
        echo "Égalité!<br>";
    } elseif (($choix === "pierre" && $Ordinateur === "ciseaux") || ($choix === "papier" && $Ordinateur === "pierre") || ($choix === "ciseaux" && $Ordinateur === "papier")){
        echo "Vous avez gagné!<br>";
    } else {
        echo "L'ordinateur a gagné!<br>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="pierre-ciseau-feuille.php" method="POST">
        
        <input type="radio" name="choix" value="1" >Pierre
        <input type="radio" name="choix" value="2" >Papier
        <input type="radio" name="choix" value="3" >Ciseaux

        <input type="submit" name="submit" value="Jouer">
    </form>
    
</body>
</html>