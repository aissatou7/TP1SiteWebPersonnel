<?php
include('../connect.php');
if (isset($_GET['roleid'])) {
    $id=$_GET['roleid'];
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
            header('location:../pageDesActives.php');
            }
            break;
        case 'Utilisateur':
            $req=$bdd->prepare("UPDATE user SET roleUser='Administrateur' WHERE id='$id'");//code pour archiver en changeant la valeur 0 par 1
            $req->execute();
            if($req){
            header('location:../pageDesActives.php');
            }
            break;
    }
}
?>
