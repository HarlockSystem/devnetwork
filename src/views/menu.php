<?php ?>

<header>
    <a href="home.html" class="devnetwork">
        <img src="../src/public/images/logo.png" alt="logo">
        <h1>devNetwork</h1>
    </a>
    <!--    <nav>
            <a href="profil.html">Profil</a> 
            <a href="registration.html">Login</a> 
            <a href="publication.html">publicationDEMO</a> 
            <a href="post_create.html">creaPubliDEMO</a>
        </nav>	-->
    <nav>
        <?php if ($session->isLogged()): ?>
            <?php $usrData = $session->getUser() ?>
            <a href="<?php echo $path->generateUrl('UserShow', ['id' => $usrData['id']]) ?>"><?= $this->e($usrData['name']) ?></a> |
            <a href="<?php echo $path->generateUrl('UserLogout') ?>">Logout</a>
        <?php else : ?>
            <a href="<?php echo $path->generateUrl('UserNew') ?>">Sign In</a> |
            <a href="<?php echo $path->generateUrl('UserLogin') ?>">Login</a>
        <?php endif; ?>
        <a href="publication.html">publicationDEMO</a> 
        <a href="post_create.html">creaPubliDEMO</a>
    </nav>

</header>