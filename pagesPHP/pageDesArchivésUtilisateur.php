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

  <title>Page Adminostrateur</title>
</head>

<body>
  <div class="container bg-light mt-5">
     <!-- entête contenant la photo, un message et bouton de déconnexion -->
     <div class="row">
      <div class="col-2">

        <!-- entête contenant la photo / Modal change role  -->
            <!-- Ici la photo de profil est inserrer dans un bouton Modal. Les 3 dernières propriétés permettent l'affichage d'un message (Votre profil) au survole   -->
        <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#modalProfil" data-bs-placement="bottom" data-bs-toggle=" tooltip" title="Votre profil">
          <!-- Recupèration de la photo à la base de données -->
          <?php
          $state = $bdd->prepare("SELECT * FROM image");
          $state->execute();
          $rows = $state->fetch();
          ?>
          <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($rows['photo']); ?>" class="rounded-circle border p-1 bg-secondary  " height="100" width="100" />

        </button>
        <span> MAF0001</span>
      </div>

      <div class="col-2">

      </div>


    </div>
    <!-- Ici nous avons les liens sur la page inscription et la liste des archivés -->
    <div class="row">
      <div class="row  d-flex align-items-center ">
        <div class="col-2 ">
        <button class="btn  mt-5"><a href="pageDesActives.php" class="lien">Retour</a></button>
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