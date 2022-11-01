<?php
include('connect.php');
session_start();

if (isset($_POST['valider'])) {
    $email = $_POST['email'];
    $passwordSaisie = $_POST['passwords'];

    $stmt = $bdd->prepare("SELECT * FROM user WHERE email='$email' ");
    $stmt->execute();
    $row = $stmt->fetchColumn(PDO::FETCH_ASSOC);

    if ($row > 0) {
        $stmt = $bdd->prepare("SELECT * FROM user WHERE email='$email' ");
        $stmt->execute();
        $rowV = $stmt->fetch(PDO::FETCH_ASSOC);

        $roleUser = $rowV['roleUser'];
        $nom = $rowV['nom'];
        $passwords = $rowV['passwords'];
        $etatArchivage = $rowV['etatArchivage'];
        // Conection d'un utilisateur ou administrateur non archivé
        if ($etatArchivage == 1) {
            $erreur[] = "Une erreur c'est produit lors de votre tentative de connexion.<br> Veuillez contacter l'administrateur à l'email : yayefallsaliou@gmail.com"  ;
        }elseif ($passwords == $passwordSaisie) {
            if ($roleUser == 'Administrateur') {
                $_SESSION['Administrateur_nom'] = $nom;
                header('location:pageDesActives.php');
            } elseif ($roleUser == 'Utilisateur')  {
                $_SESSION['Utilisateur_nom'] = $nom;
                header('location:pageDesActivesUtilisateur.php');
            }
        }elseif ($passwordSaisie=='') {
            $erreur[] = 'Veuillez Saisir le mot de passe!';
        }else {
            $erreur[] = 'Password incorrect!';
        }
    }else {
        $erreur[] = "Le Compte n'existe pas";
    }
}    
?>