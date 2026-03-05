<?php
// filepath: src/account.php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: index.php');
    exit;
}

$image = $_SESSION['image'] ?? null;
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
        }
        .image-container {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: #ddd;
            margin: 20px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;
            overflow: hidden;
        }
        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        input[type="file"] {
            padding: 10px;
            margin: 10px 0;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #333;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background: #555;
        }
        .message {
            padding: 10px;
            margin: 10px 0;
            background: #d4edda;
            border-radius: 5px;
        }
        .error {
            background: #f8d7da;
        }
        a {
            color: #333;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Account: <?= htmlspecialchars($_SESSION['username']) ?></h1>
    
    <?php if (isset($_GET['success'])): ?>
        <div class="message"><?= htmlspecialchars($_GET['success']) ?></div>
    <?php endif; ?>
    
    <?php if (isset($_GET['error'])): ?>
        <div class="message error"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>
    
    <h2>Image</h2>
    <div class="image-container">
        <?php if ($image): ?>
            <img src="files/images/<?= htmlspecialchars($image) ?>" alt="Profile Image">
        <?php else: ?>
            🖼️
        <?php endif; ?>
    </div>
    
    <h3>Upload Image</h3>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*" required>
        <button type="submit">Upload</button>
    </form>
    
    <p><a href="index.php?logout=1">← Logout</a></p>
</body>
</html>