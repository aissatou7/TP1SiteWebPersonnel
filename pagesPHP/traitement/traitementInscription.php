<?php
include("controleSaisieInscription.php");
// session_start();
if (isset($_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['roleUser'],$_POST['passwords'],$_POST['Cpasswords'])) {

    $nom = ($_POST['nom']);
    $prenom = ($_POST['prenom']);
    $email = ($_POST['email']);
    $roleUser = ($_POST['roleUser']);
    $passwords = ($_POST['passwords']);
    $Cpasswords = ($_POST['Cpasswords']);
        $stmt = $bdd->prepare("SELECT * FROM user WHERE email='$email' ");
        $stmt->execute();
     

   //      $sql= "SELECT matricule from user";
   //  $mat;
   //  $res = $bdd->query($sql);
   //  if($res->rowCount()>0){
   //      $matricules = $res->fetchAll();
   //      $matricule = $matricules[count($matricules) - 1]['matricule'];
   //      $increment = (int) explode("/", $matricule)[]++;
   //      $mat = "FDG_2022/$increment";
   //  }

        $rowC = $stmt->fetchColumn(PDO::FETCH_ASSOC);
    
        if ($rowC > 0) {
            $erreur[] = 'Le compte existe déjà';
        } elseif ($passwords != $Cpasswords) {
            $erreur[] = 'Les mots de passe saisi ne sont pas conforme';
        } else {
            
            $stmt = $bdd->prepare("INSERT INTO user (nom,prenom,email,matricule,roleUser,passwords,etat, dateInscrition, dateSuppression, dateArchivage, etatArchivage) VALUES('$nom','$prenom','$email','$mat','$roleUser','$passwordHack',12,'2022-10-26','2022-10-26','2022-10-26',0)");
            $stmt->execute();
            // $stmtImage = $bdd->prepare("INSERT INTO image (photo,user)VALUES('$fileName','$idUser)");
            // $stmtImage->execute();
            header('location:index.php');
        }

    }


?>