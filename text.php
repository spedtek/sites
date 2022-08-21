<?php
if(!empty($_POST)){
  extract($_POST);

  $valid = (boolean) true;

  if(isset($_POST['inscription-recruteur'])){
     $Nomrecruteur = trim($Nomrecruteur);
     $Adresserecruteur = trim($Adresserecruteur);
     $Emailrecruteur = trim($Emailrecruteur);
     $Mdprecruteur = trim($Mdprecruteur);

     if(empty($Nomrecruteur)){
      $valid = false;
      $err_nomrecruteur = "Ce champ ne peut pas être vide";
     }
     if(empty($Adresserecruteur)){
      $valid = false;
      $err_adresserecruteur = "Ce champ ne peut pas être vide";
     }
     if(empty($Emailrecruteur)){
      $valid = false;
      $err_emailrecruteur = "Ce champ ne peut pas être vide";
     }else{
      $req = $BDD->prepare("SELECT id
      FROM recruteurs
      where emailrecruteur = ?");

      $req->execute(array($Emailrecruteur));
      
      $req = $req->fetch();

      if(isset($req['id'])){
        $valid = false;
        $err_emailrecruteur = "Ce mail est déjà pris";
      }
     if(empty($Mdprecruteur)){
      $valid = false;
      $err_mdprecruteur = "Ce champ ne peut pas être vide";
     }
     if ($valid){
      $req = $BDD->prepare("INSERT INTO recruteurs(nom, adresse, email, mdp) VALUES (?,?,?,?)");
      $req->execute(array($Nomrecruteur, $Prénomrecruteur, $Emailrecruteur, $Mdprecruteur));

      header('Location: connexion.php');
     }else{
      echo 'des champs du questionnaire sont manquants';
    
     }
  }
}
}






















if(!empty($_POST)){
    extract($_POST);
    $valid = (boolean) true;
  
    $Email = trim($Email);
    $Mdp = trim($Mdp); 
  
       if(empty($Email)){
        $valid = false;
        $err_email = "Ce champ ne peut pas être vide";
       }
       if(empty($Mdp)){
        $valid = false;
        $err_mdp = "Ce champ ne peut pas être vide";
       }
  
  
       if ($valid){
        $req = $BDD->prepare("SELECT mdp
        FROM utilisateurs
        WHERE email = ?");
    
        $req->execute(array($Email));
    
        $req = $req->fetch();
    
        if(isset($req['mdp'])){
          if(!password_verify($Mdp, $req['mdp'])) {
            $valid = false;
            $err_email = "la combinaison Email/Mot de passe est incorrect";
          }
        }else{
          $valid = false;
          $err_email = "la combinaison Email/Mot de passe est incorrect";
        }
    
        if ($valid){
          $req = $BDD->prepare("SELECT *
          FROM utilisateurs
          WHERE email = ?");
    
          $req->execute(array($Email));
    
          $req_user = $req->fetch();
    
          if(isset($req_user['id'])){
            $date_connexion = date('Y-a-d M:i:s');
    
            $req = $BDD->prepare("UPDATE utilisateur SET date_connexion = ? WHERE id = ?");
            $req->execute(array($date_connexion, $req_user['id']));
    
    
            $_SESSION ['id'] = $req_user['id'];
            $_SESSION ['prénom'] = $req_user['prenom'];
            $_SESSION ['email'] = $req_user['email'];
            $_SESSION ['role'] = $req_user['role'];
    
            header('Location: index.php');
            exit;
          }else{
            $valid = false;
            $err_email = "la combinaison Email/Mot de passe est incorrect";
          }
        }
  if ($valid){
    $req = $BDD->prepare("SELECT mdp
    FROM utilisateurs
    WHERE email = ?");
  
    $req->execute(array($Email));
  
    $req = $req->fetch();
  
    if(isset($req['mdp'])){
      if(!password_verify($Mdp, $req['mdp'])) {
        $valid = false;
        $err_email = "la combinaison Email/Mot de passe est incorrect";
      }
    }else{
      $valid = false;
      $err_email = "la combinaison Email/Mot de passe est incorrect";
    }
  
    if ($valid){
      $req = $BDD->prepare("SELECT *
      FROM utilisateurs
      WHERE email = ?");
  
      $req->execute(array($Email));
  
      $req_user = $req->fetch();
  
      if(isset($req_user['id'])){
        $date_connexion = date('Y-a-d M:i:s');
  
        $req = $BDD->prepare("UPDATE utilisateur SET date_connexion = ? WHERE id = ?");
        $req->execute(array($date_connexion, $req_user['id']));
  
  
        $_SESSION ['id'] = $req_user['id'];
        $_SESSION ['prénom'] = $req_user['prenom'];
        $_SESSION ['email'] = $req_user['email'];
        $_SESSION ['role'] = $req_user['role'];
  
        header('Location: index.php');
        exit;
      }else{
        $valid = false;
        $err_email = "la combinaison Email/Mot de passe est incorrect";
      }
    }
  }







?>