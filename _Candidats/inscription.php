<?php

include_once('../_BDD/include.php');


if(isset($_SESSION['id'])){
  header('Location: ../menu/index.php');
  exit;
}

if(!empty($_POST)){
    extract($_POST);

    $valid = (boolean) true;

    if(isset($_POST['inscription'])){
       $Nom = trim($Nom);
       $Prénom = trim($Prénom);
       $Email = trim($Email);
       $Mdp = trim($Mdp);

       if(empty($Nom)){
        $valid = false;
        $err_nom = "Ce champ ne peut pas être vide";
       }
       if(empty($Prénom)){
        $valid = false;
        $err_prénom = "Ce champ ne peut pas être vide";
       }
       if(empty($Email)){
        $valid = false;
        $err_email = "Ce champ ne peut pas être vide";
       }else{
        $req = $BDD->prepare("SELECT id
        FROM utilisateurs
        where email = ?");

        $req->execute(array($Email));
        
        $req = $req->fetch();

       if(empty($Mdp)){
        $valid = false;
        $err_mdp = "Ce champ ne peut pas être vide";
       }
       if ($valid){

        $crypt_password = password_hash($Mdp, PASSWORD_ARGON2ID);

        if (password_verify($Mdp, $crypt_password)){
          echo 'Le mot de passe est valide !';
        }else{
          echo 'Le mot de passe est invalide!';
        }
        $req = $BDD->prepare("INSERT INTO utilisateurs(nom, prenom, email, mdp, cv) VALUES (?,?,?,?,?)");
        $req->execute(array($Nom, $Prénom, $Email, $Mdp));

        header('Location: connexion.php');
        exit;
       }else{
          echo 'des champs du questionnaire sont manquants';
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
            <h1 class="col-md-3 mx-auto mx-auto">Formulaire d'inscription</h1>
    <form method="post">
      <div class="mb-3">
        <?php if(isset($err_nom)){echo '<div>' . $err_nom . '</div>';}?>
        <label class="form-label">Nom</label>
        <input class="form-control" type="text" name="Nom" value="<?php if(isset($Nom)){echo $Nom;}?>" placeholder="Nom">
      </div>
    <div class="mb-3" >
      <?php if(isset($err_prénom)){echo '<div>' . $err_prénom . '</div>';}?>
      <label for="firstname" class="form-label">Prénom</label>
      <input class="form-control" type="text" name="Prénom" value="<?php if(isset($Prénom)){echo $Prénom;}?>" placeholder="Prénom">
    </div>
    <div class="mb-3">
      <?php if(isset($err_email)){echo '<div>' . $err_email . '</div>';}?>
      <label for="email" class="form-label">E-mail</label>
      <input class="form-control" type="text" name="Email" value="<?php if(isset($Email)){echo $Email;}?>" placeholder="E-mail">
    </div>
    <!--
    <div class="mb-3">
      <?php if(isset($err_confirmemail)){echo '<div>' . $err_confirmemail . '</div>';}?>
      <label for="email" class="form-label">Confirmation e-mail</label>
      <input class="form-control" type="text" name="Confirmmail" value="<?php if(isset($Confirmmail)){echo $Confirmmail;}?>" placeholder="Confirmation e-mail">
    </div>
-->
    <div class="mb-3">
      <?php if(isset($err_mdp)){echo '<div>' . $err_mdp . '</div>';}?>
      <label for="password" class="password">Mot de passe</label>
      <input class="form-control" type="password" name="Mdp" value="<?php if(isset($Mdp)){echo $Mdp;}?>" placeholder="Mot de passe">
    </div>

  <!--
    <div class="mb-3">
      <?php if(isset($err_confirmmdp)){echo '<div>' . $err_confirmmdp . '</div>';}?>
      <label for="confirmation password" class="password">Confirmation mot de passe</label>
      <input class="form-control" type="password" name="Confirmmdp" value="<?php if(isset($Confirmmdp)){echo $Confirmmdp;}?>" placeholder="confirmation password">
    </div>
-->
   

    <div class="p-2">
      <button class="btn btn-primary" name="inscription">Envoyer</button>
    </div>
     
</form>
            </div>
        </div>

    </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>