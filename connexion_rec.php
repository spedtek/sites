<?php
include_once('_BDD/include.php');


if(isset($_SESSION['id'])){
  header('Location: index.php');
  exit;
}

if(!empty($_POST)){
  extract($_POST);
    $valid2 = (boolean) true;

    if(isset($_POST['connexion_rec'])){
        $Emailrecruteur = trim($Emailrecruteur);
        $Mdprecruteur = trim($Mdprecruteur);

        if(empty($Emailrecruteur)){
        $valid2 = false;
        $err_emailrecruteur = "2";
        }else{
        $req1 = $BDD->prepare("SELECT id
            FROM recruteurs
            WHERE Emailrecruteur = ?");
        
        $req1->execute(array($Emailrecruteur));
        $utilisateur1 = $req1->fetch();

        if(!isset($utilisateur1['id'])){
            $valid2 = false;
            $err_emailrecruteur = "Ce champ ne peut pas être vide";
        }
        }
        if(empty($Mdprecruteur)){
        $valid2 = false;
        $err_mdprecruteur = "le mdp est faux";

        $req1 = $BDD->prepare("SELECT id
        FROM recruteurs
        WHERE Emailrecruteur = ? AND Mdprecruteur = ?");
        
    }

        $req1->execute(array($Emailrecruteur));
        $verif_utilisateur1 = $req1->fetch();

        if(!isset($verif_utilisateur1['id'])){
        $valid2 = false ; 
        $err_emailrecruteur = "le mail est faux";
        }
        if($valid2){
        $req1 = $BDD->prepare("SELECT *
        FROM recruteurs
        WHERE Emailrecruteur = ?");

        $req1->execute(array($Emailrecruteur));

        $verif_utilisateur1 = $req1->fetch();

        if(isset($verif_utilisateur1['id'])){
            $date_creation_rec = date('Y-m-d H:i:s');

            $req1 = $BDD->prepare("UPDATE recruteurs SET date_creation_rec = ? WHERE id = ?");
            $req1->execute(array($date_creation_rec, $verif_utilisateur1['id']));
        
            $_SESSION ['id'] = $verif_utilisateur1['id'];
            $_SESSION ['Nomrecruteur'] = $verif_utilisateur1['Nomrecruteur'];
            $_SESSION ['Emailrecruteur'] = $verif_utilisateur1['Emailrecruteur'];
    
            
            header('Location: index.php');
            exit;
        }else{
            $valid1 = false;
            $err_emailrecruteur = "la combinaison Email/Mot de passe est incorrect";
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
        include_once('menu/menu.php'); 
    ?>
      <div class="recruteur">
        <p class="p-3 mb-2 bg-warning text-dark text-center fw-bold"><a href="formulaire-recruteur.php">TNT CONSEILS </a>
        | Spécialiste du recrutement dans l'hotellerie et la restauration </p>
    </div>
    <div class="container">
        <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <h1>Se connecter </h1>
            <form id="Formulaire" name="contact" method="POST" data-netlify="true">
          <div>
                <?php if(isset($err_emailrecruteur)){echo '<div>' . $err_emailrecruteur . '</div>';}?>
                <label for="email" class="form-label">E-mail</label>
                <input class="form-control" type="text" name="Emailrecruteur" value="<?php if(isset($Emailrecruteur)){echo $Emailrecruteur;}?>" placeholder="E-mail">
          </div>
          <div>
                <?php if(isset($err_mdp)){echo '<div>' . $err_mdp . '</div>';}?>
                <label for="password" class="password">Mot de passe</label>
                <input class="form-control" type="password" name="Mdprecruteur" value="<?php if(isset($Mdprecruteur)){echo $Mdprecruteur;}?>" placeholder="Mot de passe">
          </div>
          <div>
            <a href="motdepasse.php">Mot de passe oublié</a>
          </div>
          <div>
            <button class="btn btn-primary" name="connexion_rec">Envoyer</button>
          </div>
        </div>
        </div>
    </div>
        
        
      </div>
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>