<?php
   require_once('../_BDD/include.php'); 
    
    if(!isset($_SESSION['id'])){ 
        header('Location: ../menu/index.php'); 
        exit; 
    }
    $req1 = $BDD->prepare("SELECT *
    FROM recruteurs
    WHERE id = ?");

        $req1->execute([$_SESSION['id']]);

        $req_profil_rec = $req1->fetch();
    
    switch($req_profil_rec['id_role']){
        case 0;
            $role = "Profil candidat en attente de validation";
        break;
        case 1;
            $role = "Profil recruteur en attente de validation";
        break;
        case 2;
            $role = "Profil candidat validé";
        break;
        case 3;
            $role = "Profil recruteur validé";
        break;
        case 4;
            $role = "Profil consultant";
        break;
        case 5;
            $role = "Profil administrateur";
        break;
    }
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <title>Profil de <?= $req_profil['email'] ?></title>
    <head>
    <body>
        <?php 
            include_once('../menu/menu.php'); 
        ?>
        <div class="recruteur">
            <p class="p-3 mb-2 bg-warning text-dark text-center fw-bold"><a href="formulaire-recruteur.php">TNT CONSEILS </a>
            | Spécialiste du recrutement dans l'hotellerie et la restauration </p>
        </div>
        <div class="container mb-5">
            <div class="row">
                <div class="col-12">
                    <h1>Bonjour <?= $req_profil_rec['Nomrecruteur']?></h1>
                    <div>
                        Titulaire du compte : <?= $req_profil_rec['Nomrecruteur']?>
                    </div>
                    <div>
                        Adresse E-mail : <?= $req_profil_rec['Emailrecruteur'] ?>
                    </div>
                    <div>
                        Role utilisateur : <?= $role ?>
                    </div>
                    <div>
                        <a href="modifier-compte.php">Modifier mon compte</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col-12">
            <h2>Toutes mes offres</h2>
            <a href="publier_annonce.php"><button class="btn btn-primary">Publier une offre d'emploi</button></a>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    </body>
</html>