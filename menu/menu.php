
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a href="../menu/index.php"><img src="../images/logo.jpg" alt="logo du site" width="100" height="100"></a>    
        
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item fw-bold">
                <a class="nav-link " aria-current="page" href="offres.php">Offres</a>
                </li>
                <li class="nav-item fw-bold">
                <a class="nav-link" href="#">Mes candidatures</a>
                </li>
            </ul>
            <div class= d-flex>
                <?php
                    if(!isset($_SESSION['id'])){
                ?> 
                    <div class="p-2">
                        <a href="../_Candidats/inscription.php"><button type="button" class="btn btn-outline-primary">Inscription</button></a> 
                    </div>
                    <div class="p-2">
                        <a class="btn btn-primary" href="../_Candidats/connexion.php" role="button">Connexion</a>
                    </div>   
                <?php     
                    }else{
                ?>
                     <div class="p-2">
                        <a href="../_Candidats/profil.php"><button type="button" class="btn btn-outline-primary">Mon profil</button></a> 
                    </div>
                    <div class="p-2">
                        <a class="btn btn-primary" href="déconnexion.php" role="button">Déconnexion</a>
                    </div> 
                    <?php     
                    }
                ?>
   

                
            </div>
            </div>
        </div>
    </nav>