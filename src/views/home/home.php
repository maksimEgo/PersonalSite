<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/public/menu.css">
    <link rel="stylesheet" type="text/css" href="/css/public/home.css">
    <title>Personal Site!</title>
</head>
<body>
<?php include __DIR__ . '/menu.php'; ?>
<h1>My personal site on PHP 8.X</h1>
<div class="content">
    <p><b>This is information about me:</b></p>
    <p><?php echo $this->data['text_info']; ?></p>
</div>
</body>
</html>