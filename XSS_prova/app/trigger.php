<!DOCTYPE html>
<html lang="it">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Trigger Vittima - Test Manuale</title>
	<style>
		body { 
			font-family: Arial, sans-serif; 
			max-width: 760px; 
			margin: 36px auto; 
			padding: 0 16px; 
		}

		.card { 
			border: 1px solid #ddd; 
			padding: 16px; 
			border-radius: 8px; 
			margin: 16px 0; 
		}

		code { 
			background: #f5f5f5; 
			padding: 2px 6px; 
			border-radius: 3px; 
		}
		pre { 
			background: #f5f5f5; 
			padding: 12px; 
			border-radius: 6px; 
			overflow-x: auto; 
		}
	</style>

	<script>
		document.addEventListener('DOMContentLoaded', function() {
			document.getElementById('btn').addEventListener('click', function() {
				document.cookie = "flag=SNH{the_B3ANS_were_not_much_g00d_4nywaY}; path=/; domain=localhost";
			});
		});

	</script>
</head>
<body>
	<h1>Test Payload XSS</h1>
	<div class="card">
		<h2>Test XSS - Guida Step by Step</h2>
		<p><strong>Paso 1: Salva il payload</strong></p>
		<ol>
			<li>Vai a <a href="index.php">index.php (home)</a></li>
			<li>Copia uno dei payload di test dal box sotto</li>
			<li>Incollalo nella textarea e premi "Salva"</li>
		</ol>
		
		<p><strong>Paso 2: Prepara il cookie flag</strong></p>
		<ol>
			<li>Apri <a href="view.php">view.php</a> in questa stessa finestra</li>
			<li>Premi <code>F12</code> per aprire DevTools</li>
			<li>Vai a <code>Application → Cookies → http://localhost</code></li>
			<li>Clicca il bottone <code>+</code> e crea un nuovo cookie:
				<ul>
					<li><strong>Name:</strong> <code>flag</code></li>
					<li><strong>Value:</strong> <code>SNH{the_B3ANS_were_not_much_g00d_4nywaY}</code></li>
					<li><strong>Domain:</strong> <code>localhost</code> (oppure lascia vuoto)</li>
				</ul>
			</li>
			<li>Premi Invio e chiudi DevTools (o tienilo aperto)</li>
		</ol>
		
		<p><strong>Paso 3: Verifica l'esecuzione del payload</strong></p>
		<ol>
			<li>Ricarica <code>view.php</code> (F5 o Ctrl+R)</li>
		</ol>

		<button id="btn">Inserisci cookie</button>
	</div>
	<div class="card">
		<h2>Payload di test suggerito</h2>
		<pre>&lt;script&gt; alert('XSS Eseguito! Flag: ' + document.cookie); &lt;/script&gt;</pre>
	</div>
	<p><a href="index.php">← Torna alla home</a></p>
</body>
</html>