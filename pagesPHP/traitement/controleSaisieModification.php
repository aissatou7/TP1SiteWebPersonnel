<?php
if (isset($_POST['valider'])) {
   if  (empty($_POST["nom"]) || $_POST["nom"]==" ") { //vérifie si le champ est vide et ne contient pas seulement d'espace
      $erreurNom[] = 'Veuillez saisir le nom!';
     }
   if  (empty($_POST["prenom"]) || $_POST["prenom"]==" ") { //vérifie si le champ est vide et ne contient pas seulement d'espace
      $erreurPrenom[] = 'Veuillez saisir le prenom';
   }

   if (empty($_POST["email"]) || empty($_POST["email"])==" " ){
      $erreurEmail[] = "Veuillez saisir votre mail!";
   } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
      $erreurEmail[] = "format de l'email est incorrection: example@gmail.com ";
   }

}?>