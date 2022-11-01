<?php
include('connect.php');

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
  <link rel="stylesheet" href="../pagesCSS/style.css">

  <title>Page Administrateur</title>
</head>

<body>
  <div class="container bg-light mt-5">
    <!-- entête contenant la photo, un message et bouton de déconnexion -->
    <div class="row">
      <div class="col-2">

        <!-- entête contenant la photo / Modal change role  -->
        <!-- Ici la photo de profil est inserrer dans un bouton Modal. Les 3 dernières propriétés permettent l'affichage d'un message (Votre profil) au survole   -->
        <button type="button" class="btn ms-5" data-bs-toggle="modal" data-bs-target="#modalProfil" data-bs-placement="bottom" data-bs-toggle=" tooltip" title="Votre profil">
          <!-- Recupèration de la photo à la base de données -->
          <?php
          $state = $bdd->prepare("SELECT * FROM image");
          $state->execute();
          $rows = $state->fetch();
          ?>
          <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($rows['photo']); ?>" class="rounded-circle border p-1 bg-secondary  ms-5 " height="100" width="100" />

        </button>
        <span> MAF0001</span>
      </div>
      <!-- Ici je gére la déconnexion de la session -->
      <div class="col-9 ">
          <button class="btn " style="margin: 5% 80%"><a href="pageDéconnexion.php" class="lien">Déconnexion</a></button>
        </div>



    </div>
    <!-- Ici nous avons les liens sur la page inscription et la liste des archivés -->
    <div class="row">
      <div class="row  d-flex align-items-center ">
        <div class="col-2 ">
          <button class="btn "><a href="pageInscription.php" class="lien">Inscription </a></button>
        </div>
        <div class="col-3">
          <button class="btn "><a href="pageDesArchivés.php" class="lien">Liste des archivés</a></button>
        </div>

        <!-- Ici nous avons la barre de recherche -->
        <div class="col-7 ">
          <div class="input-group mb-3 ">
            <span class="input-group-text" id="basic-addon1"><i class="fa-sharp fa-solid fa-key"></i></i></span>
            <input type="search" class="form-control" placeholder="Rechercher un membre ..." autocomplete="off" name="Cpasswords" aria-label="Username" aria-describedby="basic-addon1">
          </div>
        </div>
      </div>

    </div>

    <table class="table bg-light mt-2">
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
        $stmt = $bdd->prepare("SELECT * FROM user WHERE etatArchivage='0'");
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

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
              


              <!--  ici nous anons le Modal Suppresion ; Les fonctions 3 dernières propriétés permettent l affichage de message quand on survole le bouton -->
              <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#modalSuppression" data-bs-placement="bottom" data-bs-toggle=" tooltip" title="Supprimer de ce membre">
              <i class="fa-solid fa-trash-can" style="color:black;"></i>
              </button>
              
          <div class="modal fade" id="modalSuppression" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">SUPPRESSION</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                Voulez-vous vraiment supprimer ce membre ?
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">NON</button>
                <button type="button" class="btn btn-danger"><a class="lien text-light" href="traitement/traitementArchivage.php?deleteid=' . $id . '">OUI</a></button>
                </div>
                </div>
            </div>
          </div>
          </div>

          <!-- ici nous avons le Modal  Modification ; Les fonctions 3 dernières propriétés permettent l affichage de message quand on survole le bouton-->
          <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#modalModification" data-bs-placement="bottom" data-bs-toggle=" tooltip" title="Modifier de ce membre">
              <i class="fa-solid fa-pen" style="color:black;"></i>
          </button>

          <div class="modal fade" id="modalModification" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">MODIFICATION</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Voulez-vous vraiment modifier ce membre ?
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">NON</button>
        <button type="button" class="btn bg-danger"><a class="lien text-light"  href="pageModification.php?updateid=' . $id . '">OUI</a> </button>
        </div>
        </div>
  </div>

          
        
        </td>
    
      </tr>';
        }


        ?>


      </tbody>
    </table>
    <!-- pagination -->
    <nav aria-label="Page navigation example" id="pagination">
      <ul class="pagination justify-content-center">
        <li class="page-item disabled "> <a class="page-link" href="#"> Précédent </a>
        </li>
        <li class="page-item active"> <a class="page-link" href="#">1</a></li>
        <li class="page-item"> <a class="page-link" href="#">2</a></li>
        <li class="page-item"> <a class="page-link" href="#">3</a></li>
        <li class="page-item"> <a class="page-link" href="#">Suivant</a></li>
      </ul>

    </nav>
  </div>

  <!-- contenu modal Profil -->
  <div class="modal fade" id="modalProfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($rows['photo']); ?>" class="rounded-circle border p-1 bg-secondary  " height="100" width="100" />

          <h5 class="modal-title ms-5" id="exampleModalLabel">PROFIL</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <span>
            Pour changer votre mot de passe, cliquer sur change
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" data-bs-target="#modalChangePasswordUser" data-bs-toggle="modal">Change</button>
          </span>
          <span>
            <br> Pour changer votre photo, cliquer sur change photo
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" data-bs-target="#modalChangePhotoUser" data-bs-toggle="modal">Photo</button>
          </span>

        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- Modal formulaire pour changer le mot de password -->
  <div class="modal fade" id="modalChangePasswordUser" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel2">Modal 2</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Hide this modal and show the first with the button below.
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Back to first</button>
        </div>
      </div>
    </div>

    <!-- Modal formulaire pour changer le photo -->
    <div class="modal fade" id="modalChangePhotoUser" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalToggleLabel2">Modal 2</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Hide this modal and show the first with the button below.
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Back to first</button>
          </div>
        </div>
      </div>


      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>