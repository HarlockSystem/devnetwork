<?php
$this->layout('layout', [
    'title' => 'Edit Post #'.$post->getId(),
    'path' => $path,
    'session' => $session,
    'css' => '
<link rel="stylesheet" href="trumbowyg/css/trumbowyg.css">        
    ',
    'js' => '
<script src="trumbowyg/trumbowyg.js"></script>
<script>
    $.trumbowyg.svgPath = "trumbowyg/ui/icons.svg"
    $(".editor").trumbowyg();
</script>
    '
])
?>
<main class="wrapper publication">
    <form id="post_form" method="POST" action="<?php $path->generateUrl('PostEdit', ['id' => $post->getId()]) ?>">
        <input type="hidden" name="_method" value="PUT"/>
        <div class="post_container">
            <input type="text" name="title" id="title" value="<?=$this->e($post->getTitle())?>" placeholder="Titre de la publication">
            <textarea name="content" class="editor" cols="30" rows="10"><?=$this->e($post->getContent())?></textarea>
        </div>
        <div>
            <button type="submit">Edit</button>
            <a href="<?= $path->generateUrl('PostShow', ['id' => $post->getId()]) ?>">Show</a>
        </div>
    </form>
</main>


