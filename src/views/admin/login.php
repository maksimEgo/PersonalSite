<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/admin/login.css">
    <title>Personal Site!</title>
</head>
<body>
<?php if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] === false): ?>
<form action="" method="post">
    <input type="text" name="login" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <button type="submit">Login</button>
</form>
<?php endif; ?>
</body>
</html>

