<?php
$this->layout('layout', [
    'title' => 'Show post #' . $post->getId(),
    'path' => $path,
    'session' => $session,
    'js' => '
    <script src="ace/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
    <script>
        var editor =[];
        $(".ace-editor").each(function (i) {
            editor[i] = ace.edit(this);
            var language = $(this).data("language");
            editor[i].setTheme("ace/theme/monokai");
            editor[i].getSession().setMode("ace/mode/"+language);
            editor[i].setReadOnly(true);
            
            editor[i].$blockScrolling = Infinity;
            editor[i].setOptions({
                autoScrollEditorIntoView: true,
                maxLines: 30,
                minLines: 2
            });
        })
    </script>
    <script src="js/harlokscript.js"></script>',
])
?>
<main  data-theme="terminal">


    <div class="wrapper publication">  
        <div class="content">
            <div class="post_title">
                <h2 class="titlePublish">
                    <a href="<?= $path->generateUrl('PostShow', ['id' => $post->getId()]) ?>"><?= $this->e($post->getTitle()) ?></a> 
                    par 
                    <?php if ($post->getUser()->getStatusUser() == 1): ?>
                        <small style="color:grey"><i>User inactif</i></small>
                    <?php else: ?>
                        <a href="<?php echo $path->generateUrl('UserShow', ['id' => $post->getUser()->getId()]) ?>"><?= $this->e($post->getUser()->getName()) ?></a>
                    <?php endif ?>
                </h2>
                <h3 class="datePublished">
                    date: <?= date('d-m-Y', strtotime($post->getCreatedAt())) ?>
                    <?php if (!empty($post->getUpdatedAt())): ?>
                        edité: <?= date('d-m-Y', strtotime($post->getCreatedAt())) ?>
                    <?php endif; ?>
                </h3>
            </div>
            <?php if ($post->getContentType() == 0): ?>
                <div class="post_container">
                    <div class="lang">
                        <code><?= $this->e($post->getLanguage()) ?></code>
                    </div>
                    <div class="zoneDeCode">
                        <div class="ace-editor" id="editor0" data-language="<?= $this->e($post->getLanguage()) ?>" data-snippet="<?= $this->e($post->getContentType()) ?>"><?= $this->e($post->getContent()) ?></div>
                    </div>

                </div>
            <?php else: ?>
                <div class="post_container" id="editor0" data-snippet="<?= $this->e($post->getContentType()) ?>"><?= strip_tags($post->getContent(), '<p><h2><h1><h3><h4><em><blockquote><strong><br><ul><li><ol><strike>') ?></div>
            <?php endif ?>

            <?php if ($session->isUser($post->getUser()->getId())): // user edit (user is owner) ?>
                <a class="editPubli" href="<?= $path->generateUrl('PostEdit', ['id' => $post->getId()]) ?>">Editer</a>
                <a class="editPubli" href="<?= $path->generateUrl('PostEdit', ['id' => $post->getId()]) ?>">Supprimer</a>
            <?php endif; ?>
            <div class="bttn_wrapper">
                <button class="select_all" data-editor="0">Select All</button>
                <button class="copy">Copy</button>
            </div>
            <div class="tags">
                Tags <i class="fa fa-arrow-circle-right"></i>
                <code><?= $this->e($post->getTags(true)) ?></code>
            </div>
            <?php if ($session->isLogged()): // user is logged ?>
                <form action="<?php echo $path->generateUrl('CommentNew', ['id_post' => $post->getId()]) ?>" method="POST">
                    <br />
                    <textarea name="content" id="" cols="54" rows="3" placeholder="Ecrire un commentaire"></textarea>
                    <br />
                    <button class="commentPublish" name="newComment">Publier le commentaire</button>
                </form>
            <?php endif; ?>
            <h3>Commentaires publiés</h3>
            <div class="zoneComment">
                <table>
                    <?php foreach ($comments as $comment): ?>
                        <tr>
                            <td>
                                <a href="<?php echo $path->generateUrl('UserShow', ['id' => $comment->getUser()->getId()]) ?>">
                                        <?= $this->e($comment->getUser()->getName()) ?>
                                </a>
                                <small>
                                    <?= date('d-m-Y', strtotime($comment->getCreatedAt())) ?>
                                </small>
                            </td>
                        </tr>
                        <tr>
                            <td><?= $this->e($comment->getContent()) ?></td>
                        </tr>

                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>



</main>