<?php

include_once('../_BDD/include.php');

if(isset($_SESSION['id_recruteur'])){
  header('Location: ../menu/index.php');
  exit;
}
if(!empty($_POST)){
  extract($_POST);

  $valid2 = (boolean) true;

  if(isset($_POST['inscriptionrecruteur'])){
    $Nomrecruteur = trim($Nomrecruteur);
    $Adresserecruteur = trim($Adresserecruteur);
    $Emailrecruteur = trim($Emailrecruteur);
    $Mdprecruteur = trim($Mdprecruteur);


    if(empty($Nomrecruteur)){
      $valid2 = false;
      $err_nomrecruteur = "Ce champ ne peut pas être vide";
    }

    if(empty($Adresserecruteur)){
      $valid2 = false;
      $err_adresserecruteur = "Ce champ ne peut pas être vide";
    }

    if(empty($Emailrecruteur)){
      $valid2 = false;
      $err_emailrecruteur = "Ce champ ne peut pas être vide";
    }else{
        $req1 = $BDD->prepare("SELECT id
        FROM recruteurs
        where Emailrecruteur = ?");

        $req1->execute(array($Emailrecruteur));
        
        $req1 = $req1->fetch();

      
    if(empty($Mdprecruteur)){
      $valid2 = false;
      $err_mdprecruteur = "Ce champ ne peut pas être vide";
    }
    if ($valid2){

      $crypt_password_rec = password_hash($Mdprecruteur, PASSWORD_ARGON2ID);

      if (password_verify($Mdprecruteur, $crypt_password_rec)){
        echo 'Le mot de passe est valide !';
      }else{
        echo 'Le mot de passe est invalide!';
      }
      $req1 = $BDD->prepare("INSERT INTO recruteurs(Nomrecruteur, Adresserecruteur, Emailrecruteur, Mdprecruteur) VALUES (?,?,?,?)");
      $req1->execute(array($Nomrecruteur, $Adresserecruteur, $Emailrecruteur, $Mdprecruteur));

      header('Location: connexion_rec.php');
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
        include_once('../menu/menu.php'); 
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
                <?php if(isset($err_nomrecruteur)){echo '<div>' . $err_nomrecruteur . '</div>';}?>
                <label class="form-label">Nom</label>
                <input class="form-control" type="text" name="Nomrecruteur" value="<?php if(isset($Nomrecruteur)){echo $Nomrecruteur;}?>" placeholder="Nom">
          </div>
          <div class="mb-3" >
                <?php if(isset($err_adresse)){echo '<div>' . $err_adresse . '</div>';}?>
                <label class="form-label">Adresse</label>
                <input class="form-control" type="text" name="Adresserecruteur" value="<?php if(isset($Adresserecruteur)){echo $Adresserecruteur;}?>" placeholder="Adresse">
          </div>
          <div class="mb-3">
                <?php if(isset($err_emailrecruteur)){echo '<div>' . $err_emailrecruteur . '</div>';}?>
                <label for="email" class="form-label">E-mail</label>
                <input class="form-control" type="text" name="Emailrecruteur" value="<?php if(isset($Emailrecruteur)){echo $Emailrecruteur;}?>" placeholder="E-mail">
          </div>
          <div class="mb-3">
                <?php if(isset($err_mdprecruteur)){echo '<div>' . $err_mdprecruteur . '</div>';}?>
                <label for="password" class="password">Mot de passe</label>
                <input class="form-control" type="password" name="Mdprecruteur" value="<?php if(isset($Mdprecruteur)){echo $Mdprecruteur;}?>" placeholder="password">
          </div>
          <div class="p-2">
                <button class="btn btn-primary" name="inscriptionrecruteur">Envoyer</button>
          </div>  
          <div>
              <a href="connexion_rec.php">Déjà inscrit</a>
          </div>      
        </form>
      </div>     
        </div>
      
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>