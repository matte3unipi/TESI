<?php
// filepath: src/upload.php
session_start();

// Verifica login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $file = $_FILES['image'];
    $baseDir = __DIR__ . '/files/images/';
    
    // Accetta qualsiasi tipo di file (anche PHP)
    $filename = basename($file['name']);
    
    // Real path di destinazione (directory "files/images/")
    $targetPath = $baseDir . $filename;

    $realPath = realpath(dirname($targetPath));
    $realBase = realpath($baseDir);

    // Verifica che il file sia all'interno della directory "files/images/"
    if ($realPath === false || $realBase === false || $realPath !== $realBase) {
        header('Location: index.php?error=Invalid file path');
        exit;
    }
    
    // Sposta il file
    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        $_SESSION['image'] = $filename;
        
        // Messaggio che rivela il path finale
        $message = "The file images/" . $filename . " has been uploaded.";
        header('Location: index.php?success=' . urlencode($message));
    } else {
        header('Location: index.php?error=Upload failed');
    }
} else {
    header('Location: index.php');
}
?>