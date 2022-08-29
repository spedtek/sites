<?php
include_once('../_BDD/include.php');


if(isset($_SESSION['id_admin'])){
  header('Location: admin.php');
  exit;
}

$req3 = $BDD->prepare("SELECT *
    FROM administrateurs
    WHERE id_admin = ?");

        $req3->execute([$_SESSION['id']]);

        $req_profil = $req3->fetch();
    
    switch($req_profil['role']){
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Connexion</title>  
    </head>
  <body>

    <?php 
        include_once('../menu/menu.php'); 
    ?>

    <div class="recruteur">
        <p class="p-3 mb-2 bg-warning text-dark text-center fw-bold"><a href="formulaire-recruteur.php">TNT CONSEILS </a>
        | Spécialiste du recrutement dans l'hotellerie et la restauration </p>
    </div>
    </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Bonjour <?= $req_profil['nom_admin']?></h1>
                    <div>
                        Titulaire du compte : <?= $req_profil['nom_admin']?>
                    </div>
                    <div>
                        Adresse E-mail : <?= $req_profil['email_admin'] ?>
                    </div>
                    <div>
                        Role utilisateur : <?= $role ?>
                    </div>
                    <div class="mb-2">
                        <a  class="btn btn-primary" href="modifier-compte.php">Modifier mon compte</a>
                    </div>
                    <div>
                        <p>Votre profil permet de créer un consultant</p>
                        <a  class="btn btn-primary" href="../_Consultants/inscription_consultant.php">Création d'un profil consultant</a>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    </body>
</html>