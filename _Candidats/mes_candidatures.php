<?php
   require_once('../_BDD/include.php'); 
    
    if(!isset($_SESSION['id'])){ 
        header('Location: ../menu/index.php'); 
        exit; 
    }

    $candidature = $BDD->query('SELECT *
    FROM offres
    WHERE id = ?')
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <title>Offres</title>  
    </head>
    <body>
        <div class="recruteur">
            <p class="p-3 mb-2 bg-warning text-dark text-center fw-bold"><a href="../_Recruteurs/formulaire-recruteur.php">Vous recrutez </a>
            | BÉNÉFICIEZ DE NOS TARIFS DÉDIÉS AUX NOUVEAUX CLIENTS POUR VOS OFFRES D'EMPLOI  </p>
        </div>
        <?php
            include_once('../menu/menu.php');
        ?>
      
        
        <div class="container">
            <div class="row">
                <?php
                foreach ($candidature as $c);
                ?>
                <div class="col-sm-12 col-md-12 col-lg-12"></div>
                    <h2>Voici le profil de <?= $candidature['titre'] ?></h2><div>Quelques informations sur lui : </div>
                    <ul>
                    <li>Votre id est : <?=$candidature['id'] ?></li>            
                    <li>Votre mail est : <?= $candidature['contenu'] ?></li> 
                    <li>Votre compte a été crée le : <?= $candidature['date_creation'] ?></li>             
                    </ul>                   
            </div>
        </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>