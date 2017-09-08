<?php
$this->layout('layout', [
    'title' => 'List Users',
    'path' => $path,
    'session' => $session
])
?>

<h4>Users List</h4>
<table>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $this->e($user->getId()) ?></td>
        </tr>
        <tr>
            <td>
                <a href="<?php echo $path->generateUrl('UserShow', ['id' => $user->getId()]) ?>"><?= $this->e($user->getName()) ?></a> |
                <?= $this->e($user->getPassword()) ?> |
                <?= $this->e($user->getRole()) ?>
            </td>
        </tr>
        <tr>
            <td><?= $this->e($user->getEmail()) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
