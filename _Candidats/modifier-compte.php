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

    if(isset($_POST["modifier"])){
      $req=$BDD->prepare("INSERT INTO cv(nom,taille,type,fichier) values(?,?,?,?)");
      $req->execute(array($_FILES["cv"]["name"], $_FILES["cv"]["size"], 
      $_FILES["cv"]["type"],$_FILES["cv"]["tmp_name"]));

      header('Location: profil.php');
      exit;
        }else{
          echo 'Le fichier ne correspond pas aux attentes';
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
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Modifier mon profil</h1>
                    <div>
                        Titulaire du compte : <?= $req_profil['nom']?>
                    </div>
                    <div>
                        Adresse E-mail : <?= $req_profil['email'] ?>
                    </div>
                    <div>
                        Role utilisateur : <?= $role ?>
                    </div>
                    <h2>Insérer votre CV</h2>
                    <form method="POST" enctype="multipart/form-data">
                    <div>
                      <?php if(isset($err_cv)){echo '<div>' . $err_cv . '</div>';}?>
                      <label for="formFile" class="form-label">Télécharger mon CV</label>
                      <input type="file" name="cv" value="<?php if(isset($CV)){echo $CV;}?>" placeholder="télécharger votre CV" accept="CV.pdf">
                    </div>
                    <div class="p-2">
                      <button class="btn btn-primary" name="modifier">Envoyer</button>
                    </div>
                    </form>

                      
                  </div>
            </div>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    </body>
</html>