<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $url = $_POST['url'];
    $desc = $_POST['desc'];

    if(!preg_match('/^[a-zA-Z0-9 ]+$/', $name) || !preg_match('/^[a-zA-Z0-9 ]+$/', $desc)) {
        header('Location: index.php?error=Input+non+valido+-+solo+caratteri+alphanumeric+e+spazi+permessi');
        exit;
    }

    // Filtro che blocca vari pattern pericolosi nell'URL
    if (preg_match('/["\']|javascript:|<|>|\bon\w+\s*=/i', $url)) {
        header('Location: index.php?error=URL+bloccato+-+contenuto+non+permesso');
        exit;
    }


    // Crea automaticamente un link cliccabile con l'URL fornito
    $entry = "<p><strong>Nome prodotto:</strong> " . htmlspecialchars($name) . "<br>" .
             "<strong>Link prodotto:</strong> <a href=\"" . $url . "\"> Clicca qui </a><br>" .
             "<strong>Descrizione prodotto:</strong> " . htmlspecialchars($desc) .
             "</p>" . PHP_EOL;
    file_put_contents('comments.txt', $entry, FILE_APPEND);
    
    header('Location: view.php');
    exit;
}
?>
<html>
<head>
    <title>Share product</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-image: linear-gradient(to right, #f8f9fa, #2a4662);
        }
        h1 {
            color: #333;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background: #333;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        input[type="submit"]:hover {
            background: #555;
        }
        a {
            color: #333;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Share a Product</h1>

    <?php if (isset($_GET['error'])): ?>
        <p style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px;">
            <?= htmlspecialchars($_GET['error']) ?>
        </p>
    <?php endif; ?>

    <form method="post" action="index.php">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" pattern="^[a-zA-Z0-9 ]+$" required>

        <label for="url">Product Link:</label>
        <input type="text" id="url" name="url" placeholder="https://example.com" required>

        <label for="desc">Product Description:</label>
        <input type="text" id="desc" name="desc" pattern="^[a-zA-Z0-9 ]+$" required>

        <input type="submit" value="Upload">
    </form>

    <p><a href="view.php">View Shared Products</a></p>
</body>
</html>