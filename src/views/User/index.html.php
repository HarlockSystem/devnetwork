<?php
$this->layout('layout', [
    'title' => 'List Users',
    'path' => $path,
    'session' => $session
])
?>
<main class="wrapper publication">
    <div class="list_user">
    <h2>Membres inscrits</h2>
    <table>
        <?php foreach ($users as $user): ?>
            <tr>
                <td>
                    <h2>
                        <a href="<?php echo $path->generateUrl('UserShow', ['id' => $user->getId()]) ?>"><?= $this->e($user->getName()) ?></a> |
                        <code>Add date subscrib</code>
                    </h2>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    </div>
</main>