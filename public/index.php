<?php

use controllers\HomeController;
use models\DB;
use models\Home;
use views\View;

session_start();

require_once __DIR__ . '/autoload.php';

$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'home':
        $controller = new HomeController( new Home( new DB() ), new View() );
        $controller->index();
        break;
    case 'guestbook':
        $controller = new \controllers\GuestbookController( new \models\GuestbookEntry( new DB() ), new View() );
        $controller->index();
        break;
    case 'gallery':
        $controller = new \controllers\PhotoController( new \models\Photo( new DB() ), new View() );
        $controller->index();
        break;
    case 'admin':
        $controller = new \controllers\AdminController( new \models\User( new  DB() ), new View() );
        $controller->index();
        break;
    default:
        echo '404 not found';
        break;
}