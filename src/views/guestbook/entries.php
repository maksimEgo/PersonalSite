<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/public/menu.css">
    <link rel="stylesheet" type="text/css" href="/css/public/guestbook.css">
    <title>GuestBook</title>
</head>
<body>
<?php include __DIR__ . '/../home/menu.php'; ?>
<h1>Guest Book
    <br>Here you can leave a review about the site.
</h1>

<table>
    <tr>
        <th>User</th>
        <th>Text</th>
    </tr>
    <?php foreach ($this->data['entries'] as $entry) : ?>
        <tr>
            <td><?php echo $entry['user_name']; ?></td>
            <td><?php echo $entry['entry_text']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<hr>
<form action="" method="post" enctype="multipart/form-data">
    <input type="text" name="nameUser" placeholder="Your name">
    <input type="text" name="message" placeholder="Your message">
    <button type="submit">Send</button>
</form>
</body>
</html>

