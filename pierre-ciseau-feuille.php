<?php

if (isset($_POST['choix'])) {
    $choix = $_POST['choix'];
    $Ordinateur = Ordinateur();
    $resultat = Resultat($choix, $Ordinateur);
    echo 'Votre choix : '.$choix. '<br>';
    echo 'le choix d ordianteur : '.$Ordinateur.'<br>';
} 

function Ordinateur() {
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


<?php

// $random = rand(1,3);

// if (isset($_POST['submit']) && $random == 1) {
//     echo 'ordinateur choisit : Pierre<br>';
// }
// if (isset($_POST['submit']) && $random == 2) {
//     echo 'ordinateur choisit : Ciseau<br>';
// }
// if (isset($_POST['submit']) && $random == 3) {
//     echo 'ordinateur choisit : Feuille<br>';
// }

// if (isset($_POST['PCF'])) {
//     echo '<div>Vous avez choisi : '.$_POST['PCF'].'</div>';
// }

// $choix = $_POST['PCF'];

// if ($random == $choix) {
//     echo 'egalite';
// } elseif (($choix == 'Pierre' && $random == 2) OR ($choix == 'Ciseau' && $random == 3) OR ($choix == 'Feuille' && $random == 1)) {
//     echo ' j\'ai gagne';
// }else{
//     echo 'ordinateur gagne';
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="pierre-ciseau-feuille.php" method="POST">
        
        <input type="radio" name="choix" value="pierre" >Pierre
        <input type="radio" name="choix" value="papier" >Papier
        <input type="radio" name="choix" value="ciseaux" >Ciseaux

        <input type="submit" name="submit" value="Jouer">
    </form>
    
</body>
</html>


