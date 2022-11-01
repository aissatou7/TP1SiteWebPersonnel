<?php
include('connect.php');
include('traitement/selectionUserActive.php');

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

  <title>Page Adminostrateur</title>
</head>

<body>
  <div class="containerTable bg-light mt-5">
    <!-- entête contenant la photo, un message et bouton de déconnexion -->
    <div class="row ">
      <div class="col-2">

        <!-- entête contenant la photo / Modal change role  -->
        <!-- Ici la photo de profil est inserrer dans un bouton Modal. Les 3 dernières propriétés permettent l'affichage d'un message (Votre profil) au survole   -->
        <button type="button" class="btn ms-4" data-bs-toggle="modal" data-bs-target="#modalProfil" data-bs-placement="bottom" data-bs-toggle=" tooltip" title="Votre profil">
          <!-- Recupèration de la photo à la base de données -->
          <?php
          $state = $bdd->prepare("SELECT * FROM image");
          $state->execute();
          $rows = $state->fetch();
          ?>
          <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($rows['photo']); ?>" class="rounded-circle border p-1 bg-secondary   " height="100" width="100" />

        </button>
        
        <span class="ms-5"> <?php echo $matricule; ?></span>
      </div>
      <!-- Ici nous gére la déconnexion de la session avec un messae au survole-->
      <div class="col-9 ">
          <button class="btn w-25" style="margin: 5% 80%; " data-bs-placement="bottom" data-bs-toggle=" tooltip" title="Déconnexion"><a href="pageDéconnexion.php" class="lien"><i class="fa-solid fa-right-from-bracket fa-2x" ></i></a></button>
        </div>



    </div>
    <button class="btn  mt-5"><a href="pageDesActives.php" class="lien">Retour</a></button>

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
      $stmt = $bdd->prepare("SELECT * FROM user WHERE etatArchivage='1'");
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
        
        <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#modalDéarchivage">
        <span class="material-symbols-outlined" style="color:black;">restore_from_trash</span>
        </button>
       
        <!-- Modal change role -->

        <div class="modal fade" id="modalDéarchivage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Déarchivage</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
              Voulez-vous vraiment déarchiver ce membre ?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">NON</button>
                <button type="button" class="btn btn-danger"><a class="lien text-light" href="traitement/traitementDéarchivage.php?deleteid=' . $id . '" >OUI</a></button>
              </div>
            </div>
          </div>
        </div>
          </div>
        </td>
    
      </tr>';
        }
      
      ?>
    </tbody>
    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>