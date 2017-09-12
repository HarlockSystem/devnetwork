<?php
$this->layout('layout', [
    'title' => 'User edit',
    'path' => $path,
    'session' => $session
])
?>
<main class="wrapper aligner profil">
    <h2>User: <?=$this->e($user->getName())?> (<?=$user->getId()?>)</h2>
    <form action="<?php echo $path->generateUrl('UserEdit', ['id' => $user->getId()]) ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT" />
        <h2>FirstName</h2>
        <input type="text" name="firstname" value="<?= $this->e($user->getFirstName()) ?>" />
        <h2>LastName</h2>
        <input type="text" name="lastname" value="<?= $this->e($user->getLastName()) ?>" />
        <h2>Skill</h2>
        <textarea name="skill" id="" cols="30" rows="10"><?= $this->e($user->getSkill()) ?></textarea>
        <h2>Jobs</h2>
        <textarea name="jobs" id="" cols="30" rows="10"><?= $this->e($user->getJobs()) ?></textarea>
        <h2>Bio</h2>
        <textarea name="bio" id="" cols="30" rows="10"><?= $this->e($user->getBio()) ?></textarea>
        <h2>Img</h2>
        <input type="file" name="img" value="<?= $this->e($user->getImg()) ?>" />
        <h2>Theme</h2>
        <select id="theme" name="theme">
            <option value="<?= $this->e($user->getTheme()) ?>" selected><?= $this->e($user->getTheme()) ?></option>
            <option value="ambiance">ambiance</option>
            <option value="chaos">chaos</option>
            <option value="chrome">chrome</option>
            <option value="clouds">clouds</option>
            <option value="clouds_midnight">clouds_midnight</option>
            <option value="cobalt">cobalt</option>
            <option value="crimson_editor">crimson_editor</option>
            <option value="dawn">dawn</option>
            <option value="dreamweaver">dreamweaver</option>
            <option value="eclipse">eclipse</option>
            <option value="github">github</option>
            <option value="gob">gob</option>
            <option value="gruvbox">gruvbox</option>
            <option value="idle_fingers">idle_fingers</option>
            <option value="iplastic">iplastic</option>
            <option value="katzenmilch">katzenmilch</option>
            <option value="kr_theme">kr_theme</option>
            <option value="kuroir">kuroir</option>
            <option value="merbivore">merbivore</option>
            <option value="merbivore_soft">merbivore_soft</option>
            <option value="mono_industrial">mono_industrial</option>
            <option value="monokai">monokai</option>
            <option value="pastel_on_dark">pastel_on_dark</option>
            <option value="solarized_dark">solarized_dark</option>
            <option value="solarized_light">solarized_light</option>
            <option value="sqlserver">sqlserver</option>
            <option value="terminal">terminal</option>
            <option value="textmate">textmate</option>
            <option value="tomorrow">tomorrow</option>
            <option value="tomorrow_night">tomorrow_night</option>
            <option value="tomorrow_night_blue">tomorrow_night_blue</option>
            <option value="tomorrow_night_bright">tomorrow_night_bright</option>
            <option value="tomorrow_night_eighties">tomorrow_night_eighties</option>
            <option value="twilight">twilight</option>
            <option value="vibrant_ink">vibrant_ink</option>
            <option value="xcode">xcode</option>
        </select>
        <br />
        <br />
        <button type="submit">Send</button>
        <a href="<?php echo $path->generateUrl('UserShow', ['id' => $user->getId()]) ?>">Show</a>
    </form>
</main>