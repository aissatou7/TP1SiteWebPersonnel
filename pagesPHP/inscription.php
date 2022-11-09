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
    <div class="container w-50" id="containerFormInscription">

        <!-- card(carte) header -->
        <div class="header text-center p-3 text-white cardHeaderCSS ">
            <h3> CONNEXION</h3>
        </div>    

            <form id="form"  novalidate enctype="multipart/form-data">
                <!--  novalidate pour la validation du format de l'email (FILTER_VAR($_POST['email'] FILTER_VALIDATE_EMAIL)) -->
                <div class="form-control mt-3 d-flex-wrap">
                    <label >Nom</label><br>
                    <i class="fas fa-check-circle position-absolute " ></i>
                    <i class="fas fa-exclamation-circle position-absolute" ></i>                    
                    <input type="text" id="nom" class="w-100 p-2" placeholder="Entrez votre nom" autocomplete="on" name="nom" ><br>
                    <small  >Nom invalide</small>
                </div>
            
                <div class="form-control mt-3 d-flex-wrap">
                    <label >Prenom</label><br>
                    <i class="fas fa-check-circle position-absolute " ></i>
                    <i class="fas fa-exclamation-circle position-absolute"  ></i>                    
                    <input type="text" id="prenom" class="w-100 p-2" placeholder="Entrez votre prenom" autocomplete="on" name="prenom" ><br>
                    <small  >Prenom invalide</small>
                </div>

                <div class="form-control mt-3 d-flex-wrap">
                    <label >Email</label><br>
                    <i class="fas fa-check-circle position-absolute " ></i>
                    <i class="fas fa-exclamation-circle position-absolute"  ></i>                    
                    <input type="text" id="email" class="w-100 p-2" placeholder="Entrez votre email" autocomplete="on" name="email" ><br>
                    <small  >Email invalide</small>
                </div>
                
                <div class="form-control mt-3 d-flex-wrap">
                    <label >role</label><br>
                    <i class="fas fa-check-circle position-absolute " ></i>
                    <i class="fas fa-exclamation-circle position-absolute"  ></i>                    
                    <select select id="role" class="form-select" name="roleUser" aria-label="Default select example">
                        <option selected>Entrez votre role</option>
                        <option value="Administrateur">Administrateur</option>
                        <option value="Utilisateur">Utilisateur</option>
                    </select>                 
                    <small  >role invalide</small>
                </div>

                <div class="form-control mt-3 d-flex-wrap">
                    <label >Mot de passe</label><br>
                    <i class="fas fa-check-circle position-absolute " ></i>
                    <i class="fas fa-exclamation-circle position-absolute"  ></i>                    
                    <input type="text" id="passwords" class="w-100 p-2" placeholder="Entrez votre mot de passe" autocomplete="on" name="passwords" ><br>
                    <small  >Mot de passe invalide</small>
                </div>

                
                <div class="form-control mt-3 d-flex-wrap">
                    <label >Confirmation mot de passe</label><br>
                    <i class="fas fa-check-circle position-absolute " ></i>
                    <i class="fas fa-exclamation-circle position-absolute"  ></i>                    
                    <input type="text" id="Cpasswords" class="w-100 p-2" placeholder="Entrez votre mot de passe" autocomplete="on" name="Cpasswords" ><br>
                    <small  >Mot de passe non conforme</small>
                </div>

               <div class="form-control  mt-3" >
                  <input type="file" name="image"  value="" accept=".jpg, .png, .jpeg" >
                </div>
              
                <button type="submit" name="valider" class="mt-4 p-1 w-100" style="background-color:#2A7282 ; color:white;"> Envoyer</button>

            </form>
        <!-- card(carte) footer -->
        <div class="card-footer  mt-3 p-3 cardFooterCSS">
            J'ai dèjà un compte. <a href="index.php" class="lien" style="color:#2A7282 ;"> Me connecter?</a>
        </div>
        <script>
            const form=document.getElementById('form');
            const nom=document.getElementById('nom');
            const prenom=document.getElementById('prenom');
            const email=document.getElementById('email');
            const role=document.getElementById('role');
            const passwords=document.getElementById('passwords');
            const Cpasswords=document.getElementById('Cpasswords');
            
            form.addEventListener('submit',(e) => {
                e.preventDefault();
                checkInputs();
            });
            

     function checkInputs(){
        // recupèration des valeurs des inputs
        const nomValue=nom.value.trim();    //la fonction trim()permet d'éliminer les espace avent la saisie de caractères
        const prenomValue=prenom.value.trim();
        const emailValue=email.value.trim();
        const roleValue=role.value.trim();
        const passwordsValue=passwords.value.trim();
        const CpasswordsValue=Cpasswords.value.trim();
        
        //ici nous alons gérer quand afficher les messages d'erreur ou de succes
        if (nomValue === '') {
            //recherche erreur
            //Ajout de la classe error
            setErrorFor(nom,'Veuillez renseigner le nom !');
        }else{
            //ajout de la class success  
            // setSuccessFor(nom);
        }
        if (prenomValue === '') {
            //recherche erreur
            //Ajout de la classe error
            setErrorFor(prenom,'Veuillez renseigner le prenom !');
        }else{
            //ajout de la class success  
            // setSuccessFor(prenom);
        }
    }
    //définition de la fonction setErrorFor()
    function setErrorFor(input,message){
        const formControl = input.parentElement; // recupèration de .form-control dont input est le parent
        const small = formControl.querySelector('small');
            //ajout du message d'erreur 
            small.innerText = message; 
            //ajout de la classe error
            formControl.className = 'form-control error';
        }

        
        
        
    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
<style>
    /* css des icônes, par défaut */
.form-control i{
    margin-top:1% ; 
    margin-left: 42%; 
    visibility: hidden ; 
}
.form-control small{
    visibility: hidden;
    position: absolute;
}
/* css des inputs et icônes en cas de succes de la saisie */
.form-control.success input{
    border-color: #2ecc71;
}
.form-control.success i.fa-check-circle{
    color: #2ecc71;
    visibility: visible;
}
.form-control.error small{
    color: #2ecc71 ;
    visibility: visible;
    position: relative;
} 

/* css des inputs et icônes en cas d'erreur de la saisie */

.form-control.error input{
    border-color: #e74c3c;
}
.form-control.error  i.fa-exclamation-circle{
    color: #e74c3c;
    visibility: visible;
}
.form-control.error small{
    color: #e74c3c;
    visibility: visible;
    position: relative;
}

</style>

