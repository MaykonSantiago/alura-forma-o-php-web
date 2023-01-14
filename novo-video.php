<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$url   = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
$title = filter_input(INPUT_POST, 'titulo');

if ($url === false || $title === false ) {
    header('Location: index.php?success=0');
    exit();
}

$query = 'INSERT INTO videos (url, title) VALUES (:url, :title)';
$stmt = $pdo->prepare($query);
$stmt->bindValue(1, $url);
$stmt->bindValue(2, $title);

if ($stmt->execute() === false) {
    header('Location: index.php?success=0');
} else {
    header('Location: index.php?success=1');
}
