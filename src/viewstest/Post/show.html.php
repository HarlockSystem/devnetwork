<?php
$this->layout('layout', [
    'title' => 'Show post',
    'path' => $path,
    'session' => $session
])
?>
<h4>Affichage Snippet</h4>
<code>post content:</code><br>
getId: <?= $post->getId() ?><br />
getTitle: <?= $post->getTitle() ?><br />
getContentType: <?= $post->getContentType() ?><br />
getCreatedAt: <?= $post->getCreatedAt() ?><br />
getUpdatedAt: <?= $post->getUpdatedAt() ?><br />
getStatusPost: <?= $post->getStatusPost() ?><br />
<hr />
<code>user info:</code><br>
<?php $user = $post->getUser() ?>
getId: <?= $user->getId() ?><br />
getName: <?= $user->getName() ?><br />


<hr />
<code>add comment</code><br>
Add comment
<form action="<?php echo $path->generateUrl('CommentNew', ['id_post' => $post->getId()]) ?>" method="POST">

    <br />
    <textarea name="content" id="" cols="30" rows="10"></textarea>
    <br />
    <button name="newComment">Create Comment</button>

</form>
<hr />
<code>display comments</code><br>

<table>
    <?php foreach ($comments as $comment): ?>
        <tr>
            <td><?= $this->e($comment->getId()) ?></td>
        </tr>
        <tr>
            <td><?= $this->e($comment->getContent()) ?></td>
        </tr>
        <tr>
            <td>
                <a href="<?php echo $path->generateUrl('UserShow', ['id' => $comment->getUser()->getId()]) ?>"><?= $this->e($comment->getUser()->getName()) ?></a>
            </td>
        </tr>

    <?php endforeach; ?>
</table>