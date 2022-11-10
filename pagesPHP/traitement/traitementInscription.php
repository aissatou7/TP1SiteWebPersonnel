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
    $image = $_FILES['image']['tmp_name']; 
    $imgContent = file_get_contents($image);
    // $photo = file_get_contents($_FILES['image']['tmp_name']);
    // var_dump($photo);die;
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
            // insertion dans les tables image et user
            $stmt = $bdd->prepare("INSERT INTO user (nom,prenom,email,matricule,roleUser,passwords,etat,dateInscrition,dateSuppression,dateArchivage,etatArchivage) VALUES('$nom','$prenom','$email','mat','$roleUser','$passwordHack',0,'2022-10-26','2022-10-26','2022-10-26',0)");
            $stmt->execute();

            $stmt->closeCursor(); //permet de fermer la requête $stmt avant de passer
            $id=(int)$bdd->lastInsertId();
            $stmtImage = $bdd->prepare("INSERT INTO `image` (photo,user) VALUES (?,?)"); //cette methode est la meilleur à adopter 
            $stmtImage->bindParam(1,$imgContent);
            $stmtImage->bindParam(2,$id);

            $stmtImage->execute();
            header('location:index.php');
        }

    }


?>