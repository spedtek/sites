<?php
   require_once('../_BDD/include.php'); 
    
    if(!isset($_SESSION['id'])){ 
        header('Location: ../menu/index.php'); 
        exit; 
    }
    $req = $BDD->prepare("SELECT *
    FROM utilisateurs
    WHERE id = ?");

        $req->execute([$_SESSION['id']]);

        $req_profil = $req->fetch();
    
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
    $req2 = $BDD->prepare("SELECT *
    FROM cv
    WHERE id = ?");

        $req2->execute([$_SESSION['id']]);

        $req_profil2 = $req2->fetch();
// 


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
                    <a class="nav-link " aria-current="page" href="../menu/offres.php">Offres</a>
                    </li>
                    <li class="nav-item fw-bold">
                    <a class="nav-link" href="#">Mes candidatures</a>
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
        <div class="recruteur">
            <p class="p-3 mb-2 bg-warning text-dark text-center fw-bold"><a href="formulaire-recruteur.php">TNT CONSEILS </a>
            | Spécialiste du recrutement dans l'hotellerie et la restauration </p>
        </div>

        <div class="container">
            <div class="row">	
            <div class="col-sm-0 col-md-0 col-lg-0"></div>
            <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="cdr-ins">
                <h1 style="text-align: center;">Ma page de profil</h1> <br/>

            <div style="margin-top: 10px; background: white; box-shadow: 0 5px 10px rgba(0, 0, .09); padding: 5px 10px; border-radius: 10px; text-align:center;">

                <h2>Bonjour <?= $req_profil['nom']?></h2>
            <div>
            Titulaire du compte : <?= $req_profil['nom']?>
            </div>
            <div>
            Adresse E-mail : <?= $req_profil['email'] ?>
            </div>
            <div>
            Role utilisateur : <?= $role ?>
            </div>
            <div>
                CV : <?= $req_profil['nom'] ?>
            </div>
            <div>
            <a href="modifier-compte.php">Modifier mon compte</a>
            </div>
            </div>
            </div>
        </div>
        
        </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    </body>
</html>