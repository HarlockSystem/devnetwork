<?php
$this->layout('layout', [
    'title' => 'List Users',
    'path' => $path,
    'session' => $session
])
?>
<main class="wrapper publication">
    <h4>Users List</h4>
    <table>
        <?php foreach ($users as $user): ?>
            
            <tr>
                <td>
                    <h2>
                        <a href="<?php echo $path->generateUrl('UserShow', ['id' => $user->getId()]) ?>"><?= $this->e($user->getName()) ?></a> |
                        <?= $this->e($user->getPassword()) ?> |
                        <?= $this->e($user->getRole()) ?>
                    </h2>
                </td>
            </tr>
           
        <?php endforeach; ?>
    </table>
</main>