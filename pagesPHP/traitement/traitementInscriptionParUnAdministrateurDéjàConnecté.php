<?php
include"controleSaisieModification.php";

if (isset($_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['roleUser'],$_POST['passwords'],$_POST['Cpasswords'])) {

    $nom = ($_POST['nom']);
    $prenom = ($_POST['prenom']);
    $email = ($_POST['email']);
    $roleUser = ($_POST['roleUser']);
    $passwords = ($_POST['passwords']);
    $Cpasswords = ($_POST['Cpasswords']);

    // Ici on gérére automatiquement le matricule
   
    // $mat;
    // $stmt = $bdd->query("SELECT matricule from user");
    // if($stmt->rowCount()>0){
    //     $matricules = $stmt->fetchAll();
    //     $matricule = $matricules[count($matricules) - 1]['matricule'];
    //     $increment = (int) explode("/", $matricule)[1]+1;
    //     $mat = "MAF000/$increment";
    // }
   

    // Recuperation images
    // if ($_FILES["image"]["error"]===4) {
    //     echo
    //     " <script> alert('Veuillez saisir l'image')</script>";
    // }else{
    //     $fileName = $_FILES["image"]["name"];
    //     $fileSize = $_FILES["image"]["size"];
    //     $tmpName = $_FILES["image"]["tmp_name"];
        
    //     $validImageExtension = ['jpg','jpeg', 'png'];
    //     $imageExtension = explode('.', $fileName);
    //     $imageExtension = strtolower(end($imageExtension));
    //     if (!in_array($imageExtension, $validImageExtension)) {
    //         echo
    //     " <script> alert(L'extension est invalide')</script>";
    //     }elseif($fileSize > 1000000){
    //         echo
    //     " <script> alert(La taille de l'image est trop grande')</script>";
    //     }else {
    //         $newImageName = uniqid();
    //         $newImageName .= '.' . $imageExtension;
    //         move_uploaded_file($tmpName, 'img/'. $newImageName);


        
    //     }
    $i=0;
    $mat;
        $stmt = $bdd->prepare("SELECT * FROM user WHERE email='$email' ");
        $stmt->execute();
        $rowC = $stmt->fetchColumn(PDO::FETCH_ASSOC);
    
        if ($rowC > 0) {
            $erreur[] = 'Le compte existe déjà';
        } elseif ($passwords != $Cpasswords) {
            $erreur[] = 'Les mots de passe saisi ne sont pas conforme';
        } else {
            $i++;
            $mat="MAF000 $i";
            $stmt = $bdd->prepare("INSERT INTO user (nom,prenom,email,matricule,roleUser,passwords,etat, dateInscrition, dateSuppression, dateArchivage, etatArchivage,photo) VALUES('$nom','$prenom','$email','$mat','$roleUser','$passwordHack',12,'2022-10-26','2022-10-26','2022-10-26',0,'photo')");
            $stmt->execute();
            // $stmtImage = $bdd->prepare("INSERT INTO image (photo,user)VALUES('$fileName','$idUser)");
            // $stmtImage->execute();
            header('location:pageConnexion.php');
        }

    }


?>