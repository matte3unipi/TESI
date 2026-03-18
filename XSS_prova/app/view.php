<?php
require __DIR__ . '/db.php';

$rows = $pdo->query('SELECT id, body, created_at FROM messages ORDER BY id DESC')->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="it">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bacheca</title>
	<style>
		body { font-family: Arial, sans-serif; max-width: 760px; margin: 36px auto; padding: 0 16px; }
		.msg { border: 1px solid #ddd; border-radius: 8px; padding: 12px; margin-bottom: 10px; }
		.meta { color: #555; font-size: 12px; margin-bottom: 8px; }
	</style>
</head>
<body>
	<h1>Bacheca</h1>
	<p><a href="index.php">Torna alla home</a></p>

	<?php if (count($rows) === 0): ?>
		<p>Nessun messaggio.</p>
	<?php else: ?>
		<?php foreach ($rows as $row): ?>
			<div class="msg">
				<div class="meta">#<?php echo (int)$row['id']; ?> - <?php echo htmlspecialchars((string)$row['created_at'], ENT_QUOTES, 'UTF-8'); ?></div>
				<?php
				echo $row['body'];
				?>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
</body>
</html>
