<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

echo $pdo->exec('ALTER TABLE videos ADD COLUMN image_path TEXT');
