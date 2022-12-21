<?php
include_once('../_BDD/include.php');

if (!isset($_SESSION['id'])){
    header('Location: index.php');
    exit;
  }

    $req = $BDD->prepare("SELECT u.*, ar.libelle
    FROM utilisateurs u
    LEFT JOIN admin_role ar ON ar.role = u.role
    WHERE u.id <> ?");

    $req->execute([$_SESSION['id']]);

    $req_list_user = $req->fetchAll();

    $req = $BDD->prepare("SELECT *
    FROM admin_role");

    $req->execute();

    $req_list_role = $req->fetchAll();

    $tab_list_role = [];

    foreach($req_list_role as $r){
        array_push($tab_list_role, [$r['role'], $r['libelle']]);
    }
    if(!empty($_POST)){
        extract($_POST);

        $valid = true;

        if(isset($_POST['changementrole'])){
            $id = (int) $id;
            $role = (int) $role;

            $req = $BDD->prepare("SELECT *
                FROM utilisateurs
                WHERE id = ?");

            $req->execute([$id]);

            $verif_utilisateur = $req->fetch();

            if(!$verif_utilisateur){
                $valid = false;
                $err_utilisateur = "cet utilisateur n'existe plus !";
            }else{
                $req = $BDD->prepare("SELECT *
                    FROM admin_role
                    WHERE role = ?");

                $req->execute([$role]);

                $verif_role = $req->fetch();

                if(!$verif_role){
                    $valid = false;
                    $err_role = "ce role n'existe pas !";
                }
            }

            
            if($valid){
                $req = $BDD->prepare("UPDATE utilisateurs SET role = ? WHERE id = ?");

                $req->execute([$verif_role['role'], $id]);

                header('Location: voir_candidats.php');
                exit;

            }
        }
    }
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <title>Validation des profils candidats</title>
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
                <div class="col-sm-0 col-md-2 col-lg-0"></div>
                <div class="col-sm-12 col-md-8 col-lg-12">
                 
                    <h2>Validation des profils candidats</h2>
                    <div>
                        
                        <?php
                            foreach($req_list_user as $r){
                        ?>
                        <form method="post">
                        <div>
                            <div><?= $r['nom'] ?></div> 
                            <select name="role">
                                <option value="<?= $r['role']?>" hidden><?= $r['libelle'] ?></option>
                                <?php
                                    foreach($tab_list_role as $tr){
                                ?>
                                <option value="<?= $tr['0']?>"><?= $tr['1'] ?></option>
                                <?php        
                                    }
                                ?>
                            </select>
                            <input type="hidden" name="id" value="<?= $r['id'] ?>"/>
                            <button class="btn btn-primary" type="submit" name="changementrole">Modifier</button>
                        </div>
                        <br>
                        </form>
                        <?php        
                            }
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    </body>
</html>