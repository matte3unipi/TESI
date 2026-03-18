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
    $maxFileSize = 3 * 1024 * 1024; 
    if ($file['size'] > $maxFileSize) {
        header('Location: index.php?error=' . urlencode('File too large. Max 3MB allowed.'));
        exit;
    }

    // Verifico size image caricata (> 0) e presenza dimensioni
    $imgInfo = getimagesize($file['tmp_name']);
    if ($imgInfo === false || $imgInfo[0] <= 0 || $imgInfo[1] <= 0) {
        header('Location: index.php?error=' . urlencode('Size image invalid.'));
        exit;
    }

    $filename = basename($file['name']);

    // Verifico MIME type
    $info = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($info, $file['tmp_name']);
    finfo_close($info);

    if (!in_array($mimeType, $allowed_mimes)) {
        header('Location: index.php?error=' . urlencode('Invalid file content. Not a real image.'));
        exit;
    }

    # Controllo che sia presente un'estensione valida (case-insensitive)
    $filenameLower = strtolower($filename);
    $isAllowed = false;
    foreach ($allowed_extensions as $ext) {
        if (strpos($filenameLower, $ext) !== false) {
            $isAllowed = true;
            break;
        }
    }

    if (!$isAllowed) {
        header('Location: index.php?error=' . urlencode('Invalid file type. Only JPG, PNG, GIF allowed.'));
        exit;
    }

    # Protezione contro nomi file pericolosi e collisioni
    $safeName = uniqid('img_', true) . '_' . $filename;

    # Protezione path traversal
    $targetPath = 'files/images/' . $safeName;


    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        $_SESSION['image'] = $safeName;
        header('Location: index.php?success=' . urlencode('File uploaded: ' . $safeName));
        exit;
    } else {
        header('Location: index.php?error=' . urlencode('Failed to save file'));
        exit;
    }
} else {
    header('Location: index.php');
}
?>

