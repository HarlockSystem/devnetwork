<?php
$this->layout('layout', [
    'title' => 'Show post',
    'path' => $path,
    'session' => $session,
    'js' => '
<script src="ace/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script>
    var editor;
            $(".ace-editor").each(function (i) {
                editor = ace.edit(this);
                var language = $(this).data("language");
                
                editor.setTheme("ace/theme/monokai");
                editor.getSession().setMode("ace/mode/"+language);
                editor.setOptions({
                    autoScrollEditorIntoView: true,
                    maxLines: 30,
                    minLines: 2
                });
            })
</script>',
])
?>
<main  data-theme="terminal">

    <?php if ($session->isUser($post->getUser()->getId())): // user edit (user is owner) ?>
        <a href="<?= $path->generateUrl('PostEdit', ['id' => $post->getId()]) ?>">Edit Post</a>
    <?php endif; ?>


    <div class="post_title">
        <h2>
            <?= $this->e($post->getTitle()) ?>
        </h2>
        by : <a href="<?php echo $path->generateUrl('UserShow', ['id' => $post->getUser()->getId()]) ?>"><?= $this->e($post->getUser()->getName()) ?></a>
    </div>
    <?php if ($post->getContentType() == 0): ?>
        <div class="post_container">

            <div class="ace-editor" data-language="<?= $this->e($post->getLanguage()) ?>"><?= $this->e($post->getContent()) ?></div>


        </div>
    <?php else: ?>
        <div class="post_container"><?= $post->getContent() ?></div>
    <?php endif ?>

    <?php if ($session->isLogged()): // user is logged ?>
        <div class="bttn_wrapper">
            <button class="select_all" data-editor="1">Select All</button>
            <button class="copy" data-editor="1">Copy</button>
        </div>
    <?php endif; ?>

    <hr />
    tags: <?= $this->e($post->getTags(true)) ?>
    <hr />

    <?php if ($session->isLogged()): // user is logged ?>
        Add comment
        <form action="<?php echo $path->generateUrl('CommentNew', ['id_post' => $post->getId()]) ?>" method="POST">
            <br />
            <textarea name="content" id="" cols="30" rows="10"></textarea>
            <br />
            <button name="newComment">Create Comment</button>
        </form>
    <?php endif; ?>

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

</main>
