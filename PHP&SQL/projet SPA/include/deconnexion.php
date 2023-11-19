<?php

    session_start(); // INISTIALISE SESSION
    session_unset(); // DESACTIVE SESSION
    session_destroy(); // DETRUIT SESSION
    setcookie('log','',time()-3444,'/',null,false,true);
    header('Location: ../index.php');



?>