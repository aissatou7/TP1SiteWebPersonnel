<?php
     if (empty($_POST["nom"]) || $_POST["nom"]==" ") { //vérifie si le champ est vide et ne contient pas seulement d'espace
        die ("nom vide");
     }
     if (empty($_POST["prenom"]) || $_POST["prenom"]==" ") { //vérifie si le champ est vide et ne contient pas seulement d'espace
      die ("Prenom vide");
   }

     
     if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
      die ("Email non valid");
   }
 
   print_r($_POST);
?>