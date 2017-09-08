<?php foreach ($flashMsg as $msg) : ?>
<div><?= $this->e($msg['type']) ?> -- <?= $this->e($msg['msg']) ?></div>
<?php endforeach; ?>

