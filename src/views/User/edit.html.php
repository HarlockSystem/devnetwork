<?php
$this->layout('layout', [
    'title' => 'User edit',
    'path' => $path,
    'session' => $session
])
?>
<main class="wrapper aligner profil">
    <form action="<?php echo $path->generateUrl('UserEdit', ['id' => $user->getId()]) ?>" method="POST">
        <input type="hidden" name="_method" value="PUT" />
        <h2>FirstName</h2>
        <input type="text" name="firstname" value="<?= $this->e($user->getFirstName()) ?>" />
        <h2>LastName</h2>
        <input type="text" name="lastname" value="<?= $this->e($user->getLastName()) ?>" />
        <h2>Skill</h2>
        <textarea name="skill" id="" cols="30" rows="10"><?= $this->e($user->getSkill()) ?></textarea>
        <h2>Jobs</h2>
        <textarea name="jobs" id="" cols="30" rows="10"><?= $this->e($user->getJobs()) ?></textarea>
        <h2>Bio</h2>
        <textarea name="bio" id="" cols="30" rows="10"><?= $this->e($user->getBio()) ?></textarea>
        <h2>Img</h2>
        <input type="file" name="img" value="<?= $this->e($user->getImg()) ?>" />
        <br />
        <br />
        <button>Send</button>
    </form>
</main>