<?php

  include_once('../_BDD/include.php');

  
  if (!isset($_SESSION['id'])){
    header('Location: ../menu/index.php'); 
    exit;
}

if(!empty($_POST)){
extract($_POST);
$valid = true;

if (isset($_POST['creation_consultant'])){

// Récupération de nos différents champs
$nom_consultant = htmlentities(trim($nom_consultant));
$prenom_consultant = htmlentities(trim($prenom_consultant));
$email_consultant = htmlentities(trim($email_consultant));
$mdp_consultant = htmlentities(trim($mdp_consultant));

if(empty($nom_consultant)){
$valid = false;
$er_nom_consultant = ("Il faut mettre un nom");
}
if(empty($prenom_consultant)){
$valid = false;
$er_prenom_consultant = ("Il faut mettre un prenom");
}
if(empty($email_consultant)){
  $valid = false;
  $er_email_consultant = ("Il faut mettre un email valide");
  }else{
    $req = $BDD->prepare("SELECT id
        FROM consultants
        WHERE email_consultant = ?");
    
    $req->execute(array($email_consultant));
  
    $req = $req->fetch();
  
    if(empty($mdp_consultant)){
      $valid = false;
      $er_mdp_consultant = ("Il faut mettre un mot de passe provisoire ");
    
      $req = $BDD->prepare("SELECT id
      FROM consultants
      WHERE email_consultant = ? AND mdp_consultant = ?");
    
      }
    
      if($valid){
      $req = $BDD->prepare("SELECT *
      FROM consultants
      WHERE email_consultant = ?");
    
  $req = $BDD->prepare("INSERT INTO consultants (nom_consultant, prenom_consultant, email_consultant, mdp_consultant) VALUES
  (?, ?, ?, ?)");
  $req->execute(array($nom_consultant, $prenom_consultant, $email_consultant, $mdp_consultant));

  header('Location: admin.php');
  exit;
  }
}
}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <base href="/"/>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Créer mon article</title>
  </head>
  <body>
    <?php
      include_once('menu-admin.php');    
    ?>
     <div class="recruteur">
        <p class="p-3 mb-2 bg-warning text-dark text-center fw-bold"><a href="formulaire-recruteur.php">TNT CONSEILS </a>
        | Spécialiste du recrutement dans l'hotellerie et la restauration </p>
    </div>

    <div class="container">
        <div class="row">	
        <div class="col-sm-0 col-md-0 col-lg-0"></div>
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="cdr-ins">

                <h1 style="text-align:center;">Créer un consultant</h1>

            <form method="post">
 
              
                <div class="form-group" style="margin-top:10px;">
                <label class="form-label">Nom</label>
            	 <input class="form-control" type="text" placeholder="Nom" name="nom_consultant" value="<?php if(isset($nom_consultant)){ echo $nom_consultant; }?>">

               <?php
                if (isset($er_nom_consultant)){
                ?>
                <div class="er-msg" style="color: red;"><?= $er_nom_consultant ?></div>
                <?php
                }
            ?>
                </div>

                </div>
                <div class="form-group" style="margin-top:10px;">
                <label class="form-label">Prenom</label>
            	 <input class="form-control" type="text" placeholder="Prénom" name="prenom_consultant" value="<?php if(isset($prenom_consultant)){ echo $prenom_consultant; }?>">

               <?php
                if (isset($er_prenom_consultant)){
                ?>
                <div class="er-msg" style="color: red;"><?= $er_prenom_consultant ?></div>
                <?php
                }
            ?>
              </div>
                <div class="form-group" style="margin-top:10px;">
                <label class="form-label">Email</label>
            	 <input class="form-control" type="email" placeholder="Email" name="email_consultant" value="<?php if(isset($email_consultant)){ echo $email_consultant; }?>">

               <?php
                if (isset($er_email_consultant)){
                ?>
                <div class="er-msg" style="color: red;"><?= $er_email_consultant ?></div>
                <?php
                }
            ?>
                </div>

                <div class="form-group" style="margin-top:10px;">
                <label class="form-label">Mot de passe provisoire</label>
            	 <input class="form-control" type="mdp" placeholder="Mot de passe" name="mdp_consultant" value="<?php if(isset($mdp_consultant)){ echo $mdp_consultant; }?>">
                </div>
                <?php
                if (isset($er_nom_consultant)){
                ?>
                <div class="er-msg" style="color: red;"><?= $er_mdp_consultant ?></div>
                <?php
                }
            ?>



                <div class="form-group" style="margin-top:10px;">
                <button class="btn btn-primary" type="submit" name="creation_consultant">Envoyer</button>
                </div>

                </form>
                </div>
            </div>  

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

  </body>
</html>