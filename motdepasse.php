
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Mot de passe oublié</title>
    </head>
    <body>
        <div>Mot de passe oublié</div>
        <form method="post">
            <?php
                if (isset($er_mail)){
            ?>
                <div><?= $er_mail ?></div>
            <?php
            }
            ?>
            <div class="col-md-6 mx-auto" style="width: 500px;">
                <div class="mb-3">
                    <input type="email" placeholder="Adresse mail" name="mail" value="<?php if(isset($mail)){ echo $mail; }?>" required>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" name="oublie">Envoyer</button>
                </div>
            </div>
        </form>
    </body>
</html>