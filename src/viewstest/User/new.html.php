<?php
$this->layout('layout', [
    'title' => 'New User',
    'path' => $path
])
?>
<h4>Post</h4>
<form action="<?php echo $path->generateUrl('UserProcess') ?>" method="POST">
    

    <input type="text" name="login" placeholder="login"/>
    <br />
    <input type="passwored" name="password" placeholder="password"/>
    <br />
    <input type="text" name="email" placeholder="email"/>
    <br />
    <button name="newUser">Create</button>
    
</form>