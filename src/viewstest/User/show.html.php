<?php 
$this->layout('layout', [
    'title' => 'User profile',
    'path' => $path
    ]) ?>

getId: <?=$user->getId()?><br>
getLogin: <?=$user->getLogin()?><br>
getPassword: <?=$user->getPassword()?><br>
