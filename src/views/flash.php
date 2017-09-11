<?php foreach ($flashMsg as $msg) : ?>
<div class="flashMsg flashMsg-<?=$this->e($msg['type']) ?>"><?= $this->e($msg['msg']) ?> <span>X</span></div>
<?php endforeach; ?>

