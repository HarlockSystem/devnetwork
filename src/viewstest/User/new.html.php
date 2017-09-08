<?php
$this->layout('layout', [
    'title' => 'New User',
    'path' => $path,
    'session' => $session
])
?>
<h4>Post</h4>
<form action="<?php echo $path->generateUrl('UserNew') ?>" method="POST">
    

    <input type="text" name="name" placeholder="login"/>
    <br />
    <input type="passwored" name="password" placeholder="password"/>
    <br />
    <input type="text" name="email" placeholder="email"/>
    <br />
    <button name="action" value="signin">Create</button>
    
</form>