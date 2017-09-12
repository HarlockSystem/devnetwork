<?php ?>

<header>
    <a href="<?php echo $path->generateUrl('Homepage') ?>" class="devnetwork">
        <img src="../src/public/images/logo.png" alt="logo">
        <h1 class="titreDevNet">devNetwork</h1>
    </a>
    <nav>
        <a href="<?php echo $path->generateUrl('Posts') ?>">Publications</a> 
        <a href="<?php echo $path->generateUrl('Users') ?>">Users</a> 
        <?php if ($session->isLogged()): ?>
            <?php $usrData = $session->getUser() ?>
            <a href="<?php echo $path->generateUrl('PostNew', ['type' => 'text']) ?>">+ Post</a>
            <a href="<?php echo $path->generateUrl('PostNew', ['type' => 'code']) ?>">+ Code</a>
            <a href="<?php echo $path->generateUrl('UserShow', ['id' => $usrData['id']]) ?>">
                    <?= $this->e($usrData['name']) ?>
                    <?php if($session->isAdmin()){echo '(<small style="color:red">Admin</small>)';}?>
            </a> |
            <a href="<?php echo $path->generateUrl('UserLogout') ?>">Logout</a>
        <?php else : ?>
            <a href="<?php echo $path->generateUrl('UserNew') ?>">Sign In</a> |
            <a href="<?php echo $path->generateUrl('UserLogin') ?>">Login</a>
        <?php endif; ?>
        
    </nav>

</header>