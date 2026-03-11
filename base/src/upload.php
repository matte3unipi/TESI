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
    
    // VULNERABILITÀ 1: Accetta qualsiasi tipo di file (anche PHP)
    $filename = $file['name'];
    
    // VULNERABILITÀ 2: Sanitizzazione debole del path
    // Rimuove solo '../' ma non gestisce URL encoding
    $filename = str_replace('../', '', $filename);

    // VULNERABILITÀ CRITICA: Decodifica DOPO il filtro
    // Questo permette a ..%2f di bypassare il filtro
    $filename = rawurldecode($filename);
    
    // Path di destinazione
    $targetPath = 'files/images/' . $filename;
    
    // Sposta il file
    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        $_SESSION['image'] = $filename;
        
        // Messaggio che rivela il path finale
        $message = "The file images/" . $filename . " has been uploaded.";
        header('Location: account.php?success=' . urlencode($message));
    } else {
        header('Location: account.php?error=Upload failed');
    }
} else {
    header('Location: account.php');
}
?>