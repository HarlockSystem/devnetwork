<?php
$this->layout('layout', [
    'title' => 'Homepage',
    'path' => $path,
    'session' => $session
])
?>

<main class="wrapper aligner">
    <form method="POST" name="login" action="<?php echo $path->generateUrl('UserProcess') ?>" id="login_hp" class="home">
        <h1>Se connecter</h1>
        <div class="row">
            <div class="col-lg-3 input-group">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            </div>
        </div>
        <div class="box">
            <i class="fa fa-user" aria-hidden="true"></i><input type="text" name="name" id="userName" class="form-control" placeholder="Login" aria-describedby="basic-addon1" value="">
        </div>
        <div class="box">
            <i class="fa fa-lock" aria-hidden="true"></i><input type="password" name="pass" id="password" class="form-control" placeholder="Mot de passe" aria-describedby="basic-addon2">
        </div>
        <button type="submit" class="submit" id="login_bttn" ><span class="spanSubmit">Connexion</span></button>
    </form>
</main>
