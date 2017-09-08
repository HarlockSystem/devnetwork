<?php
$this->layout('layout', [
    'title' => 'User profile',
    'path' => $path,
    'session' => $session
])
?>

<h4>User page</h4>

<a href="<?php echo $path->generateUrl('UserEdit', ['id' => $user->getId()]) ?>">Edit</a>

<h5>User Info</h5>
getId: <?= $user->getId() ?><br>
getName: <?= $user->getName() ?><br>
getPassword: <?= $user->getPassword() ?><br>
getEmail: <?= $user->GetEmail() ?><br>
getFirstname: <?= $user->getFirstname() ?><br>
getLastname: <?= $user->getLastname() ?><br>
getSkill: <?= $user->getSkill() ?><br>
getBio: <?= $user->getBio() ?><br>
getJobStatus: <?= $user->getJobStatus() ?><br>
getImg: <?= $user->getImg() ?><br>
getRole: <?= $user->getRole() ?><br>
getStatusUser: <?= $user->getStatusUser() ?><br>

<h5>User Posts</h5>

<table>
    <?php foreach ($posts as $post): ?>
        <tr>
            <td><?= $this->e($post->getId()) ?></td>
        </tr>
        <tr>
            <td>

                <a href="<?php echo $path->generateUrl('PostShow', ['id' => $post->getId()]) ?>"><?= $this->e($post->getTitle()) ?></a>
            </td>
        </tr>

    <?php endforeach; ?>
</table>
