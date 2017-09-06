<?php
$this->layout('layout', [
    'title' => 'Index Posts',
    'path' => $path
])
?>
<h4>Liste Snippet</h4>

<table>
    <?php foreach ($posts as $post): ?>
        <tr>
            <td><?= $this->e($post->getId()) ?></td>
        </tr>
        <tr>
            <td>
                <a href="<?php echo $path->generateUrl('PostShow', ['id' => $post->getId()]) ?>"><?= $this->e($post->getTitle()) ?></a>
                by
                <a href="<?php echo $path->generateUrl('UserShow', ['id' => $post->getUser()->getId()]) ?>"><?= $this->e($post->getUser()->getLogin()) ?></a>
            </td>
        </tr>
        <tr>
            <td>
                <?= $this->e($post->getContent()) ?>
            </td>
        </tr>
        <tr>
            <td>
                <hr />
            </td>
        </tr>

    <?php endforeach; ?>
</table>