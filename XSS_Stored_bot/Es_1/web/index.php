<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $comment = $_POST['comment'];

    if (!preg_match('/^[a-zA-Z0-9 ]+$/', $name)) {
        header('Location: index.php?error=Invalid+name+format');
        exit;
    }

    $entry = "<p><strong>" . $name . ":</strong> " . $comment . "</p>" . PHP_EOL;
    file_put_contents('comments.txt', $entry, FILE_APPEND);
    header('Location: index.php?success=Comment+added');
    exit;
}
?>
<html>
<head>
    <title>Comment page</title>

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
    <h1>Comment page</h1>

    <form method="post" action="index.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" pattern="^[a-zA-Z0-9 ]+$" required>

        <label for="comment">Comment:</label>
        <textarea id="comment" name="comment" rows="4" required></textarea>

        <input type="submit" value="Submit">
    </form>

    <p><a href="view.php">View Comments</a></p>
</body>
</html>