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
    $(".editor").trumbowyg({btns: [
                    ["formatting"],
                    "btnGrp-semantic",
                    "btnGrp-justify",
                    "btnGrp-lists",
                    ["horizontalRule"],
                    ["removeformat"],
                    ["fullscreen"]
                    ]});
</script>
    '
])
?>
<main class="wrapper aligner publication">
    <div class="content">
        <form id="post_form" method="POST" action="<?php $path->generateUrl('PostNew', ['type' => 'text']) ?>">

            <div class="post_container">
                <input class="titleInPublish" type="text" name="title" id="title" placeholder="Titre de la publication">
                <textarea name="content" class="editor" cols="30" rows="10"></textarea>
            </div>
            <div>
                <button class="editPubli" type="submit">Publier</button>
            </div>
        </form>
    </div>
</main>