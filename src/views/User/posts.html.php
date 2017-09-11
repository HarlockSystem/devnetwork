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
    var editor;
            $(".ace-editor").each(function (i) {
                editor = ace.edit(this);
                var language = $(this).data("language");
                
                editor.setTheme("ace/theme/' . $session->get('theme') . '");
                editor.getSession().setMode("ace/mode/"+language);
                editor.setOptions({
                    autoScrollEditorIntoView: true,
                    maxLines: 30,
                    minLines: 4
                });
            })
</script>',
])
?>

<main class="wrapper publication">

    <h2>Post de <u><?= $this->e($user->getName()) ?></u></h2>

    <table>
        <?php foreach ($posts as $post): ?>
            <div class="content">
                <div class="titlePublish">
                    <h2 class="titlePublish">
                        <a href="<?= $path->generateUrl('PostShow', ['id' => $post->getId()]) ?>"><?= $this->e($post->getTitle()) ?></a> 
                        par 
                        <?php if($post->getUser()->getStatusUser() == 1): ?>
                        <small style="color:grey"><i>User inactif</i></small>
                        <?php else: ?>
                        <a href="<?php echo $path->generateUrl('UserShow', ['id' => $post->getUser()->getId()]) ?>"><?= $this->e($post->getUser()->getName()) ?></a>
                        <?php endif ?>
                    </h2>
                    <h3 class="datePublished"><?=$user->getCreatedAt() ?></h3>

                </div>
                <?php if ($post->getContentType() == 0): ?>
                    <div class="post_container">

                        <div class="ace-editor" data-language="<?= $this->e($post->getLanguage()) ?>"><?= $this->e($post->getContent()) ?></div>
                        <p>
                            Language: <code><?= $this->e($post->getLanguage()) ?></code>

                        </p>
                        <p>
                            Tags: <code><?= $this->e($post->getTags(true)) ?></code>
                        </p>

                        <div class="bttn_wrapper">
                            <button class="select_all" data-editor="1">Select All</button>
                            <button class="copy" data-editor="1">Copy</button>
                            <?php if ($session->isLogged()): ?>
                                <form action="<?php echo $path->generateUrl('UserFavorite', ['id_post' => $post->getId()]) ?>" method="POST">
                                    <button>Add to Favorite</button>
                                </form>
                            <?php endif ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="post_container"><?= $post->getContent() ?></div>
                <?php endif ?>
            </div>
        <?php endforeach; ?>
    </table>
</main>


