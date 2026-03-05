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

    // Whitist estensionie e MIME types
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $allowed_mimes = ['image/jpeg', 'image/png', 'image/gif'];

    // Limite dimensione (es. 3MB)
    $maxFileSize = 3 * 1024 * 1024; // 3MB in bytes
    if ($file['size'] > $maxFileSize) {
        header('Location: account.php?error=' . urlencode('File too large. Max 3MB allowed.'));
        exit;
    }

    // Path traversal protezione
    $filename = basename($file['name']);
    $path = "files/images/" . $filename;

    $targetPath = "files/images/" . $filename;

    // Verifico MIME type
    $info = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($info, $file['tmp_name']);
    finfo_close($info);

    if (!in_array($mimeType, $allowed_mimes)) {
        header('Location: account.php?error=' . urlencode('Invalid file content. Not a real image.'));
        exit;
    }

    // Spiraglio per Obscured Files 
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $extension = strtolower($extension);

    if(!in_array($extension, $allowed_extensions)) {
        header('Location: account.php?error=' . urlencode('Invalid file type. Only JPG, PNG, GIF allowed.'));
        exit;
    }

    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        $_SESSION['image'] = $filename;
        header('Location: account.php?success=' . urlencode('File uploaded: ' . $filename));
        exit;
    } else {
        header('Location: account.php?error=' . urlencode('Failed to save file'));
        exit;
    }
} else {
    header('Location: account.php');
}
?>

