<html>
<head>
    <title>Shared Links</title>

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
        p {
            background-color: #f4f4f4;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
        }
        p a {
            color: #007BFF;
            font-weight: bold;
        }
        p a:hover {
            text-decoration: underline;
        }
        body > a {
            color: #333;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }
        body > a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Shared Products</h1>
    <?php
    $comments = file_get_contents('comments.txt');
    if ($comments) {
        echo $comments;
    } else {
        echo "<p>No products.</p>";
    }
    ?>
    <a href="index.php">Share a Product</a>

    <p>
    <?php
    if (!isset($_GET['bot'])) {
        system("python3 check_attack.py http://localhost/view.php?bot=1");
    }
    ?>
    </p>
</body>
</html>
