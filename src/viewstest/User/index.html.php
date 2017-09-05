<?php $this->layout('layout', ['title' => 'Liste desUsers']) ?>



<table>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $this->e($user->getId()) ?></td>
        </tr>
        <tr>
            <td>
                <?= $this->e($user->getLogin()) ?>
                <a href="user/<?= $this->e($user->getId()) ?>">Link</a>
            </td>
        </tr>
        <tr>
            <td><?= $this->e($user->getEmail()) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
