<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <base href="http://stuff.localhost/3wa_project/l0ckat/devnetwork/web/" />
        <link rel="icon" type="image/png" href="public/img/logo.png" />
        <title>devNetwork</title>
        <link href="https://fonts.googleapis.com/css?family=Fjalla+One|Roboto" rel="stylesheet">
        <link rel="stylesheet" href="css/font-awesome.css">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/style.css">
        <?php if(isset($css)){echo $css;} ?>
    </head>
    <body>

        <?= $this->insert('menu', ['path' => $path, 'session' => $session]) ?>
        <?= $this->insert('flash', ['flashMsg' => $session->getFlashMsg()]) ?>
        <?= $this->section('content') ?>

        <footer>
            <div class="minifooter">
                <p>© 2017 devNetwork</p> <a href="#">Contact</a> <a href="#">Conditions</a>
                <a href="#">Politique de confidentialité</a> <a href="#">Publicité</a>
            </div>
        </footer>
        <script src="js/jquery-3.2.1.min.js"></script>
        <?php if(isset($js)){echo $js;} ?>
       
    </body>
</html>