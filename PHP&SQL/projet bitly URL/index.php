<?php


    if (isset($_GET['q'])) {
        // VARIABLE

        $shortcut = htmlspecialchars($_GET['q']);
        $bdd = new PDO('mysql:host=localhost;dbname=bitly;charset=utf8', 'root', 'root');

        //VERIFIE SO RACCOUCIR EXISTE
        $req = $bdd->prepare('SELECT COUNT(*) AS list FROM links WHERE shortcut = ?');
        $req->execute(array($shortcut));

        while ($result = $req->fetch()) {
            if ($result['list'] != 1) {
                header('Location: ?error=true&message=adresse non reconnu');
                exit();
            }
        }


        //REDIRECTION
        $req = $bdd->prepare('SELECT * FROM links WHERE shortcut = ?');
        $req->execute(array($shortcut));

        while ($result = $req->fetch()) {
            header('Location: ?'.$result['url']);
            exit();
        }

    }



    if(isset($_POST['url'])){

        // VARIABLE
        $url = $_POST['url'];

        // VERIFICATION
        if(!filter_var($url,FILTER_VALIDATE_URL)){

            header('Location: ?error=true&message=adress url non valide');
            exit();

        }

        // RACCOUCIR
        $shortcut = crypt($url,rand());


        $bdd = new PDO('mysql:host=localhost;dbname=bitly;charset=utf8', 'root', 'root');
        // VERIFIE SI DEJA ENVOI

        $req = $bdd->prepare('SELECT COUNT(*) AS list FROM links WHERE url = ?');
        $req->execute(array($url));

        while ($result = $req->fetch()) {
            if ($result['list'] != 0) {
                header('Location: ?error=true&message=adresse deja raccoucir');
                exit();
            }
        }

        // ENVOYE

        $req = $bdd->prepare('INSERT INTO links(url,shortcut) VALUE(?,?)');
        $req->execute(array($url,$shortcut));
        header('Location: ?short='.$shortcut);
        exit();

        

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/favico.png" type="image/png">
</head>
<body>
    <section id="hello">

        <div class="container">

        
            <header class="container">
                <img src="img/logo.png" alt="">

            </header>
            <h1>une url longue ? raccourscissez-là ?</h1>
            <H2>largement meilleur et plus court que les autres</H2> 
            
            
            <form action="index.php" method="post">
        
                <input type="url" name="url" placeholder="Coller un lien à raccoucrir">
                <input type="submit" value="raccourcir">
            </form>

            <?php

                if (isset($_GET['error']) && isset($_GET['message'])) {
            ?>

                <div class="center">
                    <div id="result">
                        <b><?php echo htmlspecialchars($_GET['message'])?></b>
                    </div>
                </div>


            <?php
                }else{
            ?>
                <div class="center">
                    <div id="result">
                        <b>URL RACCOURCIR : http://localhost/index/SF2annee/projet%20bitly/index.php?q=<?php echo htmlspecialchars($_GET['short']);?></b>
                    </div>
                </div>

            <?php
                }

            ?>
        </div>
    </section>

    <section id="marques">


        <div class="container">

            <h3>ces marques nous font confaince</h3>

            <img src="img/1.png" class="picture" alt="">
            <img src="img/2.png" class="picture" alt="">
            <img src="img/3.png" class="picture" alt="">
            <img src="img/4.png" class="picture" alt="">
        </div>
    </section>

    <footer>
        <img src="img/logo2.png" alt="" id="logofooter"><br>
        <span>2018 &copy Bitly</span>
        <div><a href="#">Contact</a> - <a href="#">à propos</a></div>
    </footer>
</body>
</html>