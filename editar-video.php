<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
$title = filter_input(INPUT_POST, 'titulo');
$id = filter_input(INPUT_GET, 'id');

$query = 'UPDATE videos SET url = :url, title = :title WHERE id = :id';

$stmt = $pdo->prepare($query);
$stmt->bindValue(':url', $url);
$stmt->bindValue(':title', $title);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

if ($stmt->execute() === false) {
    header('Location: /?success=0');
} else {
    header('Location: /?success=1');
}
