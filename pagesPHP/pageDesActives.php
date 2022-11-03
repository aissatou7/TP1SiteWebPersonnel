<?php
include('connect.php');
include('traitement/traitementConnexion.php');
if ($_SESSION['id']) {
  $idSession = $_SESSION['id'];
}
?>

<!DOCTYPE html>
<html lang="fr">

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
  <script src="https://code.jquery.com/jquery-3.5.0.min.js%22%3E"></script>
  <title>Page Administrateur</title>
</head>

<body>
  <div class=" w-75 bg-light mt-5">
    <!-- entête contenant la photo, un message et bouton de déconnexion -->
    <div class="row ">
      <div class="col-2">

        <!-- entête contenant la photo / Modal change role  -->
        <!-- Ici la photo de profil est inserrer dans un bouton Modal. Les 3 dernières propriétés permettent l'affichage d'un message (Votre profil) au survole   -->
        <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#modalProfil" data-bs-placement="bottom" data-bs-toggle=" tooltip" title="Votre profil">
          <!-- Recupèration de la photo à la base de données -->
          <?php
          $state = $bdd->prepare("SELECT photo FROM image WHERE user=:user");
          $state->execute(['user'=> $idSession]);
          $rows = $state->fetch(PDO::FETCH_ASSOC);
          ?>
          <!-- ici nous avons l'image du profil -->
          <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($rows['photo']); ?>" class="rounded-circle border p-1 bg-secondary   " height="100" width="100" />
          <!-- Ici nous avons le matricule de la personne connectée -->
          <h4><?php echo $_SESSION['Administrateur_matricule'] ?></h4>
        </button>
        
        <div class="modal fade" id="modalProfil" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <!-Ici nous avons l'entête du profil image, prenom et nom-  -->
            <div class="modal-header">
              <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($rows['photo']); ?>" class="rounded-circle border p-1 bg-secondary   " height="100" width="100" />
              <h5 class="ms-5"> <?php echo $_SESSION['Administrateur_prenom'] . ' ' . $_SESSION['Administrateur_nom'] ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                Pour changer votre photo de profil cliquer sur <b>Photo</b> .
                <hr>
                Pour changer votre mot de passe cliquer sur <b>Mot de passe</b> .
              </div>
              <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#changePhoto" data-bs-toggle="modal" data-bs-dismiss="modal">Photo</button>
                <button class="btn btn-primary" data-bs-target="#changeMotDepasse" data-bs-toggle="modal" data-bs-dismiss="modal">Mot de passe</button>
              </div>
            </div>
          </div>
        </div>
                <!-- Ici nous avons le modal pour la modification de la photo -->
        <div class="modal fade" id="changePhoto" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <!-- Ce bouton permet de retourner au premier modal -->
              <button class="btn btn-primary" data-bs-target="#modalProfil" data-bs-toggle="modal" data-bs-dismiss="modal" >retour</button>
                <h5 class="modal-title ms-1" id="exampleModalToggleLabel2">Modifier ici votre photo</h5>
              </div>
                <div class="modal-body">
              
                    <form action="traitement/traitementImage.php" method="post"  enctype="multipart/form-data">
                      <!--  novalidate pour la validation du format de l'email (FILTER_VAR($_POST['email'] FILTER_VALIDATE_EMAIL)) -->
                      <label for="userPhoto" class="custom-file-label">Photo </label><br>
                      <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-sharp fa-solid fa-key"></i></span>
                        <input type="file" name="image" id="image" value="">
                      </div>
                      
                      <div class="modal-footer">
                        <button type="submit" name="valider" accept=".jpg, .png, .jpeg" class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Modifier</button>
                      </div>
                    </form>
                </div>
            </div>
          </div>
        </div>
        <!-- Ici nous avons le modal pour la modification du mot de passe -->
        <div class="modal fade" id="changeMotDepasse" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
              <button class="btn btn-primary" data-bs-target="#modalProfil" data-bs-toggle="modal" data-bs-dismiss="modal" >retour</button>
                <h5 class="modal-title " id="exampleModalToggleLabel2">Modifier ici votre mot de passe</h5>
              </div>
              <div class="modal-body">
                 <!-- Ce bouton permet de retourner au premier modal -->
          
                <form action="traitement/traitementProfil.php" method="post" novalidate enctype="multipart/form-data">
                  <!--  novalidate pour la validation du format de l'email (FILTER_VAR($_POST['email'] FILTER_VALIDATE_EMAIL)) -->
                    <label for="nom">Ancien mot de passe</label><br>
                        <div class="input-group mb-3">
                            <span class="input-group-text " id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                            <input type="password" class="form-control" value="<?php echo $nom ?>" autocomplete="off" name="Apassword" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    <label for="nom">Nouveau mot de passe</label><br>
                        <div class="input-group mb-3">
                            <span class="input-group-text " id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                            <input type="password" class="form-control" value="<?php echo $nom ?>" autocomplete="off" name="Npassword" aria-label="Username" aria-describedby="basic-addon1">
                        </div>   
                    <label for="nom">Confirmez votre nouveau mot de passe</label><br>
                        <div class="input-group mb-3">
                            <span class="input-group-text " id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                            <input type="password" class="form-control" value="<?php echo $nom ?>" autocomplete="off" name="Cpassword" aria-label="Username" aria-describedby="basic-addon1">
                        </div> 

                </form>
              </div>
              <div class="modal-footer">
                <button type="submit" name="validerMotPass" accept=".jpg, .png, .jpeg" class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Modifier</button>
              </div>
            </div>
          </div>
        </div>
      </div>






      <!-- Message de bienvenue -->
      <div class="col-8  d-flex justify-content-center align-items-center">
        <h1 style="color: #2A7282;"> Bienvenue <?php echo $_SESSION['Administrateur_prenom'] . ' ' . $_SESSION['Administrateur_nom'] ?></h1>
      </div>





      <!-- Ici nous gére la déconnexion de la session avec un messae au survole-->
      <div class="col-2 d-flex justify-content-center align-items-center">
        <button class="btn w-25" data-bs-toggle="modal" data-bs-target="#modalDéconnexion" data-bs-placement="bottom" data-bs-toggle=" tooltip" title="Déconnexion"><i class="fa-solid fa-right-from-bracket fa-2x" style="color: #2A7282;"></i></button>
      </div>

      <!-- <p class="align-items-center justify-content-center">-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</p> -->

    </div>
    <!-- Ici nous avons les liens sur la page inscription et la liste des archivés -->
    <div class="row ">
      <div class="row  d-flex align-items-center ">

        <div class="col-2 ">
          <button class="btn"><a href="pageInscription.php" class="lien" style="color: #2A7282;">Inscription </a></button>
        </div>

        <div class="col-5">
          <button class="btn "><a href="pageDesArchivés.php" class="lien" style="color: #2A7282;">Liste des archivés</a></button>
        </div>

        <!-- Ici nous avons la barre de recherche -->
        <div class="col-5  ">

          <form action="" method="POST" class="d-flex">
            <input type="search" name="recherche" class="form-control" placeholder="Rechercher un membre ..." autocomplete="off" aria-label="Username" aria-describedby="basic-addon1">
            <button type="submit" class="input-group-text" id="basic-addon1" style="background-color: #2A7282;"><i class="fa-sharp fa-solid fa-key" style="color: white; size:2%"></i></button>
          </form>

        </div>
      </div>

    </div>
    <table class="table bg-light">
      <thead>
        <tr>

          <th scope="col">Nom</th>
          <th scope="col">Prenom</th>
          <th scope="col">Email</th>
          <th scope="col">Matricule</th>
          <th scope="col">Role</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (isset($_POST['recherche']) && ($_POST['recherche'] != '')) {
          $emailàAfficher = $_POST['recherche'];

          $stmt = $bdd->prepare("SELECT * FROM user WHERE etatArchivage=0");
          $stmt->execute();
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (($_SESSION['Administrateur_email'] != $row['email']) && $row['email'] == $emailàAfficher) {
              $nom = $row['nom'];
              $prenom = $row['prenom'];
              $email = $row['email'];
              $role = $row['roleUser'];
              $matricule = $row['matricule'];
              $id = $row['id'];


              echo '<tr>
              
            <td >' . $nom . '</td>
            <td >' . $prenom . '</td>
            <td>' . $email . '</td>
            <td>' . $matricule . '</td>
            <td>' . $role . '</td>
            
            <td>
            
            <!-- ici nou avons le Modal change role; Les fonctions 3 dernières propriétés permettent l affichage de message quand on survole le bouton --> 
                                                                                
            <button type="button" class="btn "  data-bs-placement="bottom" data-bs-toggle=" tooltip" title="Changer le role de ce membre">
            <a class="lien text-light" href="traitement/traitementChangeRole.php?recherche=oui?roleid=' . $id . '"><i class="fa-solid fa-pen-nib" style="color:black;"></i></a>
            </button>
            
   
                  <!--  ici nous anons le Modal Suppresion ; Les fonctions 3 dernières propriétés permettent l affichage de message quand on survole le bouton -->
                  <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#modalSuppression" data-bs-placement="bottom" data-bs-toggle=" tooltip" title="Supprimer de ce membre">
                  <a class="lien text-light" href="traitement/traitementArchivage.php?deleteid=' . $id . '"><i class="fa-solid fa-trash-can" style="color:black;"></i></a>
                  </button>
                  
    
              <!-- ici nous avons le Modal  Modification ; Les fonctions 3 dernières propriétés permettent l affichage de message quand on survole le bouton-->
              <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#modalModification" data-bs-placement="bottom" data-bs-toggle=" tooltip" title="Modifier de ce membre">
              <a class="lien text-light"  href="pageModification.php?updateid=' . $id . '"><i class="fa-solid fa-pen" style="color:black;"></i></a>
              </button>
    
              
            
            </td>
        
          </tr>';
            }
          }
        } else {
          $stmt = $bdd->prepare("SELECT * FROM user WHERE etatArchivage=0 ");
          $stmt->execute();
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (($_SESSION['Administrateur_email'] != $row['email'])) {
              $nom = $row['nom'];
              $prenom = $row['prenom'];
              $email = $row['email'];
              $role = $row['roleUser'];
              $matricule = $row['matricule'];
              $id = $row['id'];


              echo '<tr>
            
          <td >' . $nom . '</td>
          <td >' . $prenom . '</td>
          <td>' . $email . '</td>
          <td>' . $matricule . '</td>
          <td>' . $role . '</td>
          
          <td>
          
       
          <!-- ici nou avons le Modal change role; Les fonctions 3 dernières propriétés permettent l affichage de message quand on survole le bouton --> 
                                                                                
          <button type="button" class="btn " data-bs-toggle="modal"   data-bs-target="#modalChangeRole" data-bs-placement="bottom" data-bs-toggle=" tooltip" title="Changer le role de ce membre">
          <a class="lien text-light" href="traitement/traitementChangeRole.php?roleid=' . $id . '"><i class="fa-solid fa-pen-nib" style="color:black;"></i></a>
          </button>
 
                <!--  ici nous anons le Modal Suppresion ; Les fonctions 3 dernières propriétés permettent l affichage de message quand on survole le bouton -->
                <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#modalSuppression" data-bs-placement="bottom" data-bs-toggle=" tooltip" title="Supprimer de ce membre">
                <a class="lien text-light" href="traitement/traitementArchivage.php?deleteid=' . $id . '"><i class="fa-solid fa-trash-can" style="color:black;"></i></a>
                </button>
                    
                
  
            <!-- ici nous avons le Modal  Modification ; Les fonctions 3 dernières propriétés permettent l affichage de message quand on survole le bouton-->
            <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#modalModification" data-bs-placement="bottom" data-bs-toggle=" tooltip" title="Modifier de ce membre">
            <a class="lien text-light"  href="pageModification.php?updateid=' . $id . '"><i class="fa-solid fa-pen" style="color:black;"></i></a>
            </button>
                
          
          
          </td>
        </tr>';
            }
          }
        }




        ?>


      </tbody>

    </table>
    <!-- pagination -->
    <!-- <nav aria-label="Page navigation example" id="pagination">
      <ul class="pagination justify-content-center">
        <li class="page-item disabled "> <a class="page-link" href="#"> Précédent </a>
        </li>
        <li class="page-item active"> <a class="page-link" href="#">1</a></li>
        <li class="page-item"> <a class="page-link" href="#">2</a></li>
        <li class="page-item"> <a class="page-link" href="#">3</a></li>
        <li class="page-item"> <a class="page-link" href="#">Suivant</a></li>
      </ul>

    </nav>
  </div> -->



    <!-- ici nous avons le Modal  Déconnexion ; Les fonctions 3 dernières propriétés permettent l affichage de message quand on survole le bouton-->

    <div class="modal fade" id="modalDéconnexion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Déconnection</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Voulez-vous vraiment vous déconnecté ?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">NON</button>
            <button type="button" class="btn btn-danger"><a href="pageDéconnexion.php" class="lien" style="color:white;">OUI</a> </button>
          </div>
        </div>








        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script>
          $(document).ready(function() {
            
            let id=""
            alert("hh");
            $(".edit").on("click", function() {
               id = $(this).attr("data-id");
            });

            $(".confirmEdit").on("click", function() {
                document.location = "editUser.php?id=" +id;
            });

            // $(".archive").on("click", function() {
            //    id = $(this).attr("data-id");
            // });

            // $(".confirmArchive").on("click", function() {
            //     document.location = "archiveUser.php?id=" +id;
            // });

            // $(".role").on("click", function() {
            //    id = $(this).attr("data-id");
            // });

            // $(".confirmRole").on("click", function() {
            //     document.location = "switchRole.php?id=" +id;
            // });
        })
        </script>

</body>

</html>