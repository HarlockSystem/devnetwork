<?php
$this->layout('layout', [
    'title' => 'Homepage',
    'path' => $path,
    'session' => $session
])
?>

<main class="wrapper aligner profil">
    <img class="imageProfil" src="../src/public/images/fakeprofil.jpg" alt="photo de profil">
    <h1><?= $this->e($user->getName()) ?></h1>
    <!-- <h2>Dejour Adam</h2> <-->
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
                    <td><?=$this->e($job[0])?></td>
                    <td><?=$this->e($job[1])?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <?php endif; ?>
    </div>
    <?php if (!empty($user->getBio())): ?>
    <div class="biographie">
        <h3>Biographie</h3>
        <p><?=$this->e($user->getBio())?></p>
    </div>
    <?php endif; ?>
    <a href="" class="mail"><h2><?=$this->e($user->getEmail())?></h2></a>
    <?php
    // user edit
    if($session->isUser($user->getId())):
    ?>
    <a href="<?php echo $path->generateUrl('UserEdit', ['id' => $user->getId()]) ?>">Edit</a>
    <?php endif; ?>
</main>