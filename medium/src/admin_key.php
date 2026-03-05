<?php
# Pagina link forbidden per l'admin key
http_response_code(403);
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>403 Forbidden</title>
</head>
<body>
    <h1>403 Forbidden</h1>
    <p>Access denied. Admin credentials required.</p>
    <p><small>Resource: /home/bob/secret</small></p>
</body>
</html>