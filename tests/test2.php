<?php
  include('../_BDD/include.php'); // Fichier PHP contenant la connexion à votre BDD
 
  if (!isset($_SESSION['id'])){
    header('Location: profil_recruteur.php');
    exit;
  }
  
  if(!empty($_POST)){
    extract($_POST);
    $valid = true;
 
    if (isset($_POST['creer-annonce'])){
      $titre  = (string) htmlentities(trim($titre)); 
      $contenu = (string) htmlentities(trim($contenu)); 
 
      if(empty($titre)){
        $valid = false;
        $err_titre = ("Il faut mettre un titre");
      }       
  
      if(empty($contenu)){
        $valid = false;
        $er_contenu = ("Il faut mettre un contenu");
      }       
  
      //if(empty($categorie)){ 
        //$valid = false;
        //$er_categorie = "Le thème ne peut pas être vide";
      //}else{
        // On vérifit que le mail est disponible
        //$verif_cat = $BDD->query("SELECT id, titre 
          //FROM categorie 
          //WHERE id = ?",
          //array($categorie));
 
        //$verif_cat = $verif_cat->fetch();
    
        //if (!isset($verif_cat['id'])){
          //$valid = false;
          //$er_categorie = "Ce thème n'existe pas";
       // }
     // }
  
      if($valid){
        $date_creation = date('Y-m-d H:i:s');        
        $BDD->insert("INSERT INTO offres ( titre, contenu, date_creation, recruteur_id) VALUES 
          (?, ?, ?, ?)", 
          array( $titre, $contenu, $date_creation, $_SESSION['id']));
 
        header('Location: profil_recruteur');
        exit;
      }
    }
  }
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <title>Publier une offre d'emploi</title>
    <head>
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
        <div class="col-sm-12 col-md-12 col-lg-12">
          <div class="cdr-ins">
            <h1>Créer mon article</h1>
            <form method="post">
              <?php
                // S'il y a une erreur sur le nom alors on affiche
                if (isset($err_titre)){
                ?>
                  <div class="er-msg"><?= $err_titre ?></div>
                <?php   
                }
              ?>
              <div class="form-group">
                <div class="input-group mb-3">
                  <select name="categorie" class="custom-select" id="inputGroupSelect01">
                    <?php
                      if(empty($categorie)){
                      ?>
                        <option selected>Sélectionner votre thème</option>
                      <?php
                      }else{
                      ?>
                        <option value="<?= $categorie ?>"><?= $verif_cat['titre'] ?></option>
                      <?php   
                      }
 
                      $req_cat = $BDD->query("SELECT * 
                        FROM categorie");
                      $req_cat = $req_cat->fetchALL();
 
                      foreach($req_cat as $rc){
                      ?>
                        <option value="<?= $rc['id'] ?>"><?= $rc['titre'] ?></option>
                      <?php
                      }   
                    ?>
                  </select>
                </div>
              </div>
              <?php
                if (isset($er_titre)){
                ?>
                  <div class="er-msg"><?= $er_titre ?></div>
                <?php   
                }
              ?>
              <div class="form-group">
                 <input class="form-control" type="text" placeholder="Votre titre" name="titre" value="<?php if(isset($titre)){ echo $titre; }?>">   
              </div>
              <?php
                if (isset($er_contenu)){
                  ?>
                    <div class="er-msg"><?= $er_contenu ?></div>
                  <?php   
                  }
              ?>
              <div class="form-group">
                <textarea class="form-control" rows="3" placeholder="Décrivez votre article" name="contenu"><?php if(isset($contenu)){ echo $contenu; }?></textarea>
              </div>
              <div class="form-group">
                <button class="btn btn-primary" type="submit" name="creer-annonce">Envoyer</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>     
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>