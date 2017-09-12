<?php
$this->layout('layout', [
    'title' => 'List Users',
    'path' => $path,
    'session' => $session
])
?>
<main class="wrapper aligner publication">
    <div class="list_user contentFix">
        <h2>Membres inscrits:</h2>
        <table>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td>
                        <h2>
                            <a href="<?php echo $path->generateUrl('UserDel', ['id' => $user->getId()]) ?>"><?= $this->e($user->getName()) ?></a>
                            <small class="datePublished">
                                depuis le: <?= date('d-m-Y', strtotime($user->getCreatedAt())) ?>
                            </small>
                        </h2>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</main>