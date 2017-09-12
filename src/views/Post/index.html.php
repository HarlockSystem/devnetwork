<?php
$this->layout('layout', [
    'title' => 'Index Posts',
    'path' => $path,
    'session' => $session,
    'css' => '
    <link rel="stylesheet" href="trumbowyg/css/trumbowyg.css">        
    ',
    'js' => '
    <script src="trumbowyg/trumbowyg.js"></script>
    <script src="ace/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
    <script>
        $.trumbowyg.svgPath = "trumbowyg/ui/icons.svg"
        $(".editor").trumbowyg();
        var editor = [];
        $(".ace-editor").each(function (i) {
            editor[i] = ace.edit(this);
            var language = $(this).data("language");
            editor[i].setTheme("ace/theme/' . $session->get('theme') . '");
            editor[i].getSession().setMode("ace/mode/"+language);
            editor[i].$blockScrolling = Infinity;
            editor[i].setReadOnly(true);
            editor[i].setOptions({
                autoScrollEditorIntoView: true,
                maxLines: 30,
                minLines: 4
            });
        })
    </script>
    <script src="js/harlokscript.js" type="text/javascript" charset="utf-8"></script>',
    ])
    ?>
    <main class="wrapper aligner publication">  
        <div class="" style="text-align: center">
            <?php if ($page - 1 > 0): ?>
                <a href="<?= $path->generateUrl('Posts', ['page' => $page - 1]) ?>">prev</a>
            <?php endif ?>
            <?php if ($page + 1 > 0): ?>
                |<a href="<?= $path->generateUrl('Posts', ['page' => $page + 1]) ?>">next</a>
            <?php endif ?>
        </div>
        <table>
            <?php $i=0; foreach ($posts as $post): ?>
            <div class="content contentFix">
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
                        <div class="ace-editor" data-language="<?= $this->e($post->getLanguage()) ?>" data-snippet="<?= $this->e($post->getContentType()) ?>"><?= $this->e($post->getContent()) ?></div>


                        <div class="tags">
                            Tags <i class="fa fa-arrow-circle-right"></i>
                            <code><?= $this->e($post->getTags(true)) ?></code>
                        </div>


                        <div class="inlineButton">
                            <button class="select_all" data-editor="<?=$i?>">Select All</button>
                            <button class="copy">Copy</button>

                        <?php if ($session->isLogged()): ?>
                            <form action="<?php echo $path->generateUrl('UserFavorite', ['id_post' => $post->getId()]) ?>" method="POST">
                                <button class="add_favorite">Add to <i class="fa fa-heart" aria-hidden="true"></i></button>
                            </form>
                        <?php endif ?>
                        <?php if ($session->isUser($post->getUser()->getId())): ?>
                            <form action="<?php echo $path->generateUrl('PostDelete', ['id' => $post->getId()]) ?>" method="POST">
                                <input type="hidden" name="_method" value="DELETE" />
                                <button class="deleteBTN">Supprimer</i>
                                </button>
                            </form>
                            </div> 
                        <?php endif ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="post_container"  id="editor<?=$i?>" data-snippet="<?= $this->e($post->getContentType()) ?>"><?= strip_tags($post->getContent(), '<p><h2><h1><h3><h4><em><blockquote><strong><br><ul><li><ol><strike>') ?></div>
            <?php endif ?>
        </div>
        <?php $i++; endforeach; ?>


    </table>
    <div class="" style="text-align: center">
        <?php if ($page - 1 > 0): ?>
            <a href="<?= $path->generateUrl('Posts', ['page' => $page - 1]) ?>">prev</a>
        <?php endif ?>
        <?php if ($page + 1 > 0): ?>
            |<a href="<?= $path->generateUrl('Posts', ['page' => $page + 1]) ?>">next</a>
        <?php endif ?>
    </div>
</main>