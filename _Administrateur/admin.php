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
    
    switch($req_profil['id_role']){
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
      require_once('menu-admin.php');    
    ?>
 
    <div class="recruteur">
        <p class="p-3 mb-2 bg-warning text-dark text-center fw-bold"><a href="formulaire-recruteur.php">TNT CONSEILS </a>
        | Spécialiste du recrutement dans l'hotellerie et la restauration </p>
    </div>
    </div>
        <h1 class = "mb-5" style="text-align : center">Bonjour <?= $req_profil['nom_admin']?></h1>
        <div class="container text-center">
          <h2>Votre profil</h2>
          <div class="row justify-content-center">
            <div class="col-4" style="margin-top: 10px; background: white; box-shadow: 0 5px 10px rgba(0, 0, .09); padding: 5px 10px; border-radius: 10px">
              <div>
                Titulaire du compte : <?= $req_profil['nom_admin']?>
              </div>
              <div>
                Adresse E-mail : <?= $req_profil['email_admin'] ?>
              </div>
              <div>
                Role utilisateur : <?= $role ?>
              </div>
            </div>
            <div class="col-4" style="margin-top: 10px; background: white; box-shadow: 0 5px 10px rgba(0, 0, .09); padding: 5px 10px; border-radius: 10px; margin:20px;">
              <p>Votre profil permet de créer un consultant</p>
              <a  class="btn btn-primary" href="creation_consultant.php">Création d'un profil consultant</a>
          </div>
        </div>

        <h2 style="margin-top: 10px">Les offres d'emploi</h2>
        <div class="container text-center">
          <div class="row justify-content-center">
            <div class="col-4" style="margin-top: 10px; background: white; box-shadow: 0 5px 10px rgba(0, 0, .09); padding: 5px 10px; border-radius: 10px">
              <div class="mb-2">
                <a  class="btn btn-primary" href="../_Validations/validation_offres.php">Validation des candidatures</a>
              </div>
            </div>
                <div class="col-4" style="margin-top: 10px; background: white; box-shadow: 0 5px 10px rgba(0, 0, .09); padding: 5px 10px; border-radius: 10px; margin:20px;">
                <div class="mb-2"> 
                <a  class="btn btn-primary" href="../_Validations/validation_offres.php" style="margin-top: 20px;">Validation des offres d'emploi</a>
              </div>
            
          </div>
        </div>


        <h2 style="margin-top: 10px">Les membres</h2>
        <div class="container text-center">
          <div class="row justify-content-center">
            <div class="col-4" style="margin-top: 10px; background: white; box-shadow: 0 5px 10px rgba(0, 0, .09); padding: 5px 10px; border-radius: 10px">
              <div class="mb-2">
                <a  class="btn btn-primary" href="../_Validations/voir_candidats.php" style="margin-top: 10px;">Valider le profil des candidats</a>
              </div>
            </div>
            <div class="col-4" style="margin-top: 10px; background: white; box-shadow: 0 5px 10px rgba(0, 0, .09); padding: 5px 10px; border-radius: 10px; margin:20px;">
              <a  class="btn btn-primary" href="../_Validations/voir_recruteurs.php" style="margin-top: 20px;">Valider le profil des recruteurs</a>
          </div>
        </div>




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    </body>
</html>