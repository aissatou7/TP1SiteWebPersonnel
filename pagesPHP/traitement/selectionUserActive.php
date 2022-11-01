<?php 
$stmt = $bdd->prepare("SELECT * FROM user WHERE etatArchivage='0'");
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

  $nom = $row['nom'];
  $prenom = $row['prenom'];
  $email = $row['email'];
  $role = $row['roleUser'];
  $matricule = $row['matricule'];
  $id = $row['id'];}
?>