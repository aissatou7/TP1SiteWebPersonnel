<?php
include('connect.php');
include('traitement/traitementConnexion.php');


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
  <div class="container bg-light mt-5">
   <!-- entête contenant la photo, un message et bouton de déconnexion -->
   <div class="row ">
      <div class="col-2">

        <!-- entête contenant la photo / Modal change role  -->
        <!-- Ici la photo de profil est inserrer dans un bouton Modal. Les 3 dernières propriétés permettent l'affichage d'un message (Votre profil) au survole   -->
        <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#modalProfil" data-bs-placement="bottom" data-bs-toggle=" tooltip" title="Votre profil">
          <!-- Recupèration de la photo à la base de données -->
          <?php
          $state = $bdd->prepare("SELECT * FROM image");
          $state->execute();
          $rows = $state->fetch(PDO::FETCH_ASSOC);
          ?>
          <!-- ici nous avons l'image du profil -->
          <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($rows['photo']); ?>" class="rounded-circle border p-1 bg-secondary   " height="100" width="100" />
          <!-- Ici nous avons le matricule de la personne connectée -->
          <h4><?php echo$_SESSION['Utilisateur_matricule'] ?></h4>
        </button>
      </div>



      <!-- Message de bienvenue -->
      <div class="col-7  d-flex justify-content-center align-items-center">
      <h1 style="color: #2A7282;"> Bienvenue <?php echo$_SESSION['Utilisateur_prenom'].' '.$_SESSION['Utilisateur_nom'] ?></h1>
      </div>
      



      
      <!-- Ici nous gére la déconnexion de la session avec un messae au survole-->
      <div class="col-3 d-flex justify-content-center align-items-center">
          <button class="btn w-25" data-bs-toggle="modal" data-bs-target="#modalDéconnexion" data-bs-placement="bottom" data-bs-toggle=" tooltip" title="Déconnexion"><i class="fa-solid fa-right-from-bracket fa-2x" style="color: #2A7282;" ></i></button>
      </div>

      <p class="align-items-center justify-content-center">-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</p>

    </div>
    <!-- Ici nous avons les liens sur la page inscription et la liste des archivés -->
    <div class="row mt-4">
      <div class="row  d-flex align-items-center ">
       


        <div class="col-5">
          <button class="btn "><a href="pageDesActives.php" class="lien"  style="color: #2A7282;">Retour</a></button>
        </div>

        <!-- Ici nous avons la barre de recherche -->
        <div class="col-5  ">
          
            <form action="" method="POST" class="d-flex">
              <input type="search" name="recherche" class="form-control" placeholder="Rechercher un membre ..." autocomplete="off" aria-label="Username" aria-describedby="basic-addon1">
              <button type="submit" class="input-group-text" id="basic-addon1"style="background-color: #2A7282;"><i class="fa-sharp fa-solid fa-key"style="color: white; size:2%" ></i></button>
            </form>
         
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
        
      </tr>';
        }
      
      ?>
    </tbody>
    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>