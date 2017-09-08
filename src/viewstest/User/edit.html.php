<?php
$this->layout('layout', [
    'title' => 'User edit',
    'path' => $path,
    'session' => $session
])
?>

<form action="<?php echo $path->generateUrl('UserEdit', ['id' => $user->getId()]) ?>" method="POST">
    <input type="hidden" name="_method" value="PUT" />
    FirstName<br>
    <input type="text" name="firstname" value="<?=$this->e($user->getFirstName())?>" />
    <br />
    LastName<br>
    <input type="text" name="lastname" value="<?=$this->e($user->getLastName())?>" />
    <br />
    Skill<br>
    <textarea name=skill"" id="" cols="30" rows="10"><?=$this->e($user->getSkill())?></textarea>
    <br />
    Bio<br>
    <textarea name="bio" id="" cols="30" rows="10"><?=$this->e($user->getBio())?></textarea>
    <br />
    JobStatus<br>
    <input type="text" name="jobstatus" value="<?=$this->e($user->getJobStatus())?>" />
    <br />
    Img<br>
    <input type="file" name="img" value="<?=$this->e($user->getImg())?>" />
    <br />
    <button>Send</button>
</form>