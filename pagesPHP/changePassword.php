<?php
include 'connect.php';
// recupèration des input à modifier
$id = $_GET['id'];
$stmt = $bdd->prepare("SELECT passwords FROM user WHERE id='$id'");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$passwords = $row['passwords'];



if (isset($_POST['valider'])) { //Les modifications ne s'affichent que lorsqu'on clic sur  valider

if (isset($_POST['Apassword'],$_POST['Npassword'],$_POST['Cpassword'])&& !empty($_POST['Apassword']) && !empty($_POST['Npassword']) && !empty($_POST['Cpassword'])) {
  $Apassword=$_POST['Apassword'];
  $Npassword=$_POST['Npassword'];
  $Cpassword=$_POST['Cpassword'];
    if (password_verify($Apassword,$passwords)) {
        if ($Npassword==$Cpassword) {
            // Hacher le mot de passe
                $passwordHack=password_hash($_POST["Cpassword"], PASSWORD_DEFAULT) ;

                $stmt = $bdd->prepare("UPDATE user SET passwords='$passwordHack'WHERE id='$id'");
                $stmt->execute();
                if ($stmt) {
                    header("location:pageDesArchivés.php");
                } else {
                    die('Erreur : ' . $e->getMessage());
                }
        }else {
            $erreurPasswordC[] = "password not compatible!";
            
        }
    }else {
        $erreurPasswordA[] = "password Actuel incorrecte!";
    }

}else{ 
    $erreurPassword[] = "Veuillez remplir tous les champs!";
}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include('misesEnPage.php');
    ?>
    <!-- Formulaire de connexion / boostrap/ CSS -->
    <div class="container  w-50">
        <!-- card(carte) header -->
        <div class="card-header text-center  text-white cardHeaderCSS ">
            <h3> MODIFICATION</h3>
        </div>
        <?php
        if (isset($erreurPassword)) {
            // La boucle foreach permet d'afficher toutes les caractères×
            foreach($erreurPassword as $char){
                echo"<span style='color:red;'>$char </span>";
            }
        }
        ?>
        
        <!-- card(carte) body -->
        <div class="card-body cardBodyCSS">
            <button class="btn mt-5"><a href="pageDesActives.php" class="lien">Retour </a></button>
            <form action="" method="post" >
                  <!--  novalidate pour la validation du format de l'email (FILTER_VAR($_POST['email'] FILTER_VALIDATE_EMAIL)) -->
                    <label for="nom">Mot de passe Actuel</label><br>
                        <div class="input-group mb-3">
                            <span class="input-group-text " id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                            <input type="text" class="form-control" autocomplete="off" name="Apassword" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                            <?php
                            if (isset($erreurPasswordA)) {
                                // La boucle foreach permet d'afficher toutes les caractères×
                                foreach($erreurPasswordA as $char){
                                    echo"<span style='color:red;'>$char </span>";
                                }
                            }
                            ?><br>
                    <label for="nom">Nouveau mot de passe</label><br>
                        <div class="input-group mb-3">
                            <span class="input-group-text " id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                            <input type="text" class="form-control" autocomplete="off" name="Npassword" aria-label="Username" aria-describedby="basic-addon1">
                        </div>   
                       
                    <label for="nom">Confirmez votre nouveau mot de passe</label><br>
                        <div class="input-group mb-3">
                            <span class="input-group-text " id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                            <input type="text" class="form-control" autocomplete="off" name="Cpassword" aria-label="Username" aria-describedby="basic-addon1">
                        </div> 
                        <?php
                            if (isset($erreurPasswordC)) {
                                // La boucle foreach permet d'afficher toutes les caractères×
                                foreach($erreurPasswordC as $char){
                                    echo"<span style='color:red;'>$char </span>";
                                }
                            }
                            ?><br>
                       <input type="submit" name="valider" value="Modifier">

                </form>
    </div>

    </div>

</body>

</html>