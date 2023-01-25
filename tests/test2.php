<?php
  include_once('../_BDD/include.php');
 
  $req = $BDD->query("SELECT b.*, u.nom, u.prenom, r.Nomrecruteur 
    FROM offres b
    LEFT JOIN utilisateurs u ON u.id = b.id_utilisateurs
    LEFT JOIN recruteurs r ON r.id = b.id_recruteurs
    ORDER BY b.date_creation DESC");
 
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

            <div class="container"><div class="row">   
        
                <div class="col-sm-0 col-md-0 col-lg-0"></div><div class="col-sm-12 col-md-12 col-lg-12"><h1 style="text-align: center">Mon blog</h1>
        

                <a href="../menu/index.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Créer un article</a><?php
                    
                    ?><?php foreach($req as $r){
                    ?>  
                        <div style="margin-top: 20px; background: white; box-shadow: 0 5px 10px rgba(0, 0, 0, .09); padding: 5px 10px; border-radius: 10px"><a href="test3.php/<?= $r['id'] ?>" style="color: #666; text-decoration: none; font-size: 28px;"><?= $r['titre'] ?></a><div style="border-top: 2px solid #EEE; padding: 15px 0"><?= nl2br($r['contenu']); ?></div><a href="test3.php/<?= $r['id'] ?>"></a>
                        <div style="padding-top: 15px; color: #ccc; font-style: italic; text-align: right;font-size: 12px;">
                            Fait par  <?= $r['nom'] . " " . $r['prenom'] ?> le <?= date_format(date_create($r['date_creation']), 'D d M Y à H:i'); ?> dans le thème <?= $r['titre'] ?></div></div>  
                    <?php
                    }
                    ?>              
                    </div>
                </div>
            </div>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>