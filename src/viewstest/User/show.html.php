<?php
$this->layout('layout', [
    'title' => 'User profile',
    'path' => $path
])
?>

<h4>User page</h4>
<code>if auth: link:
PostEdit
<form action="<?php echo $path->generateUrl('UserEdit', ['id' => $user->getId()]) ?>" method="POST">
        <input type="hidden" name="_method" value="PUT" />
        <button>Edit</button>
    </form>

</code><br>
getId: <?= $user->getId() ?><br>
getLogin: <?= $user->getLogin() ?><br>
getPassword: <?= $user->getPassword() ?><br>

{ post for this user }

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
