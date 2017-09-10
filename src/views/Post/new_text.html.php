<?php
$this->layout('layout', [
    'title' => 'New Post',
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
    <form id="post_form" method="POST" action="<?php $path->generateUrl('PostNew', ['type' => 'text']) ?>">

        <div class="post_container">
            <input type="text" name="title" id="title" placeholder="Titre de la publication">
            <textarea name="content" class="editor" cols="30" rows="10"></textarea>
        </div>
        <div>
            <button type="submit">Envoyer</button>
        </div>
    </form>
</main>