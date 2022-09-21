<?php
include_once('../_BDD/include.php');



if(isset($_SESSION['id'])){
  header('Location: admin.php');
  exit;
}

if(!empty($_POST)){
  extract($_POST);
  $valid4 = (boolean) true;

  if(isset($_POST['connexion_admin'])){
    $email_admin = trim($email_admin);
    $mdp_admin = trim($mdp_admin);

    if(empty($email_admin)){
      $valid4 = false;
      $err_email_admin = "l'email est vide";
    }else{
      $req3 = $BDD->prepare("SELECT id_admin
        FROM administrateurs
        WHERE email_admin = ?");
      
      $req3->execute(array($email_admin));
      $utilisateur_admin = $req3->fetch();

      if(!isset($utilisateur_admin['id_admin'])){
        $valid4 = false;
        $err_email_admin = "l'email est incorrect";
      }
    }
    if(empty($mdp_admin)){
      $valid4 = false;
      $err_mdp_admin = "le mot de passe est vide";

      $req3 = $BDD->prepare("SELECT id_admin
      FROM administrateurs
      WHERE email_admin = ? AND mdp_admin = ?");
    
  }

    $req3->execute(array($email_admin));
    $verif_utilisateur_admin = $req3->fetch();

    if(!isset($verif_utilisateur_admin['id_admin'])){
      $valid4 = false ; 
      $err_email_admin = "le mot de passe est incorrect";
    }
    if($valid4){
      $req3 = $BDD->prepare("SELECT *
      FROM administrateurs
      WHERE email_admin = ?");

      $req3->execute(array($email_admin));

      $verif_utilisateur_admin = $req3->fetch();

      if(isset($verif_utilisateur_admin['id_admin'])){
        $date_connexion_admin = date('Y-m-d H:i:s');

        $req3 = $BDD->prepare("UPDATE administrateur SET date_connexion_admin = ? WHERE id = ?");
        $req3->execute(array($date_connexion_admin, $verif_utilisateur_admin['id']));
      
        $_SESSION ['id'] = $verif_utilisateur_admin['id_admin'];
        $_SESSION ['Nom'] = $verif_utilisateur_admin['nom_admin'];
        $_SESSION ['email'] = $verif_utilisateur_admin['email_admin'];
  
          
        header('Location: admin.php');
        exit;
      }else{
        $valid4 = false;
        $err_email_admin = "la combinaison Email/Mot de passe est incorrect";
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
    <title>Connexion administrateur</title>  
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
              <h1 class="col-md-3 mx-auto mx-auto">
                  Se connecter 
              </h1>
              <form id="Formulaire" name="contact" method="POST" data-netlify="true">
              <div class="col-md-6 mx-auto" style="width: 500px;">
              
              <div class="mb-3">
                  <?php if(isset($err_email_admin)){echo '<div>' . $err_email_admin . '</div>';}?>
                  <label for="email" class="form-label">E-mail</label>
                  <input class="form-control" type="text" name="email_admin" value="<?php if(isset($email_admin)){echo $email_admin;}?>" placeholder="E-mail">
              </div>
              <div class="mb-3">
                  <?php if(isset($err_mdp_admin)){echo '<div>' . $err_mdp_admin . '</div>';}?>
                  <label for="password" class="password">Mot de passe</label>
                  <input class="form-control" type="password" name="mdp_admin" value="<?php if(isset($mdp_admin)){echo $mdp_admin;}?>" placeholder="Mot de passe">
              </div>
              <div class="mb-3">
                <a href="motdepasse.php">Mot de passe oublié</a>
              </div>

                <div class="p-2">
                  <button class="btn btn-primary" name="connexion_admin">Envoyer</button>
                </div>
              </div>           
              </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>