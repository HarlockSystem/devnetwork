<?php 

$id = $_GET['article'];

$pdo = new PDO('mysql:host=was132-desktop;dbname=devnetwork', 'blog', 'blog', [
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$pdo->exec('SET NAMES UTF8');

$query = $pdo->prepare('SELECT * FROM `` WHERE id=?');

$query->execute([$id]);

$articles = $query->fetchAll();

foreach ($articles as $key => $article) {
}

include 'views/article.phtml';