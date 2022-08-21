<?php

include_once('_BDD/include.php');
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
            <p class="p-3 mb-2 bg-warning text-dark text-center fw-bold"><a href="formulaire-recruteur.php">Vous recrutez </a>
            | BÉNÉFICIEZ DE NOS TARIFS DÉDIÉS AUX NOUVEAUX CLIENTS POUR VOS OFFRES D'EMPLOI  </p>
        </div>
        <?php
            include_once('menu/menu.php');
        ?>
        <div class="container">
            <div class="row">

                <div class="col-sm-0 col-md-0 col-lg-0"></div>
                <div class="col-sm-12 col-md-12 col-lg-12"></div>
                    <h1 style="text-align : center">Les offres d'emploi</h1>
                    <?php
                        if(isset($_SESSION['id'])){
                    ?>
                        <a href="#" class="btn btn-primary" role="button" aria-pressed="true">Publier une offre d'emploi</a>
                    <?php
                        }
                    ?>
                    <div class="table-responsive" style="margin-top: 10px">
                        <table class="table table-striped">
                            <tr>
                                <th>ID</th>
                                <th>Titre</th>
                            </tr>
                        </table>

                    </div>
            </div>
        </div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>