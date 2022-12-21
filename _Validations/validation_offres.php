<?php

include('../_BDD/include.php');
 
  if (!isset($_SESSION['id'])){
    header('Location: index.php');
    exit;
  }
  
  $req = $BDD->query("SELECT * 
    FROM offres 
    ORDER BY id");

    $req = $req->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <title>Validation des offres</title>
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
                <div class="col-sm-0 col-md-2 col-lg-0"></div>
                <div class="col-sm-12 col-md-8 col-lg-12">

                    <div class="cdr-ins">

                        <h2>Offres d'emplois</h2>
                        <table class="table table-striped">

                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Contenu</th>
                                <th>Id_Recruteur</th>
                                <th>Date de creation</th>
                                <th>Statut</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($req as $ap){
                            ?>
                            <tr>
                            <td><?= $ap['titre'] ?></td>
                            <td><?= $ap['contenu'] ?></td>
                            <td><?= $ap['id_recruteur'] ?></td>
                            <td><?= $ap['date_creation'] ?></td>
                            <td><?= $ap['statut'] ?></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                        </table>

                        <div class="container">
                            <div class="row">
                            <div class="col-12">
                                <h2></h2>
                                <a href="chgt_statut_offres.php"><button class="btn btn-primary">Modifier le profil des offres d'emplois</button></a>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
                
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    </body>
</html>