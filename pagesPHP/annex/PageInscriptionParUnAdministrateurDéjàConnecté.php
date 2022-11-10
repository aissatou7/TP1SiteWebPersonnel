<?php
include('connect.php');
include('traitement/traitementInscription.php');
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
    <title>Ecole ARAHMA</title>
</head>

<body>

    <!-- Formulaire de connexion / boostrap/ CSS -->
    <div class="container  w-50">


        <!-- card(carte) header -->
        <div class="card-header text-center  text-white cardHeaderCSS ">
            <h3> CONNEXION</h3>

        </div>
        <!-- Ici nous avons le bouton d'annulation de l'inscription -->
        <button class="btn mt-3" style="background-color:#2A7282;"> <a href="pageDesActives.php" class="lien" style="color:white ;"> Retour</a></button>

        <!-- card(carte) body -->
        <div class="card-body cardBodyCSS">
            <form action="" method="post" novalidate enctype="multipart/form-data">
                <!--  novalidate pour la validation du format de l'email (FILTER_VAR($_POST['email'] FILTER_VALIDATE_EMAIL)) -->
                <!-- Affichage des messages d'erreurs -->

                <br>
                <label for="nom">Nom</label><br>
                <div class="input-group mb-3 ">
                    <span class="input-group-text " id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                    <input type="text" class="form-control" placeholder="Entrez votre nom" autocomplete="off" name="nom" aria-label="Username" aria-describedby="basic-addon1">

                </div>
                <!-- Affichage des messages d'erreurs avec controle PHP-->
                <?php
                if (isset($erreurNom)) {
                    foreach ($erreurNom as $erreurNom) {
                        echo '<div class="erreurMsg" style="color:red;"> ' . $erreurNom . '</div>';
                    }
                }
                ?>
                <label for="prenom">Prenom</label>
                <div class="input-group mb-3">
                    <span class="input-group-text " id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                    <input type="text" class="form-control" placeholder="Entrez votre prenom" autocomplete="off" name="prenom" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <!-- Affichage des messages d'erreurs avec controle PHP-->

                <?php
                if (isset($erreurPrenom)) {
                    foreach ($erreurPrenom as $erreurPrenom) {
                        echo '<div class="erreurMsg" style="color:red;"> ' . $erreurPrenom . '</div>';
                    }
                }
                ?>
                <label for="email">Email</label><br>
                <div class="input-group mb-3">
                    <span class="input-group-text " id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                    <input type="email" class="form-control" placeholder="Entrez votre Email" autocomplete="off" name="email" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <!-- Affichage des messages d'erreurs avec controle PHP-->
                <?php
                if (isset($erreurEmail)) {
                    foreach ($erreurEmail as $erreurEmail) {
                        echo '<div class="erreurMsg" style="color:red;"> ' . $erreurEmail . '</div>';
                    }
                }
                ?>
                <label for="role">Role</label><br>
                <div class="input-group mb-3">
                    <span class="input-group-text " id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                    <select class="form-select" name="roleUser" aria-label="Default select example">
                        <option selected>Entrez votre role</option>
                        <option value="Administrateur">Administrateur</option>
                        <option value="Utilisateur">Utilisateur</option>
                    </select>
                </div>
                <!-- Affichage des messages d'erreurs avec controle PHP-->

                <?php
                if (isset($erreurRole)) {
                    foreach ($erreurRole as $erreurRole) {
                        echo '<div class="erreurMsg" style="color:red;" > ' . $erreurRole . '</div>';
                    }
                }
                ?>
                <label for="password">Mot de passe</label><br>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-sharp fa-solid fa-key"></i></span>
                    <input type="password" class="form-control" placeholder="Entrez votre mot de passe" autocomplete="off" name="passwords" aria-label="Username" aria-describedby="basic-addon1">
                </div>

                <!-- Affichage des messages d'erreurs -->
                <?php
                if (isset($erreurPassword)) {
                    foreach ($erreurPassword as $erreurPassword) {
                        echo '<div class="erreurMsg" style="color:red;"> ' . $erreurPassword . '</div>';
                    }
                }
                ?>
                <label for="password">Confirmez votre de passe</label><br>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-sharp fa-solid fa-key"></i></span>
                    <input type="password" class="form-control" placeholder="Confirmez votre mot de passe" autocomplete="off" name="Cpasswords" aria-label="Username" aria-describedby="basic-addon1">
                </div>

                <!-- Affichage des messages d'erreurs avec controle PHP-->
                <?php
                if (isset($erreurConfirmationPassword)) {
                    foreach ($erreurConfirmationPassword as $erreurConfirmationPassword) {
                        echo '<div class="erreurMsg" style="color:red;"> ' . $erreurConfirmationPassword . '</div>';
                    }
                }
                ?>


                <label for="userPhoto" class="custom-file-label">Photo </label><br>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-sharp fa-solid fa-key"></i></span>
                    <input type="file" name="image" id="image" value="">
                </div>
                <!-- ici nous avons un bouton de validation avec un modal pour le choix de la redirection -->
                <div class="form-group">

                    <!-- ici nou avons le Modal change role; Les fonctions 3 dernières propriétés permettent l affichage de message quand on survole le bouton -->
                    <button type="submit"  name="valider"class="btn " data-bs-toggle="modal" data-bs-target="#modalChangeRole" accept=".jpg, .png, .jpeg" class="btnSubmitCSS">Envoyer</button>

                    <div class="modal fade" id="modalChangeRole" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">ROLE</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Voulez-vous vraiment changer le role ce membre ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">NON</button>
                                    <button type="button" class="btn btn-danger"><a class="lien text-light" href="traitement/traitementChangeRole.php?roleid=' . $id . '">OUI</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


        </div>
        </form>
    </div>
    <!-- card(carte) footer -->
    </div>

    <!-- ici nou avons le Modal change role; Les fonctions 3 dernières propriétés permettent l affichage de message quand on survole le bouton -->




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>