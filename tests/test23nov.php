if(isset($_SESSION['id'])){


}
if(!empty($_POST)){
  extract($_POST);

  $valid3 = (boolean) true;

  if(isset($_POST['publieroffre'])){
    $Titre = trim($Titre);
    $Contenu = trim($Contenu);
  
    if(empty($Titre)){
      $valid = false;
      $err_Titre = "Ce champ ne peut pas être vide";
    }

    if(empty($Contenu)){
      $valid = false;
      $err_Contenu = "Ce champ ne peut pas être vide";
    }
  }
  if ($valid3){
    $date_creation = date('Y-m-d H:i:s'); 
    $req = $BDD->prepare("INSERT INTO offres(titre, contenu, date_creation) VALUES (?,?,?)");
    $req->execute(array($Titre, $Contenu, $date_creation));

    header('Location: profil_recruteur.php');
    exit;
    }else{
    echo 'des champs du questionnaire sont manquants';
    }

  }

?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <title>Publier une offre d'emploi</title>
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
          <h1 style="text-align:center">Créer une offre d'emploi</h1>
          <form method="POST">

              <div>
                      <?php if(isset($err_Titre)){echo '<div>' . $err_Titre . '</div>';}?>
                      <label class="form-label">Titre</label>
                      <input class="form-control" type="text" name="titre" value="<?php if(isset($err_Titre)){echo $err_Titre;}?>" placeholder="Titre">
              </div>
              <div>
                      <?php if(isset($err_Contenu)){echo '<div>' . $err_Contenu . '</div>';}?>
                      <label class="form-label">Contenu</label>
                      <input class="form-control" type="text" name="contenu" value="<?php if(isset($err_Contenu)){echo $err_Contenu;}?>" placeholder="Contenu">
              </div>
              <div class="p-2">
                <button class="btn btn-primary" name="publieroffre">Publier mon offre </button>
              </div>  


          </form>