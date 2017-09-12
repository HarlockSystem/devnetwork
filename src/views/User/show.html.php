<?php
$this->layout('layout', [
    'title' => 'User #' . $user->getId(),
    'path' => $path,
    'session' => $session
])
?>

<?php if (!$session->isAdmin() and $user->getStatusUser() == 1): ?>
    <p style="text-align: center">
        <code>Ce compte a été supprimé</code>
    </p>
<?php else: ?>

    <main class="wrapper aligner profil">
        <img class="imageProfil" src="../src/public/images/fakeprofil.jpg" alt="photo de profil">
        <h1><?= $this->e($user->getName()) ?></h1>

        <h3 class="datePublished">
            compte crée le: <?= date('d-m-Y', strtotime($user->getCreatedAt())) ?>
            <?php if (!empty($user->getUpdatedAt())): ?>
                edite le: <?= date('d-m-Y', strtotime($user->getCreatedAt())) ?>
            <?php endif; ?>
        </h3>

        <div>
            <a href="<?php echo $path->generateUrl('UserPosts', ['id' => $user->getId()]) ?>">Ses publications</a>
            |
            <a href="<?php echo $path->generateUrl('UserFavorites', ['id' => $user->getId()]) ?>">Ses favoris</a>

            <?php if ($session->isUser($user->getId())): ?>
                
            <?php endif; ?>
        </div>    

        <div class="encadrement">
            <?php if (!empty($user->getArrSkill())): ?>
                <div class="cadre mainSkill">
                    <h2>Skill</h2>
                    <div class="skill">
                        <?php foreach ($user->getArrSkill() as $skill): ?>
                            <img src="../src/public/images/skill/<?= $this->e(trim($skill)); ?>.svg" alt="<?= $this->e(trim($skill)); ?>">
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (!empty($user->getArrJobs())): ?>
                <div class="cadre mainEntreprise">
                    <h2>Entreprise</h2>
                    <table class="entreprise">
                        <?php foreach ($user->getArrJobs() as $job): ?>
                            <tr>
                                <td><?= $this->e($job[0]) ?></td>
                                <td><?= $this->e($job[1]) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            <?php endif; ?>
        </div>
        <?php if (!empty($user->getBio())): ?>
            <div class="biographie">
                <h3>Biographie</h3>
                <p><?= $this->e($user->getBio()) ?></p>
            </div>
        <?php endif; ?>
        <a href="" class="mail"><h2><?= $this->e($user->getEmail()) ?></h2></a>
        <?php if ($session->isUser($user->getId())): // user edit ?>
            <div class="theme">
                <p>Theme d'éditeur : <?= $this->e($user->getTheme()) ?></p>
            </div>
            <a class="copy" href="<?php echo $path->generateUrl('UserEdit', ['id' => $user->getId()]) ?>">Edit</a>
            <form action="<?php echo $path->generateUrl('UserDel', ['id' => $user->getId()]) ?>" method="POST">
                <input type="hidden" name="_method" value="DELETE" />
                <button class="deleteBTN" title="Les codes seront toujours visible">Supprimer compte</button>
            </form>

        <?php endif; ?>


    </main>

<?php endif ?>