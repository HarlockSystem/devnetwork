<?php
$this->layout('layout', [
    'title' => 'New User',
    'path' => $path,
    'session' => $session
])
?>


<main class="wrapper aligner">
    <form method="POST" name="login" action="<?php echo $path->generateUrl('UserNew') ?>" id="login_hp" class="home">
        <h1>S'enregistrer</h1>
        <div class="row">
            <div class="col-lg-3 input-group">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            </div>
        </div>
        <div class="box">
            <i class="fa fa-user" aria-hidden="true"></i>
            <input type="text" name="name" id="userName" class="form-control" placeholder="Login" aria-describedby="basic-addon1" value="">
        </div>
        <div class="box">
            <i class="fa fa-lock" aria-hidden="true"></i>
            <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe" aria-describedby="basic-addon2">
        </div>
        <div class="box">
            <i class="fa fa-lock" aria-hidden="true"></i>
            <input type="password" name="password2" id="password2" class="form-control" placeholder="Mot de passe (bis)" aria-describedby="basic-addon2">
        </div>
     
        <div class="box">
            <i class="fa fa-user" aria-hidden="true"></i>
            <input type="email" name="email" id="userName" class="form-control" placeholder="E-mail" aria-describedby="basic-addon1" value="">
        </div>
        <button name="action" value="signin" type="submit" class="submit" id="login_bttn" >
            <span class="spanSubmit">Go</span>
        </button> 
    </form>
</main>
