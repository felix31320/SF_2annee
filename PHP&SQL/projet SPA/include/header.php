<header>
    
<a href="index.php"><div class="imagelogo"></div></a>
    <div>

        <?php
        if (isset($_SESSION['connect'])) { ?>


            <a href="index.php" class="inputAnimal">Liste des animaux</a>
            <a href="ajoutanimaux.php" class="inputAnimal">Ajout un animal</a>
            <a href="listedesanimaux.php" class="inputAnimal">Animal Adopte</a>
            <a href="include/deconnexion.php" class="inputDeconnexion">Deconnexion</a>
            

        <?php }else{ ?>
            
            

            <a href="inscription.php" class="inputRouge">S'inscrire</a>
            <a href="connexion.php" class="inputVert">Connexion</a>


        <?php
        }
        ?>





    </div>
</header>