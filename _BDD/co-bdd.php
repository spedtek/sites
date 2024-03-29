<?php
  // Déclaration d'une nouvelle classe
  class connexionBDD {
    private $host    = 'eu-cdbr-west-03.cleardb.net';  // nom de l'host  
    private $name    = 'heroku_515031820554d9b';    // nom de la base de donnée
    private $user    = 'b37371ad72bf0e';       // utilisateur 
    private $pass    = '4a772254';       // mot de passe (il faudra peut-être mettre '' sous Windows)
    private $connexion;

    function __construct($host = null, $name = null, $user = null, $pass = null){
      if($host != null){
        $this->host = $host;           
        $this->name = $name;           
        $this->user = $user;          
        $this->pass = $pass;
      }
      try{
        $this->connexion = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->name,
          $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES UTF8', 
          PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
      }catch (PDOException $e){
        echo 'Erreur : Impossible de se connecter  à la BDD !';
        die();
      }
    }
    public function BDD(){
        return $this->connexion;
    }

  }

  $BDD = new connexionBDD();

  $BDD = $BDD->BDD();
  

  $BDD2 = new connexionBDD();

  $BDD2 = $BDD2->BDD();


?>