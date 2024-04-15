<?php

include __DIR__ . '/includes/dbconnect.php';

$id = $_GET['id'];
$stmt = $pdo->prepare('DELETE FROM libri WHERE id = ?');
$stmt->execute([$id]);

header("Location: index.php");