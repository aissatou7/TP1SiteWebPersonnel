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
        $userId = $rowV['id'];
        $roleUser = $rowV['roleUser'];
        $nom = $rowV['nom'];
        $prenom = $rowV['prenom'];
        $passwords = $rowV['passwords'];
        $etatArchivage = $rowV['etatArchivage'];
        $matricule = $rowV['matricule'];
        
        // Conection d'un utilisateur ou administrateur non archivé
        if ($etatArchivage == 1) {
            $erreur[] = "Une erreur c'est produit lors de votre tentative de connexion.<br> Veuillez contacter l'administrateur à l'email : yayefallsaliou@gmail.com"  ;
        }elseif (password_verify($passwordSaisie,$passwords)) {
            if ($roleUser == 'Administrateur') {
                header('location:pageDesActives.php');
            } elseif ($roleUser == 'Utilisateur')  {
                header('location:pageDesActivesUtilisateur.php');
            }
            $_SESSION['id'] = $userId;
            $_SESSION['email'] = $email;
            $_SESSION['prenom'] = $prenom;
            $_SESSION['matricule'] = $matricule;
            $_SESSION['nom'] = $nom;
            $_SESSION['password'] = $passwords;
            $_SESSION['roleUser'] = $roleUser;
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