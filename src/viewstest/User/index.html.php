<?php
$this->layout('layout', [
    'title' => 'List Users',
    'path' => $path
])
?>

AAA
<table>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $this->e($user->getId()) ?></td>
        </tr>
        <tr>
            <td>
                
                <a href="<?php echo $path->generateUrl('UserShow', ['id' => $user->getId()]) ?>"><?= $this->e($user->getLogin()) ?></a> |
            </td>
        </tr>
        <tr>
            <td><?= $this->e($user->getEmail()) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
