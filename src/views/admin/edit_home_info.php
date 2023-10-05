<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/public/menu.css">
    <link rel="stylesheet" type="text/css" href="/css/admin/edit_home_info.css">
    <title>Edit Home page</title>
</head>
<body>
<?php include __DIR__ . '/menu.php'; ?>
<h1>Редактировать информацию на домашней странице</h1>
<div class="container">
    <form action="" method="post">
        <textarea name="text_info" rows="10" cols="50"><?php echo htmlspecialchars($this->data['text_info']); ?></textarea>
        <br>
        <button type="submit">Сохранить изменения</button>
    </form>
</div>
</body>
</html>

