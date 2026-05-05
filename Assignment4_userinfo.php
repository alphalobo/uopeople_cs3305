<?php
// Get the 'name' parameter from the query string, escape it for output
$name = htmlspecialchars($_GET['name'] ?? '');
// Get the 'email' parameter from the query string, escape it for output
$email = htmlspecialchars($_GET['email'] ?? '');
// Get the 'user_id' parameter from the query string, escape it for output
$user_id = htmlspecialchars($_GET['user_id'] ?? '');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User Info</title>
</head>
<body>
    <?php if ($name || $email || $user_id): ?>
        <!-- Only show the user info section if at least one value is present -->
        <h2>User info</h2>
        <p>Name: <?= $name ?></p> <!-- Display the given user name -->
        <p>Email: <?= $email ?></p> <!-- Display the given user email -->
        <p>User ID: <?= $user_id ?></p> <!-- Display the generated user ID -->
    <?php endif; ?>
</body>
</html>