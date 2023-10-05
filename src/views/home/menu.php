<?php $currentPage = $_GET['page'] ?? 'home'; ?>

<ul>
    <li><a href="/?page=home" <?= ($currentPage == 'home') ? 'class="active"' : ''; ?>>Home</a></li>
    <li><a href="/?page=guestbook" <?= ($currentPage == 'guestbook') ? 'class="active"' : ''; ?>>Guestbook</a></li>
    <li><a href="/?page=gallery" <?= ($currentPage == 'gallery') ? 'class="active"' : ''; ?>>Gallery</a></li>
    <li><a href="/?page=admin" <?= ($currentPage == 'admin') ? 'class="active"' : ''; ?>>Login</a></li>
</ul>