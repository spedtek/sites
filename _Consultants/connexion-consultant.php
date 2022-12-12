<?php
include_once('../_BDD/include.php');



if(isset($_SESSION['id'])){
  header('Location: consultants.php');
  exit;
}

if(!empty($_POST)){
  extract($_POST);
  $valid = (boolean) true;

  if(isset($_POST['connexion_consultant'])){
    $email_consultant = trim($email_consultant);
    $mdp_consultant = trim($mdp_consultant);

    if(empty($email_consultant)){
      $valid = false;
      $err_email_consultant = "Ce champ ne peut pas être vide";
    }else{
      $req = $BDD->prepare("SELECT id
        FROM consultants
        WHERE email_consultant = ?");
      
      $req->execute(array($email_consultant));
      $consultant = $req->fetch();

      if(!isset($consultant['id'])){
        $valid = false;
        $err_email_consultant = "Ce champ ne peut pas être vide";
      }
    }
    if(empty($mdp_consultant)){
      $valid = false;
      $err_mdp_consultant = "Ce champ ne peut pas être vide";

      $req = $BDD->prepare("SELECT id
      FROM consultants
      WHERE email_consultant = ? AND mdp_consultant = ?");
    
  }

    $req->execute(array($email_consultant));
    $verif_consultant = $req->fetch();

    if(!isset($verif_consultant['id'])){
      $valid = false ; 
      $err_email_consultant = "Ce champ ne peut pas être vide";
    }
    if($valid){
      $req = $BDD->prepare("SELECT *
      FROM consultants
      WHERE email_consultant = ?");

      $req->execute(array($email_consultant));

      $verif_consultant = $req->fetch();

      if(isset($verif_consultant['id'])){
        $date_connexion = date('Y-m-d H:i:s');

        $req = $BDD->prepare("UPDATE consultants SET date_connexion = ? WHERE id = ?");
        $req->execute(array($date_connexion, $verif_consultant['id']));
      
        $_SESSION ['id'] = $verif_consultant['id'];
        $_SESSION ['nom_consultant'] = $verif_consultant['nom_consultant'];
        $_SESSION ['email_consultant'] = $verif_consultant['email_consultant'];
  
          
        header('Location: consultants.php');
        exit;
      }else{
        $valid = false;
        $err_email_consultant = "la combinaison Email/Mot de passe est incorrect";
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
    <title>Connexion</title>  
    </head>
  <body>

 
  <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a href="../menu/index.php"><img src="../images/logo.jpg" alt="logo du site" width="100" height="100"></a>    
        </div>
    </nav>

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
                  <?php if(isset($err_email_consultant)){echo '<div>' . $err_email_consultant . '</div>';}?>
                  <label for="email" class="form-label">E-mail</label>
                  <input class="form-control" type="text" name="email_consultant" value="<?php if(isset($email_consultant)){echo $email_consultant;}?>" placeholder="E-mail">
              </div>
              <div class="mb-3">
                  <?php if(isset($err_mdp_consultant)){echo '<div>' . $err_mdp_consultant . '</div>';}?>
                  <label for="password" class="password">Mot de passe</label>
                  <input class="form-control" type="password" name="mdp_consultant" value="<?php if(isset($mdp_consultant)){echo $mdp_consultant;}?>" placeholder="Mot de passe">
              </div>

                <div class="p-2">
                  <button class="btn btn-primary" name="connexion_consultant">Envoyer</button>
                </div>
              </div>           
              </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>