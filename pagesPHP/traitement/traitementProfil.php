<?php 
include("traitementConnexion.php");
if (isset($_POST['Apassword'],$_POST['Npassword'],$_POST['Cpassword'])) {
    $Apassword=$_POST['Apassword'];
    $Npassword=$_POST['Npassword'];
    $Cpassword=$_POST['Cpassword'];
    if ($_SESSION['Administrateur_password']!=$Apassword) {
        # code...
    }

}


?>