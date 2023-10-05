<?php
$currentPage = $_GET['page'] ?? 'home';
$currentSection = $_GET['section'] ?? null;
?>

<ul>
    <li><a href="/?page=admin&section=home" <?= ($currentPage == 'admin' && $currentSection == 'home') ? 'class="active"' : ''; ?>>Home</a></li>
    <li><a href="/?page=admin&section=guestbook" <?= ($currentPage == 'admin' && $currentSection == 'guestbook') ? 'class="active"' : ''; ?>>Guestbook</a></li>
    <li><a href="/?page=admin&section=gallery" <?= ($currentPage == 'admin' && $currentSection == 'gallery') ? 'class="active"' : ''; ?>>Gallery</a></li>
    <li><a href="/?page=admin&section=exit" <?= ($currentPage == 'home'  && $currentSection == 'exit') ? 'class="active"' : ''; ?>>Exit</a></li>
</ul>