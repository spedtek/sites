<?php
include_once('../_BDD/include.php');

if(!isset($_SESSION['id'])){ 
  header('Location: ../menu/index.php'); 
  exit; 
}

if(isset($_POST['offre_titre'], $_POST['offre_contenu'])){
  if(!empty($_POST['offre_titre']) AND !empty($_POST['offre_contenu'])){
    $offre_titre = htmlspecialchars($_POST['offre_titre']);
    $offre_contenu = htmlspecialchars($_POST['offre_contenu']);
  
    $date_creation = date('Y-m-d H:i:s');
    $req = $BDD->prepare('INSERT INTO offres (titre, contenu, date_creation)
    VALUES (?,?,?)');
    $req->execute(array($offre_titre, $offre_contenu, $date_creation));

    $message = 'Votre offre a ete envoyé au controle';

    header('Location: profil_recruteur.php');
    exit;
} else {
  $erreur = 'Veuillez remplir tous les champs';
}
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <title>Document</title>
  <div class="recruteur">
        <p class="p-3 mb-2 bg-warning text-dark text-center fw-bold"><a href="../_Recruteurs/inscription_rec.php">Vous recrutez </a>
        | BÉNÉFICIEZ DE NOS TARIFS DÉDIÉS AUX NOUVEAUX CLIENTS POUR VOS OFFRES D'EMPLOI  </p>
             
    <?php
        include_once('../menu/menu.php');
    ?>
    </div>
</head>
<body>
<div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
              <h1 style="text-align:center">
                  Publier une offre d'emploi
              </h1>
  <form method="POST">
    <input type="text" name="offre_titre" placeholder="titre" /> </br>
    <textarea name="offre_contenu" placeholder="Contenu de l'article"></textarea> </br>
    <input type="submit" value="Publier l'annonce" />
  </form>
  <br/>
  <?php if(isset($erreur)) { echo $erreur; } ?>
            </div>
        </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>