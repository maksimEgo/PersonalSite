<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/public/menu.css">
    <link rel="stylesheet" type="text/css" href="/css/admin/add_image_gallery.css">
    <title>Personal Site!</title>
</head>
<body>
<?php include __DIR__ . '/menu.php'; ?>
<h1>Admin Image Upload</h1>
<div class="container">
    <div class="centered-form">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="image" id="fileInput">
            <label for="fileInput">Choose an image</label>
            <button type="submit">Upload</button>
        </form>
    </div>
</div>
</body>
</html>

