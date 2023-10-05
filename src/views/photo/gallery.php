<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/public/menu.css">
    <link rel="stylesheet" type="text/css" href="/css/public/gallery.css">
    <title>Personal Site!</title>
</head>
<body>

<?php include __DIR__ . '/../home/menu.php'; ?>
<h1>Gallery <br> Here you can see the images.</h1>
<div class="gallery">
    <?php foreach ($this->data['images'] as $image) : ?>
        <a><img src="/images/<?php echo $image['image_path']; ?>" alt="gallery"></a>
    <?php endforeach; ?>
</div>
</body>
</html>
