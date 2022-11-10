
 <?php
    include('traitement/traitementConnexion.php');
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
        <!-- card(carte) body -->
        <div class="card-body cardBodyCSS">
            <form action="" method="post">
                <!-- Affichage des messages d'erreurs -->
                 <?php
                if (isset($erreur)) {
                    foreach ($erreur as $erreur) {
                        echo '<div class="erreurMsg" style="color:red;"> ' . $erreur . '</div>';
                    }
                }
                ?><br>
                <label for="email"> Email</label><br>
                <div class="input-group mb-3">
                    <span class="input-group-text " id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                    <input type="email" class="form-control" placeholder="Entrez votre Email" autocomplete="off" name="email" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <label for="password">Mot de passe</label><br>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-sharp fa-solid fa-key"></i></i></span>
                    <input type="password" class="form-control" placeholder="Entrez votre mot de passe" autocomplete="off" name="passwords" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="form-group">
                    <input type="submit" name="valider" value="Connecter" class="btnSubmitCSS">
                </div>
            </form>
        </div>
        <!-- card(carte) footer -->
        <div class="card-footer cardFooterCSS">
            Je n'ai pas de compte. <a href="inscription.php" class="lien" style="color:#2A7282 ;"> M'inscrire?</a>
        </div>
    </div>

</body>

</html>