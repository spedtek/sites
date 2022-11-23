<?php

include_once('../_BDD/include.php');

if(!isset($_SESSION['id'])){
  header('Location: ../menu/index.php');
  exit;
}

if(!empty($_POST)){
    extract($_POST);

    $valid5 = (boolean) true;

    if(isset($_POST['inscriptionconsultant'])){
      $Nomconsultant = trim($Nomconsultant);
      $Prénomconsultant = trim($Prénomconsultant);
      $Emailconsultant = trim($Emailconsultant);
      $Mdpconsultant = trim($Mdpconsultant);

       if(empty($Nomconsultant)){
        $valid5 = false;
        $err_nom_consultant = "1";
       }
       if(empty($Prénomconsultant)){
        $valid5 = false;
        $err_prénom_consultant = "2";
       }
       if(empty($Emailconsultant)){
        $valid5 = false;
        $err_email_consultant = "3";
       }else{
        $req4 = $BDD->prepare("SELECT id
        FROM consultants
        where email_consultant = ?");

        $req4->execute(array($Emailconsultant));
        
        $req4 = $req4->fetch();

       if(empty($Mdpconsultant)){
        $valid5 = false;
        $err_mdp_consultant = "4";
       }
       if ($valid5){

        $crypt_password = password_hash($Mdpconsultant, PASSWORD_ARGON2ID);

        if (password_verify($Mdpconsultant, $crypt_password)){
          echo '5!';
        }else{
          echo '6!';
        }
        $req4 = $BDD->prepare("INSERT INTO consultants(nom_consultant, prenom_consultant, email_consultant, mdp_consultant) VALUES (?,?,?,?)");
        $req4->execute(array($Nomconsultant, $Prénomconsultant, $Emailconsultant, $Mdpconsultant));

        header('Location: consultant.php');
        exit;
       }else{
          echo '7';
       }
    }
}
}

?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Formulaire d'inscription</title>  
    </head>

  <body>
    <?php include_once('../menu/menu.php'); ?>

    <div class="recruteur">
        <p class="p-3 mb-2 bg-warning text-dark text-center fw-bold"><a href="formulaire-recruteur.php">TNT CONSEILS </a>
        | Spécialiste du recrutement dans l'hotellerie et la restauration </p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
            <h1 class="col-md-3 mx-auto mx-auto">Formulaire d'inscription consultant</h1>
    <form method="post">
      <div class="mb-3">
        <?php if(isset($err_nom_consultant)){echo '<div>' . $err_nom_consultant . '</div>';}?>
        <label class="form-label">Nom</label>
        <input class="form-control" type="text" name="Nom" value="<?php if(isset($Nomconsultant)){echo $Nomconsultant;}?>" placeholder="Nom">
      </div>
    <div class="mb-3" >
      <?php if(isset($err_prénom_consultant)){echo '<div>' . $err_prénom_consultant . '</div>';}?>
      <label for="firstname" class="form-label">Prénom</label>
      <input class="form-control" type="text" name="Prénom" value="<?php if(isset($Prénomconsultant)){echo $Prénomconsultant;}?>" placeholder="Prénom">
    </div>
    <div class="mb-3">
      <?php if(isset($err_email_consultant)){echo '<div>' . $err_email_consultant . '</div>';}?>
      <label for="email" class="form-label">E-mail</label>
      <input class="form-control" type="text" name="Email" value="<?php if(isset($Emailconsultant)){echo $Emailconsultant;}?>" placeholder="E-mail">
    </div>
    <!--
    <div class="mb-3">
      <?php if(isset($err_confirmemail_consultant)){echo '<div>' . $err_confirmemail_consultant . '</div>';}?>
      <label for="email" class="form-label">Confirmation e-mail</label>
      <input class="form-control" type="text" name="Confirmmail" value="<?php if(isset($Confirmmail)){echo $Confirmmail;}?>" placeholder="Confirmation e-mail">
    </div>
-->
    <div class="mb-3">
      <?php if(isset($err_mdp_consultant)){echo '<div>' . $err_mdp_consultant . '</div>';}?>
      <label for="password" class="password">Mot de passe</label>
      <input class="form-control" type="password" name="Mdp" value="<?php if(isset($Mdpconsultant)){echo $Mdpconsultant;}?>" placeholder="Mot de passe">
    </div>

  <!--
    <div class="mb-3">
      <?php if(isset($err_confirmmdp)){echo '<div>' . $err_confirmmdp . '</div>';}?>
      <label for="confirmation password" class="password">Confirmation mot de passe</label>
      <input class="form-control" type="password" name="Confirmmdp" value="<?php if(isset($Confirmmdp)){echo $Confirmmdp;}?>" placeholder="confirmation password">
    </div>
-->
   

    <div class="p-2">
      <button class="btn btn-primary" name="inscriptionconsultant">Créer</button>
    </div>
     
</form>
            </div>
        </div>

    </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>