<?php

    include_once('../_BDD/include.php');

    $req = $BDD->query("SELECT *
    FROM offres
    ORDER BY date_creation");

    $req = $req->fetchAll();
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
                        
                        <div class="col-sm-0 col-md-0 col-lg-0"></div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="cdr-ins">

                            <h1 style="text-align : center">Les offres d'emploi</h1>

                            <?php
                                if(isset($_SESSION['id'])){
                            ?>
                                <a href="publier_annonce.php"><button type="button" class="btn btn-primary">Publier une offre d'emploi</button></a>
                                <?php
                                }
                                ?>
                                                   <?php
                        if(isset($_SESSION['id'])){

                            foreach($req as $r){
                    ?>



                           

                            <div style="margin-top: 10px; background: white; box-shadow: 0 5px 10px rgba(0, 0, .09); padding: 5px 10px; border-radius: 10px">
                            <a href="Les offres/<?= $r['id'] ?>" style="color: #666; text-decoration: none; font-size: 28px;"><?= $r['titre'] ?></a>
                            <div style="border-top: 2px solid #EEE; padding-top: 15px">
                                <?= $r['Nomrecruteur']; ?>
                            </div>
                            <div style="border-top: 2px solid #EEE; padding-top: 15px; text-align: right">
                                <?= $r['contenu']; ?>
                            </div>
                            <div style="border-top: 2px solid #EEE; padding-top: 15px; text-align: right">
                                <?= $r['date_creation']; ?>
                            </div>
                            <div>
                                <a class="btn btn-primary" href="mes_candidatures.php" role="button">Postuler</a>
                            </div>
                        </div>                  
                        <?php
                            }

                    ?>  
                    <?php
                        }else {
                    ?>
                       <div style="margin-top: 10px; background: white; box-shadow: 0 5px 10px rgba(0, 0, .09); padding: 5px 10px; border-radius: 10px">
                            <a href="Les offres/<?= $r['id'] ?>" style="color: #666; text-decoration: none; font-size: 28px;"><?= $r['titre'] ?></a>
                            <div style="border-top: 2px solid #EEE; padding-top: 15px">
                                <?= $r['id']; ?>
                            </div>
                            <div style="border-top: 2px solid #EEE; padding-top: 15px; text-align: right">
                                <?= $r['contenu']; ?>
                            </div>
                            <div style="border-top: 2px solid #EEE; padding-top: 15px; text-align: right">
                                <?= $r['date_creation']; ?>
                            </div>
                        </div>         
                        <?php
                        }
                        ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>