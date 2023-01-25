<?php
    include_once('../_BDD/include.php');
 
  $get_id = (int) trim($_GET['id']);
 
  if(empty($get_id)){
    header('Location: ../menu/index.php');
    exit;
  }
  
  $req = $BDD->query("SELECT o.*, u.nom, u.prenom, c.titre as titre_cat
    FROM offres o
    LEFT JOIN utilisateurs u ON u.id = o.id_utilisateur
    LEFT JOIN recruteurs r ON r.id_recruteurs = o.id_recruteurs
    WHERE o.id = ?
    ORDER BY b.date_creation", 
    array($get_id));
 
  $req = $req->fetch();
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <title>Postuler</title>  
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
        <div class="row" style="margin-top: 20px">  
            <div class="col-sm-12 col-md-12 col-lg-12">                 
            <a class="btn btn-primary" href="profil.php" role="button">Retour</a>
            <div style="margin-top: 20px; background: white; box-shadow: 0 5px 10px rgba(0, 0, 0, .09); padding: 5px 10px; border-radius: 10px">
                <h1 style="color: #666; text-decoration: none; font-size: 28px;"><?= $req['titre'] ?></h1>
                <div style="border-top: 2px solid #EEE; padding: 15px 0">
                <?= nl2br($req['text']); ?>
                </div>
                <div style="padding-top: 15px; color: #ccc; font-style: italic; text-align: right;font-size: 12px;">
                Fait par  <?= $req['nom'] . " " . $req['prenom'] ?> le <?= date_format(date_create($req['date_creation']), 'D d M Y à H:i'); ?> dans le thème <?= $req['titre_cat'] ?>
                </div>
            </div>
            </div>
        </div>
        </div>
   
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

  </body>
</html>