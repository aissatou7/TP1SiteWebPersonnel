<?php 
    session_start(); // demarrage de la session
    session_destroy(); // on détruit la/les session(s)
    header('Location:pageConnexion.php'); // On redirige
    die();
?>