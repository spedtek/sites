<?php
    session_start(); 

    include('_BDD/include.php'); 
    
    if(!isset($_SESSION['id'])){ 
        header('Location: index.php'); 
        exit; 
    }

    $afficher_profil = $BDD->query("SELECT * 
        FROM utilisateur 
        WHERE id = ?", 
        array($_SESSION['id']));
    
    $afficher_profil = $afficher_profil->fetch(); 
?>
<html lang="fr">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mon profil</title>
    <head>
    <body>
        <h2>Voici le profil de <?= $afficher_profil['nom'] . $afficher_profil['prenom']; ?></h2>
        <div>Quelques informations sur vous : </div>
        <ul>
        <li>Votre id est : <?= $afficher_profil['id'] ?></li>
        <li>Votre mail est : <?= $afficher_profil['email'] ?></li>
        <li>Votre compte a été crée le : <?= $afficher_profil['date_connexion'] ?></li>
        </ul>
    </body>
</html>