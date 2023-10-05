<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/public/menu.css">
    <link rel="stylesheet" type="text/css" href="/css/admin/delete_entry_guestbook.css">
    <title>GuestBook</title>
</head>
<body>
<?php include __DIR__ . '/menu.php'; ?>
<h1>GuestBook</h1>
<div class="container">
    <table>
        <tr>
            <th>Id</th>
            <th>User</th>
            <th>Text</th>
            <th>Action</th>
        </tr>
        <?php foreach ($this->data['entries'] as $entry) : ?>
            <tr>
                <td><?php echo $entry['entry_id']; ?></td>
                <td><?php echo $entry['user_name']; ?></td>
                <td><?php echo $entry['entry_text']; ?></td>
                <td>
                    <form action="/?page=admin&section=guestbook" method="post">
                        <input type="hidden" name="id" value="<?php echo $entry['entry_id']; ?>">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>

