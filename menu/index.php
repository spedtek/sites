<?php

include_once('../_BDD/include.php');


if(isset($_SESSION['id'])){
  $var = "Bonjour " . $_SESSION['Nom'] ;
}else{
  $var = "Bonjour à tous";
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
    
  
    <div class="recruteur">
        <p class="p-3 mb-2 bg-warning text-dark text-center fw-bold"><a href="../_Recruteurs/inscription_rec.php">Vous recrutez </a>
        | BÉNÉFICIEZ DE NOS TARIFS DÉDIÉS AUX NOUVEAUX CLIENTS POUR VOS OFFRES D'EMPLOI  </p>
             
    <?php
        include_once('menu.php');
    ?>
    </div>
    </head>
    <body>
    <div style="text-align: center;">
          <h1> <?= $var ?> </h1>
    </div>
      
      <div class="card-body col-12" ></div>   
        <div class="container text-center">
          <div class="row align-items-start">
            <div class="col">
              <div class="partie1">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="container text-center">
        <div class="row justify-content-md-center">
          <div class="col">  
          <a class="btn btn-primary" href="../_Consultants/consultants.php" role="button">Acces réservé aux consultants</a>
          </div>
          <div class="col">
            <a class="btn btn-primary" href="../_Administrateur/connexion_admin.php" role="button">Acces réservé aux administrateurs</a>
          </div>

        </div>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>