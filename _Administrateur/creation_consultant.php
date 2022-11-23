<?php

  include_once('../_BDD/include.php');

  //if (!isset($_SESSION['id_admin'])){
  //  header('Location: admin.php');
  //  exit;
  //}
  
  //if($_SESSION['role'] <> 5){
  // header('Location: admin.php');
  // exit;
  //}
  
  if(!empty($_POST)){
    extract($_POST);
    $valid = true;
 
    if (isset($_POST['creer-consultant'])){
      $nom_consultant  = (string) htmlentities(trim($nom_consultant)); 
      $prenom_consultant = (string) htmlentities(trim($prenom_consultant)); 
      //$email_consultant = (int) htmlentities(trim($email_consultant));

      if(empty($nom_consultant)){
        $valid = false;
        $err_nom_consultant = ("Il faut mettre un nom");
      }       
  
      if(empty($prenom_consultant)){
        $valid = false;
        $err_prenom_consultant = ("Il faut mettre un prenom");
      }       
  
      //if(empty($email_consultant)){ 
        //valid = false;
        //$err_email_consultant = ("L'email ne peut pas être vide");
      //}

      if($valid){

        $req1 = $BDD->prepare("INSERT INTO consultants (nom_consultant, prenom_consultant) VALUES (?,?,)");
        $req1->execute(array($nom_consultant, $prenom_consultant));
  
        header('Location: admin.php');
        exit;
        }else{
        echo 'des champs du questionnaire sont manquants';
        }
      }
    }

  
?>
<!DOCTYPE html>
<html>
  <head>
    <base href="/"/>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Créer mon article</title>
  </head>
  <body>
    <?php
      require_once('menu-admin.php');    
    ?>
     <div class="recruteur">
        <p class="p-3 mb-2 bg-warning text-dark text-center fw-bold"><a href="formulaire-recruteur.php">TNT CONSEILS </a>
        | Spécialiste du recrutement dans l'hotellerie et la restauration </p>
    </div>
    <div class="container">
      <div class="row">   
        <div class="col-sm-12 col-md-12 col-lg-12">
          <div class="cdr-ins">
            <h1>Créer un consultant</h1>
            <form method="post">

                <div>
                    <?php if(isset($err_nom_consultant)){echo '<div>' . $err_nom_consultant . '</div>';}?>
                    <label class="form-label">Nom</label>
                    <input class="form-control" type="text" name="nom_consultant" value="<?php if(isset($nom_consultant)){echo $nom_consultant;}?>" placeholder="Nom">
                </div>

                <div>
                    <?php if(isset($err_prenom_consultant)){echo '<div>' . $err_prenom_consultant . '</div>';}?>
                    <label class="form-label">Prénom</label>
                    <input class="form-control" type="text" name="prenom_consultant" value="<?php if(isset($prenom_consultant)){echo $prenom_consultant;}?>" placeholder="Prénom">
                </div>
<!--
                <div>
                    //<?php if(isset($err_email_consultant)){echo '<div>' . $err_email_consultant . '</div>';}?>
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control" type="text" name="email_consultant" value="<?php if(isset($email_consultant)){echo $email_consultant;}?>" placeholder="Email">
                </div>

  -->

                <div class="form-group mb-2">
                <button class="btn btn-primary" type="submit" name="creer-consultant">Envoyer</button>
              </div>
            </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

  </body>
</html>