<?php
  

function getOffres()
{
    require_once('../_BDD/include.php'); 
    $req = $BDD->prepare('SELECT id, title FROM offres ORDER BY id DESC');
    $req->execute();
    $data = $req->fetchALL();
    return $data;
    $req->closeCursor();
}
function getOffre($id)
{
    require_once('../_BDD/include.php'); 
    $req = $BDD->prepare('SELECT * FROM offres WHERE id = ?');
    $req->execute(array($id));
    if($req->rowCount() == 1)
    {
        $data = $req->fetch(PDO::FETCH_OBJ);
        return $data;
    }
    else
    header('Location: index.php');
}