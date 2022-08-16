<?php
include_once('_BDD/co-bdd.php');



if(!empty($_POST)){
    extract($_POST);

    if(isset($_POST['inscription'])){
        echo 'ok';
    }else{
        echo 'veuillez renseigner les informations manquantes';
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
    <?php include_once('menu/menu.php'); ?>

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
        <label class="form-label">Nom</label>
        <input class="form-control" type="text" value="" placeholder="Nom">
      </div>
    <div class="mb-3" >
      <label for="firstname" class="form-label">Prénom</label>
      <input class="form-control" type="text" value="" placeholder="Prénom">
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">E-mail</label>
      <input class="form-control" type="text" value="" placeholder="E-mail">
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Confirmation e-mail</label>
      <input class="form-control" type="text" value="" placeholder="Confirmation e-mail">
    </div>
    <div class="mb-3">
      <label for="password" class="password">Mot de passe</label>
      <input class="form-control" type="text" value="" placeholder="password">
    </div>
    <div class="mb-3">
      <label for="confirmation password" class="password">Confirmation mot de passe</label>
      <input class="form-control" type="text" value="" placeholder="confirmation password">
      
    </div>
    <div class="mb-3">
      <label for="formFile" class="form-label">Télécharger mon CV</label>
      <input class="form-control" type="file" value="" placeholder="télécharger votre CV">
    </div>
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