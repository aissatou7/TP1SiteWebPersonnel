<?php
// Se connecter à la base de données

try 
{
    $bdd = new PDO("mysql:host=localhost;dbname=siteEcoleMe;charset=utf8", "root", "");
   
    
}
catch(PDOException $e)
{
    die('Erreur : '.$e->getMessage());
};


?>
