<?php
include '../connect.php';
// recupèration des input à modifier
$id = $_GET['id'];
// $stmt = $bdd->prepare("SELECT nom,prenom,email FROM user WHERE id='$id'");
// $stmt->execute();
// // Ici nous allons recupèrer les valeur à modifier
// $row = $stmt->fetch(PDO::FETCH_ASSOC);
// $nom = $row['nom'];
// $prenom = $row['prenom'];
// $email = $row['email'];


//modification 
// if (isset($_POST['Cpassword'])) {
    // Ici on ecrase les valeurs à modifiées par les nouvelles valeurs   
   
    $Cpassword = $_POST['Cpassword'];
    var_dump($Cpassword);die();

    $stmt = $bdd->prepare("UPDATE user SET passwords='$Cpassword' WHERE id='$id'");
    $stmt->execute();
    if ($stmt) {
        
         header("location:pageDesActives.php");
    } else {
        die('Erreur : ' . $e->getMessage());
    }
// }


?>