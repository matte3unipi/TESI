<?php
// filepath: src/index.php
session_start();

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

// Se già loggato, redirect
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: account.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($username === 'admin' && $password === 'admin') {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        header('Location: account.php');
        exit;
    } else {
        $error = 'Credenziali non valide';
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 400px;
            margin: 150px auto;
            padding: 20px;
            background-image: linear-gradient(to right, #f8f9fa, #2a4662);
        }

        form {
            background: rgba(255, 255, 255, 0.281);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        input {
            width: 94%;
            margin: 10px 20px 10px 0;
            padding: 10px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            background: #333;
            color: white;
            border: none;
            cursor: pointer;
        }

        .error {
            color: red;
            display: none;
        }
    </style>
</head>
<body>
    <h1>Login</h1>
    <form id="loginForm" method="POST">
        <label>Username</label>
        <input type="text" id="username" name="username" required>
        
        <label>Password</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit">Accedi</button>
        <?php if (isset($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
    </form>
    </div>
</body>
</html>