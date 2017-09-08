<?php
$this->layout('layout', [
    'title' => 'New User',
    'path' => $path,
    'session' => $session
])
?>

<main>

    <div class="container ">

        <form method="POST" action="<?php echo $path->generateUrl('UserNew') ?>">


            <div class="row">
                <div class="pass_container col-lg-3">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                </div>
            </div>
            <div class="row">
                <div class="input-group col-lg-4">
                    <span class="input-group-addon" id="basic-addon1">Username</span>
                    <input type="text" name="name" class="form-control" id="userName" placeholder="username" aria-describedby="basic-addon1" value="">
                </div>
                <div class="input-group col-lg-4">
                    <span class="input-group-addon" id="basic-addon2">Password</span>
                    <input type="password" name="password" class="form-control" id="password" placeholder="password" aria-describedby="basic-addon2">
                </div>

                <div class="input-group col-lg-4">
                    <span class="input-group-addon" id="basic-addon3">Password Re-check</span>
                    <input type="password" name="password_2check" class="form-control" id="password_2check" placeholder="password re-check" aria-describedby="basic-addon3">
                </div>
                <div class="email_container col-lg-4 input-group">
                    <span class="input-group-addon" id="basic-addon4">E-mail</span>
                    <input type="email" id="email" class="form-control" placeholder="E-mail" aria-describedby="basic-addon4">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <button type="submit" class="btn btn-success" id="register_bttn" >Register</button>
                </div>
            </div>
        </form>
    </div>
</main>
