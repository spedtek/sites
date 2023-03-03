<?php

include_once('../_BDD/include.php');

if(isset($_SESSION['id'])){
  header('Location: profil.php');
  exit;
}

if(!empty($_POST)){
  extract($_POST);
  $valid = (boolean) true;

  if(isset($_POST['connexion'])){
    $Email = trim($Email);
    $Mdp = trim($Mdp);

    if(empty($Email)){
      $valid = false;
      $err_email = "Ce champ ne peut pas être vide";
    }else{
      $req = $BDD->prepare("SELECT id
        FROM utilisateurs
        WHERE email = ?");
      
      $req->execute(array($Email));
      $ulisateur = $req->fetch();

      if(!isset($ulisateur['id'])){
        $valid = false;
        $err_email = "Ce champ ne peut pas être vide";
      }
    }
    if(empty($Mdp)){
      $valid = false;
      $err_mdp = "Ce champ ne peut pas être vide";

      $req = $BDD->prepare("SELECT id
      FROM utilisateurs
      WHERE email = ? AND mdp = ?");
    
  }

    $req->execute(array($Email));
    $verif_utilisateur = $req->fetch();

    if(!isset($verif_utilisateur['id'])){
      $valid = false ; 
      $err_email = "Ce champ ne peut pas être vide";
    }
    if($valid){
      $req = $BDD->prepare("SELECT *
      FROM utilisateurs
      WHERE email = ?");

      $req->execute(array($Email));

      $verif_utilisateur = $req->fetch();

      if(isset($verif_utilisateur['id'])){
        $date_connexion = date('Y-m-d H:i:s');

        $req = $BDD->prepare("UPDATE utilisateur SET date_connexion = ? WHERE id = ?");
        $req->execute(array($date_connexion, $verif_utilisateur['id']));
      
        $_SESSION ['id'] = $verif_utilisateur['id'];
        $_SESSION ['Nom'] = $verif_utilisateur['nom'];
        $_SESSION ['email'] = $verif_utilisateur['email'];
  
          
        header('Location: ../_Candidats/profil.php');
        exit;
      }else{
        $valid = false;
        $err_email = "la combinaison Email/Mot de passe est incorrect";
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
    <link rel="stylesheet" href="https://cdnjs.coudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link href="asset/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="asset/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Accueil</title>  
    
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a href="../menu/index.php"><img src="../images/logo.jpg" alt="logo du site" width="100" height="100"></a>    
        </div>
    </nav>


    <div class="recruteur">
        <p class="p-3 mb-2 bg-warning text-dark text-center fw-bold"><a href="../_Recruteurs/inscription_rec.php">Vous recrutez </a>
        | BÉNÉFICIEZ DE NOS TARIFS DÉDIÉS AUX NOUVEAUX CLIENTS POUR VOS OFFRES D'EMPLOI  </p>
    </div>
    </head>
    <body>
        <div style="text-align: center; margin-bottom: 30px;">
              <h1>TRT CONSEILS</h1>
        </div>
        <div class="container text-center">
          <div class="row justify-content-between">
            <div class="col-4" style="margin: 8%; padding: 5%; text-align:center; font-size: 2em; border-radius:50px; background-color: #f8c916;">
            Le site de référence <br/>pour les métiers de <br/>la restauration et l'hotellerie
            </div>
            <div class="col-4" style="margin: 4%; padding: 5%; font-size: 30px;">
            
            <form id="Formulaire" name="contact" method="POST" data-netlify="true">
              <div class="col-md-6 mx-auto" style="width: 500px;">
              <h2 style="text-align: center;">Se connecter</h2>
              <div class="mb-3">
                  <?php if(isset($err_email)){echo '<div>' . $err_email . '</div>';}?>
                  <label for="email" class="form-label">E-mail</label>
                  <input class="form-control" type="text" name="Email" value="<?php if(isset($Email)){echo $Email;}?>" placeholder="E-mail">
              </div>
              <div class="mb-3">
                  <?php if(isset($err_mdp)){echo '<div>' . $err_mdp . '</div>';}?>
                  <label for="password" class="password">Mot de passe</label>
                  <input class="form-control" type="password" name="Mdp" value="<?php if(isset($Mdp)){echo $Mdp;}?>" placeholder="Mot de passe">
              </div>
              <div class="p-2">
                  <button class="btn btn-primary" name="connexion">Se connecter</button>
                </div>
              <div class="mb-3">
                <a href="../_Candidats/inscription.php">Créer un compte</a>
              </div>


              </div>           
              </form>
            </div>
          </div>
        </div>
-->
        <div class="container text-center" style="margin-top: -20px;">
          <div class="row justify-content-md-center">
            <div class="col">  
            <a class="btn btn-primary" href="../_Consultants/connexion-consultant.php" role="button">Acces réservé aux consultants</a>
            </div>
            <div class="col">
            <a class="btn btn-primary" href="../_Administrateur/connexion_admin.php" role="button">Espace admin</a>
            </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>