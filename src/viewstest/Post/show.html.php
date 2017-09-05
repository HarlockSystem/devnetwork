<?php 
$data = [
    'title' => 'Post Show',
];
$this->layout('layout', $data);
?>

getId: <?=$post->getId() ?><br />
getTitle: <?=$post->getTitle() ?><br />
getContentType: <?=$post->getContentType() ?><br />
getCreatedAt: <?=$post->getCreatedAt() ?><br />
getUpdatedAt: <?=$post->getUpdatedAt() ?><br />
getStatusPost: <?=$post->getStatusPost() ?><br />
<hr />
user: <br />
<?php $user = $post->getUser() ?>
getId: <?=$user->getId() ?><br />
getLogin: <?=$user->getLogin() ?><br />

