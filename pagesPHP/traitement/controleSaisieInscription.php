<?php
     if  (empty($_POST["nom"]) || $_POST["nom"]==" ") { //vérifie si le champ est vide et ne contient pas seulement d'espace
      $erreurNom[] = 'Veuillez saisir le nom';
     }
     if  (empty($_POST["prenom"]) || $_POST["prenom"]==" ") { //vérifie si le champ est vide et ne contient pas seulement d'espace
      $erreurPrenom[] = 'Veuillez saisir le prenom';
   }
   if  (empty($_POST["role"]) || $_POST["role"]==" ") { //vérifie si le champ est vide et ne contient pas seulement d'espace
      $erreurRole[] = 'Veuillez saisir le role';
   }
     
     if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
      $erreurEmail[] = 'Veuillez saisir le email';
   }
   if  (strlen($_POST["passwords"]) < 4) {
      $erreurPassword[] = 'Le Password doit contenir au moins 8 caractère : lettre et chiffre';
   }
   if  (!preg_match("/[a-z]/i", $_POST["passwords"])) {
      $erreurPassword[] = 'Le Password doit contenir au moins 8 caractère : lettre et chiffre';
   }
   if  (!preg_match("/[0-9]/i", $_POST["passwords"])) {
      $erreurPassword[] = 'Le Password doit contenir au moins 8 caractère : lettre et chiffre';
   }
   if ($_POST["passwords"] !==$_POST["Cpasswords"]){
      $erreurConfirmationPassword[] = 'Le Password doit contenir au moins 8 caractère : lettre et chiffre';
   }
      // Hacher le mot de passe
      $passwordHack=password_hash($_POST["passwords"], PASSWORD_DEFAULT) ;
      print_r($passwordHack);
      print_r($_POST);
?>
