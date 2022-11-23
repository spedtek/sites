<?php

include_once('../_BDD/include.php');

if(isset($_SESSION['id'])){
  header('Location: ../menu/index.php');
  exit;
}
if(!empty($_POST)){
  extract($_POST);

  $valid3 = (boolean) true;

  if(isset($_POST['inscriptionconsultant'])){
    $Nomconsultant = trim($Nomconsultant);
    $Adresseconsultant = trim($Adresseconsultant);
    $Emailconsultant = trim($Emailconsultant);
    $Mdpconsultant = trim($Mdpconsultant);


    if(empty($Nomconsultant)){
      $valid3 = false;
      $err_nomconsultant = "Ce champ ne peut pas être vide";
    }

    if(empty($Adresseconsultant)){
      $valid3 = false;
      $err_adresseconsultant = "Ce champ ne peut pas être vide";
    }

    if(empty($Emailconsultant)){
      $valid3 = false;
      $err_emailconsultant = "Ce champ ne peut pas être vide";
    }else{
        $req2 = $BDD->prepare("SELECT id
        FROM consultants
        where emailconsultant = ?");

        $req2->execute(array($Emailconsultant));
        
        $req2 = $req2->fetch();

      
    if(empty($Mdpconsultant)){
      $valid3 = false;
      $err_mdpconsultant = "Ce champ ne peut pas être vide";
    }
    if ($valid3){

      $crypt_password_can = password_hash($Mdpconsultant, PASSWORD_ARGON2ID);

      if (password_verify($Mdpconsultant, $crypt_password_con)){
        echo 'Le mot de passe est valide !';
      }else{
        echo 'Le mot de passe est invalide!';
      }
      $req2 = $BDD->prepare("INSERT INTO consultants(Nomconsultant, Adresseconsultant, Emailconsultant, Mdpconsultant) VALUES (?,?,?,?)");
      $req2->execute(array($Nomconsultant, $Adresseconsultant, $Emailconsultant, $Mdpconsultant));

      header('Location: connexion_con.php');
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
    <title>Accueil</title>  
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
        <div class="col-3"></div>    
        <div class="col-6">
        <h1>Formulaire d'inscription </h1>
        <form method="post">
          <div>
                <?php if(isset($err_nomconsultant)){echo '<div>' . $err_nomconsultant . '</div>';}?>
                <label class="form-label">Nom</label>
                <input class="form-control" type="text" name="Nomconsultant" value="<?php if(isset($Nomconsultant)){echo $Nomconsultant;}?>" placeholder="Nom">
          </div>
          <div class="mb-3" >
                <?php if(isset($err_adresseconsultant)){echo '<div>' . $err_adresseconsultant . '</div>';}?>
                <label class="form-label">Adresse</label>
                <input class="form-control" type="text" name="Adresseconsultant" value="<?php if(isset($Adresseconsultant)){echo $Adresseconsultant;}?>" placeholder="Adresse">
          </div>
          <div class="mb-3">
                <?php if(isset($err_emailconsultant)){echo '<div>' . $err_emailconsultant . '</div>';}?>
                <label for="email" class="form-label">E-mail</label>
                <input class="form-control" type="text" name="Emailconsultant" value="<?php if(isset($Emailconsultant)){echo $Emailconsultant;}?>" placeholder="E-mail">
          </div>
          <div class="mb-3">
                <?php if(isset($err_mdpconsultant)){echo '<div>' . $err_mdpconsultant . '</div>';}?>
                <label for="password" class="password">Mot de passe</label>
                <input class="form-control" type="password" name="Mdpconsultant" value="<?php if(isset($Mdpconsultant)){echo $Mdpconsultant;}?>" placeholder="password">
          </div>
          <div class="p-2">
                <button class="btn btn-primary" name="inscriptionconsultant">Envoyer</button>
          </div>  
          <div>
              <a href="connexion_con.php">Déjà inscrit</a>
          </div>      
        </form>
      </div>     
        </div>
      
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>