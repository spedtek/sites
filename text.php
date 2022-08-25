


          if(isset($_POST['inscriptionrecruteur'])){
    $Nomrecruteur = trim($Nomrecruteur);
    $Adresserecruteur = trim($Adresserecruteur);
    $Emailrecruteur = trim($Emailrecruteur);
    $Mdprecruteur = trim($Mdprecruteur);

    if(empty($Nomrecruteur)){
      $valid2 = false;
      $err_nomrecruteur = "Ce champ ne peut pas être vide";
    }

    if(empty($Adresserecruteur)){
      $valid2 = false;
      $err_adresserecruteur = "Ce champ ne peut pas être vide";
    }

    if(empty($Emailrecruteur)){
      $valid2 = false;
      $err_emailrecruteur = "Ce champ ne peut pas être vide";
    }else{
        $req1 = $BDD2->prepare("SELECT id
        FROM recruteurs
        where Emailrecruteur = ?");

        $req1->execute(array($Emailrecruteur));
        
        $req1 = $req1->fetch();

      
    if(empty($Mdprecruteur)){
      $valid2 = false;
      $err_mdprecruteur = "Ce champ ne peut pas être vide";
    }
    if ($valid2){

      $crypt_password_rec = password_hash($Mdprecruteur, PASSWORD_ARGON2ID);

      if (password_verify($Mdprecruteur, $crypt_password_rec)){
        echo 'Le mot de passe est valide !';
      }else{
        echo 'Le mot de passe est invalide!';
      }
      $req1 = $BDD2->prepare("INSERT INTO recruteurs(Nomrecruteur) VALUES (?)");
      $req1->execute(array($Nomrecruteur));

        header('Location: index.php');
        exit;
       }else{
        echo 'des champs du questionnaire sont manquants';
      
       }
    }
  }
}