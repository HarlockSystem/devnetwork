<?php
$this->layout('layout', [
    'title' => 'Edit Post #' . $post->getId(),
    'path' => $path,
    'session' => $session,
    'css' => '
    <style type="text/css">
    </style>',
    'js' => '
    <script src="ace/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
    <script>

        /** Default ace editor configuration **/
        var editor = ace.edit("editor");
        var textarea = $(\'textarea[name="content"]\');
        editor.setTheme("ace/theme/' . $session->get('theme') . '");
        editor.getSession().setMode("ace/mode/' . $this->e($post->getLanguage()) . '");
        editor.setOptions({
            autoScrollEditorIntoView: true,
            maxLines: 30,
            minLines: 5,
        });
        editor.getSession().on("change", function () {
            textarea.val(editor.getSession().getValue());
            console.log(editor.getSession().getValue());
        });
    // edit mode
        editor.getSession().setValue(textarea.val())

    </script>'
])
?>
<main class="wrapper publication">
    <div class="content">
        <form id="post_form" method="POST" action="<?php $path->generateUrl('PostEdit', ['id' => $post->getId()]) ?>">
            <input type="hidden" name="_method" value="PUT"/>
            <div class="post_container">
                <input class="titleInPublish" type="text" name="title" id="title" value="<?= $this->e($post->getTitle()) ?>" placeholder="Titre de la publication">
                <div class="zoneDeCode">
                    <div id="editor"></div>
                </div>
                <textarea name="content" cols="30" rows="10" style="display: none"><?= $this->e($post->getContent()) ?></textarea>
            </div>
            <input type="hidden" name="language" value="<?= $this->e($post->getLanguage()) ?>"/>
            <div class="barPublication">
                Language: <u><?= $this->e($post->getLanguage()) ?></u>
            </div>
            <div class="tags"><?php $post->getTags() ?>
                tags: <input type="text" name="tags" value="<?= $this->e($post->getTags(true)) ?>" />
            </div>
            <div>
                <button class="editPubli" type="submit">Sauvegarder</button>
                <a href="<?= $path->generateUrl('PostShow', ['id' => $post->getId()]) ?>">Retour</a>
            </div>
        </form>
    </div>
</main>
