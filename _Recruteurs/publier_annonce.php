<?php

include('../_BDD/include.php'); // Fichier PHP contenant la connexion à votre BDD

    if (!isset($_SESSION['id'])){
        header('Location: ../menu/index.php'); 
        exit;
    }

    if(!empty($_POST)){
    extract($_POST);
    $valid = true;

if (isset($_POST['offre-emploi'])){

    // Récupération de nos différents champs
    $titre = htmlentities(trim($titre));
    $contenu = htmlentities(trim($contenu));

    if(empty($titre)){
    $valid = false;
    $er_titre = ("Il faut mettre un titre");
    }

    if(empty($contenu)){
    $valid = false;
    $er_contenu = ("Il faut mettre un contenu");
    }


    if($valid){
    $date_creation = date('Y-m-d H:i:s');

    $req = $BDD->prepare("INSERT INTO offres (titre, contenu, date_creation, id_recruteur) VALUES
    (?, ?, ?, ?)");
    $req->execute(array($titre, $contenu, $date_creation, $_SESSION['id']));

    header('Location: profil_recruteur.php');
    exit;
    }
}
}
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

        <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a href="../menu/index.php"><img src="../images/logo.jpg" alt="logo du site" width="100" height="100"></a>    
        
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php
                    if(!isset($_SESSION['id'])){
                ?> 
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item fw-bold">
                <a class="nav-link " aria-current="page" href="../menu/offres.php">Offres</a>
                </li>
                <li class="nav-item fw-bold">
                <a class="nav-link" href="#">Mes candidatures</a>
                </li>
                </ul>
            <div class= d-flex>
                    <div class="p-2">
                        <a href="../_Candidats/inscription.php"><button type="button" class="btn btn-outline-primary">Inscription</button></a> 
                    </div>
                    <div class="p-2">
                        <a class="btn btn-primary" href="../_Candidats/connexion.php" role="button">Connexion</a>
                    </div>   
                <?php     
                    }else{
                ?>           
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item fw-bold">
                    <a class="nav-link " aria-current="page" href="profil.php">Mon profil</a>
                    </li>
                    <li class="nav-item fw-bold">
                    <a class="nav-link " aria-current="page" href="../menu/offres.php">Mes offres d'emploi</a>
                    </li>
                    <li class="nav-item fw-bold">
                    <a class="nav-link" href="#">Les candidatures</a>
                    </li>
                    </ul>   
                    <div class="p-2">
                        <a class="btn btn-primary" href="../deconnexion.php" role="button">Déconnexion</a>
                    </div> 

<?php
                    }
                    ?>

        </div>
    </div>
</nav>   

        <div class="container">
        <div class="row">	

        <div class="col-sm-0 col-md-0 col-lg-0"></div>
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="cdr-ins">

                <h1 style="text-align:center;">Créer une offre d'emploi</h1>

            <form method="post">

            <?php
                if (isset($er_titre)){
                ?>
                <div class="er-msg"><?= $er_titre ?></div>
                <?php
                }
            ?>
                
                <div class="form-group" style="margin-top:10px;">
            	 <input class="form-control" type="text" placeholder="Votre titre" name="titre" value="<?php if(isset($titre)){ echo $titre; }?>">

                </div>

                <?php
                if (isset($er_contenu)){
                ?>
                <div class="er-msg"><?= $er_contenu ?></div>
                <?php
                }
                ?>
                
                <div class="form-group" style="margin-top:10px;">
                <textarea class="form-control" rows="3" placeholder="Décrivez votre offre d'emploi" name="contenu"><?php if(isset($contenu)){ echo $contenu; }?></textarea>
                </div>

                <div class="form-group" style="margin-top:10px;">
                <button class="btn btn-primary" type="submit" name="offre-emploi">Envoyer</button>
                </div>

                </form>
                </div>
            </div>  
            </div>
        </div>
 
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>