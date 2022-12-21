<?php
include_once('../_BDD/include.php');

if (!isset($_SESSION['id'])){
    header('Location: index.php');
    exit;
  }

    $req1 = $BDD->prepare("SELECT u.*, ar.libelle
    FROM offres u
    LEFT JOIN admin_offre ar ON ar.statut = u.statut
    WHERE u.id <> ?");

    $req1->execute([$_SESSION['id']]);

    $req_list_offres = $req1->fetchAll();

    $req1 = $BDD->prepare("SELECT *
    FROM admin_offre");

    $req1->execute();

    $req_list_statut = $req1->fetchAll();

    $tab_list_statut = [];

    foreach($req_list_statut as $r){
        array_push($tab_list_statut, [$r['statut'], $r['libelle']]);
    }
    if(!empty($_POST)){
        extract($_POST);

        $valid = true;

        if(isset($_POST['changement_statut_offre'])){
            $id = (int) $id;
            $statut = (int) $statut;

            $req1 = $BDD->prepare("SELECT *
                FROM offres
                WHERE id = ?");

            $req1->execute([$id]);

            $verif_offre = $req1->fetch();

            if(!$verif_offre){
                $valid = false;
                $err_offre = "cette offre n'existe plus !";
            }else{
                $req1 = $BDD->prepare("SELECT *
                    FROM admin_offre
                    WHERE statut = ?");

                $req1->execute([$statut]);

                $verif_statut_offre = $req1->fetch();

                if(!$verif_statut_offre){
                    $valid = false;
                    $err_statut_offre = "ce statut n'existe pas !";
                }
            }

            
            if($valid){
                $req1 = $BDD->prepare("UPDATE offres SET statut = ? WHERE id = ?");

                $req1->execute([$verif_statut_offre['statut'], $id]);

                header('Location: validation_offres.php');
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
        <title>Validation des profils candidats</title>
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
                <div class="col-sm-0 col-md-2 col-lg-0"></div>
                <div class="col-sm-12 col-md-8 col-lg-12">
                 
                    <h2>Validation des profils recruteurs</h2>
                    <div>
                        
                        <?php
                            foreach($req_list_offres as $r){
                        ?>
                        <form method="post">
                        <div>
                            <div><?= $r['titre'] ?></div> 
                            <select name="statut">
                                <option value="<?= $r['statut']?>" hidden><?= $r['libelle'] ?></option>
                                <?php
                                    foreach($tab_list_statut as $tr){
                                ?>
                                <option value="<?= $tr['0']?>"><?= $tr['1'] ?></option>
                                <?php        
                                    }
                                ?>
                            </select>
                            <input type="hidden" name="id" value="<?= $r['id'] ?>"/>
                            <button type="submit" name="changement_statut_offre">Modifier</button>
                        </div>
                        <br>
                        </form>
                        <?php        
                            }
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    </body>
</html>