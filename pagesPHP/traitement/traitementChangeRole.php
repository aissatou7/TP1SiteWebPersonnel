<?php
include "../connect.php";

    $id=$_GET['roleid'];
    $recherche=$_GET['recherche'];
    // $datearchiver=date('y-m-d h:i:s');
    $requêterole=$bdd->prepare("SELECT roleUser FROM user WHERE id='$id'");
    $requêterole->execute();
    $role=$requêterole->fetch(PDO::FETCH_ASSOC);
    $valeurrole=$role["roleUser"];
   
    switch ($valeurrole) {
        case 'Administrateur':
            $req=$bdd->prepare("UPDATE user SET roleUser='Utilisateur' WHERE id='$id'");//code pour archiver en changeant la valeur 0 par 1
            $req->execute();
            if($req){
                if ($recherche=='oui') {
                     header('location:../pageDesActives.php');
                }
            
            }
            break;
        case 'Utilisateur':
            $req=$bdd->prepare("UPDATE user SET roleUser='Administrateur' WHERE id='$id'");//code pour archiver en changeant la valeur 0 par 1
            $req->execute();
            if($req){
                if ($recherche=='oui') {
                    header('location:../pageDesActives.php');
               }
            }
            break;
    }

?>
