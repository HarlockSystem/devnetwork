<?php
$this->layout('layout', [
    'title' => 'List Users',
    'path' => $path
])
?>


<form action="<?php echo $path->generateUrl('UserProcess') ?>" method="POST">
    
    Login: <br />
    <input type="text" name="login" value="" />
    <br />
    Password: <br />
    <input type="password" name="pass" value="" />
    <br />
    <button>Log In</button>
    
</form>
