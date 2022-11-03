<?php
include 'connect.php';
// recupèration des input à modifier
$id = $_GET['updateid'];
$stmt = $bdd->prepare("SELECT nom,prenom,email FROM user WHERE id='$id'");
$stmt->execute();
// Ici nous allons recupèrer les valeur à modifier
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$nom = $row['nom'];
$prenom = $row['prenom'];
$email = $row['email'];


//modification 
if (isset($_POST['nom'], $_POST['prenom'], $_POST['email'])) {
    // Ici on ecrase les valeurs à modifiées par les nouvelles valeurs   
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];

    $stmt = $bdd->prepare("UPDATE user SET nom='$nom',prenom='$prenom',email='$email'WHERE id='$id'");
    $stmt->execute();
    if ($stmt) {
        
        // header("location:pageDesActives.php");
    } else {
        die('Erreur : ' . $e->getMessage());
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link font css -->
    <link rel="stylesheet" href="../pagesCSS/style.css">
    <!-- link font boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- link font awesone -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        <!-- card(carte) body -->
        <div class="card-body cardBodyCSS">
            <button class="btn mt-5"><a href="pageDesActives.php" class="lien">Retour </a></button>
            <form action="" method="post" novalidate>
                <!--  novalidate pour la validation du format de l'email (FILTER_VAR($_POST['email'] FILTER_VALIDATE_EMAIL)) -->

                <label for="nom">Nom</label><br>
                <div class="input-group mb-3">
                    <span class="input-group-text " id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                    <input type="text" class="form-control" value="<?php echo $nom ?>" autocomplete="off" name="nom" aria-label="Username" aria-describedby="basic-addon1">
                </div>

                <label for="prenom">Prenom</label>
                <div class="input-group mb-3">
                    <span class="input-group-text " id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                    <input type="text" class="form-control" value="<?php echo $prenom ?>" autocomplete="off" name="prenom" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <label for="email">Email</label><br>
                <div class="input-group mb-3">
                    <span class="input-group-text " id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                    <input type="email" class="form-control" value="<?php echo $email ?>" autocomplete="off" name="email" aria-label="Username" aria-describedby="basic-addon1">
                </div>

                <div class="form-group">
                    <!-- Modal  Modification-->
                    <button type="submit" name="valider" data-bs-toggle="modal" data-bs-target="#modalChangeRole">
                        <i class="fa-solid fa-pen-nib" style="color:black;"></i>
                    </button>

                    <div class="modal fade" id="modalChangeRole" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">ROLE</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Voulez-vous vraiment chamger le role ce membre ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">NON</button>
                                    <button type="button" class="btn btn-danger"><a class="lien text-light" href="pageDesActives.php"> OUI</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>

    </div>

</body>

</html>