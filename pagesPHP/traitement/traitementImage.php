<!-- // Recuperation images -->

<?php
session_start();
if (isset($_POST['valider'])){
/*   var_dump($_FILES);die;
*/
//ici on verifie si la session de l'utilisateur qui s'est connecté existe
if (isset($_SESSION['id'])) {
$id = $_SESSION['id'];
}
if(!empty($_FILES["image"]["name"])) { 
// Get file info 
$fileName = basename($_FILES["image"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION); 

// Allow certain file formats 
$allowTypes = array('jpg','png','jpeg','gif'); 
if(in_array($fileType, $allowTypes)){ 
    $image = $_FILES['image']['tmp_name']; 
    $imgContent = addslashes(file_get_contents($image)); 

    // Insert image content into database 
    // $db = new PDO('mysql:host=localhost;dbname=test;charset=UTF8', 'root', '');
    $getImage = $bdd->query("SELECT photo FROM image WHERE user=$id"); 
    if ($getImage) {
        $bdd->query("DELETE FROM images WHERE user=$id");
    }
    $insert = $bdd->query("INSERT into image (photo,user) VALUES ('$imgContent',$id)"); 


    if($insert){ 
        $status = 'success'; 
        $statusMsg = "File uploaded successfully."; 
        // header('location:editProfile.php');
    }else{ 
        $statusMsg = "File upload failed, please try again."; 
    }
}else{ 
    $statusMsg = 'Désolé, seule les fichiers JPG, JPEG, PNG, & GIF sont autorisés.'; 
} 
}else{ 
$statusMsg = 'Veillez selectionner une image'; 
}
}

?>