<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('Location: index.php');
	exit;
}

require __DIR__ . '/db.php';

$body = $_POST['body'] ?? '';

$stmt = $pdo->prepare('INSERT INTO messages (body) VALUES (:body)');
$stmt->execute([':body' => $body]);

header('Location: view.php');
exit;
?>
