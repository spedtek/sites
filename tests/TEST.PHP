



<?php

    include_once('../_BDD/include.php');

    if (!isset($_SESSION['id'])){
    header('Location: ../menu/index.php');
    exit;
  }
    $req = $BDD->prepare("SELECT *
    FROM offres
    ORDER BY date_creation");

    $req->execute();
    $req_offres = $req->fetchAll();

    if(isset($_POST['candidater'])){
        // Récupération des données du formulaire
        $id_offres = $_POST['id_offres'];
        $id_recruteurs = $_POST['id_recruteurs'];
        $id_utilisateurs = $_POST['id_utilisateurs'];
       

    // Préparation de la requête d'insertion
    $query = $BDD->prepare("INSERT INTO candidatures (id_offres, id_recruteurs, id_utilisateurs) VALUES ('$id_offres', '$id_recruteurs', '$id_utilisateurs')");
    $query->execute(array($id_offres, $id_recruteurs, $id_utilisateurs));

    header('Location: ../_Candidats/profil.php');
    exit;
   }else{
      echo 'des champs du questionnaire sont manquants';
   }

?>