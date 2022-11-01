<?php
include('../connect.php');
if (isset($_GET['deleteid'])) {
    $id=$_GET['deleteid'];
    // $datearchiver=date('y-m-d h:i:s');
    $req=$bdd->prepare("UPDATE user SET etatArchivage='1' WHERE id='$id'");//code pour archiver en changeant la valeur 0 par 1
    $req->execute();
    if($req){
       header('location:../pageDesActives.php');
    }
}
?>
