<?php 

$id = $_GET['user'];

$pdo = new PDO('mysql:host=was132-desktop;dbname=devnetwork', 'blog', 'blog', [
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$pdo->exec('SET NAMES UTF8');

$query = $pdo->prepare('SELECT * FROM `` WHERE id=?');

$query->execute([$id]);

$user = $query->fetchAll();

foreach ($infos as $key => $user) {
}

include 'views/profil_public_editable.phtml';