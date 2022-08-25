<?php

include_once('_BDD/include.php');

if(isset($_SESSION['id'])){
  $var = "Bonjour" . ' ' .($_SESSION['id']) ;
}else{
  $var = "Bonjour à tous";
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
    <div class="recruteur">
        <p class="p-3 mb-2 bg-warning text-dark text-center fw-bold"><a href="formulaire-recruteur.php">Vous recrutez </a>
        | BÉNÉFICIEZ DE NOS TARIFS DÉDIÉS AUX NOUVEAUX CLIENTS POUR VOS OFFRES D'EMPLOI  </p>
    </div>
    <?php
        include_once('menu/menu.php');
    ?>
    <div class="row">
      <div class="col-3"> <img src="recrut1.jpg" class="img-fluid rounded-start" alt="..."></div>
      <div class="card-body col-9"></div>   
    </div>
  <h1>
    <?= $var ?>
  </h1>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>