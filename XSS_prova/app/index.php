<!DOCTYPE html>
<html lang="it">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>XSS Stored Lab</title>
	<style>
		body { 
			font-family: Arial, sans-serif; 
			max-width: 760px; 
			margin: 36px auto; 
			padding: 0 16px; 
		}

		textarea {
			width: 100%; 
			min-height: 120px; 
		}

		.card { 
			border: 1px solid #ddd; 
			padding: 16px; 
			border-radius: 8px; 
		}

		.row { 
			display: flex; 
			gap: 12px; 
			margin-top: 12px; 
		}

		button, a.btn { 
			padding: 8px 12px; 
			border-radius: 6px; 
			border: 1px solid #222; 
			text-decoration: none; 
			color: #111; 
		}
	</style>
</head>
<body>
	<h1>XSS Stored Lab</h1>
	<p>Inserisci un contenuto che verra salvato e mostrato in bacheca.</p>

	<div class="card">
		<form action="save.php" method="post">
			<label for="body">Messaggio</label><br>
			<textarea id="body" name="body" required></textarea><br>
			<div class="row">
				<button type="submit">Salva</button>
				<a class="btn" href="view.php">Apri bacheca</a>
				<a class="btn" href="trigger.php">Trigger vittima (stub)</a>
			</div>
		</form>
	</div>
</body>
</html>
