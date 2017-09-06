<?php
$this->layout('layout', [
    'title' => 'New Post',
    'path' => $path
])
?>

<form action="<?php echo $path->generateUrl('PostNew') ?>" method="POST">

    <input type="text" name="title" placeholder="title"/>
    <br />
    <input type="text" name="content" placeholder="content"/>
    <br />
    <select name="content_type" id="">
        <option value="0">Snippet</option>
        <option value="01">Text</option>
    </select>
    <hr />
    <input type="text" name="tags" placeholder="tags"/>
    <br />
    <button name="newPost">Create</button>

</form>