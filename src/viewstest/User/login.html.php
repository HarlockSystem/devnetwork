<?php
$this->layout('layout', [
    'title' => 'List Users',
    'path' => $path,
    'session' => $session
])
?>


<form action="<?php echo $path->generateUrl('UserProcess') ?>" method="POST">
    
    Login: <br />
    <input type="text" name="name" value="" />
    <br />
    Password: <br />
    <input type="password" name="pass" value="" />
    <br />
    <button name="action" value="login">Log In</button>
    
</form>
