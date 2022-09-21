<?php

include_once('../_BDD/include.php');


if(in_array($_SESSION['id'], [4, 5])){
    header('Location: ../menu/index.php');
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

    if(isset($_POST['changement_role'])){
        $id_user = (int) $id_user;
        $role = (int) $role;

        $req = $BDD->prepare("SELECT *
        FROM utilisateurs
        WHERE id = ?");

        $req->execute([$id_user]);

        $verif_utilisateur = $req->fetch();

        if(!$verif_utilisateur){
            $valid = false;
            $err_role = "ce role est faux!";
        }else{

            $req = $BDD->prepare("SELECT *
            FROM admin_role
            WHERE role = ?");
    
            $req->execute([$role]);
    
            $verif_role = $req->fetch();
    
            if(!$verif_role){
                $valid = false;
                $err_role = "Ce role n'existe pas";
            }
        }
        
        if($valid){
            $req = $BDD->prepare("UPDATE utilisateur SET role = ? WHERE id = ?");

            $req->execute([$verif_role['role'], $id_user]);


            header('Location: admin.php');
            echo 'toto va bene';
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
    <link rel="stylesheet" href="https://cdnjs.coudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link href="asset/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="asset/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Changer du profil des utilisateurs</title>  
    
  
    <div class="recruteur">
        <p class="p-3 mb-2 bg-warning text-dark text-center fw-bold"><a href="../_Recruteurs/inscription_rec.php">Vous recrutez </a>
        | BÉNÉFICIEZ DE NOS TARIFS DÉDIÉS AUX NOUVEAUX CLIENTS POUR VOS OFFRES D'EMPLOI  </p>
             
    <?php
        include_once('../menu/menu.php');
    ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 style = "text-align: center;">Changer le profil des utilisateurs</h1>
            
 
                <?php
                    foreach($req_list_user as $r){
                ?>
                <form method="POST">
                <div>
                    <div><?= $r['nom']?></div>
                    <select name="role">
                        <option value="<?= $r['role']?>"><?= $r['libelle']?></option>
                        <?php
                            foreach($tab_list_role as $tr){
                        ?>
                        <option value="<?= $r['0']?>"><?= $tr['1']?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <input type="hidden" name="id_user" values="<?= $r['id'] ?>"/>
                    <button type="submit" name="changement_role">Modifier</button>
                </div>
                </form>
            <br>
                   

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