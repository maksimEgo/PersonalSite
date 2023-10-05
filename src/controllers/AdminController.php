<?php

namespace controllers;

use controllers\Handlers\HandleGallery;
use controllers\Handlers\HandleGuestbookEntry;
use controllers\Handlers\HandleHome;
use models\DB;
use models\GuestbookEntry;
use models\Home;
use models\Log;
use models\Photo;
use models\User;
use views\View;

/**
 * AdminController manages administrative actions and routes.
 *
 * This controller centralizes the logic required for the admin panel, including
 * user authorization, data management for different sections, and routing for various administrative actions.
 */
class AdminController
{
    /**
     * @var User Instance responsible for handling user-related operations.
     */
    protected User $user;
    /**
     * @var View Instance responsible for rendering views.
     */
    protected View $view;

    use HandleHome;
    use HandleGallery;
    use HandleGuestbookEntry;

    /**
     * Initializes a new instance of the AdminController.
     *
     * Sets up the models required for handling home, guestbook, and photo-related operations.
     * Also initializes the session if it hasn't started yet.
     *
     * @param User $user User model instance.
     * @param View $view View instance for rendering views.
     */
    public function __construct(
        User $user,
        View $view
    )
    {
        $this->user = $user;
        $this->view = $view;

        $this->setHomeModel(new Home( new DB() ), new Log() );
        $this->setGuestBookModel(new GuestbookEntry( new DB() ) );
        $this->setPhotoModel(new Photo( new DB() ) );

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Main entry point of the AdminController.
     *
     * Manages user authorization and routes the request to the corresponding section.
     *
     * @return void
     */
    public function index(): void
    {
        ob_start();

        $this->authorizationCheck();

        if( isset( $_SESSION['isAdmin'] ) ) {

            ob_get_clean();

            $this->handleRoute();
        }

        if( ob_get_length() ) {
            ob_get_flush();
        }
    }

    /**
     * Checks if the user is authorized as an administrator.
     *
     * Displays the login template if the user isn't authorized yet.
     * Attempts to authorize the user based on POST data if provided.
     *
     * @return void
     * @throws \Exception If there's an error during the process.
     */
    protected function authorizationCheck() :void
    {
        if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] === false) {
            $this->view->display('admin/login.php');
        }

        if ( 'POST' === $_SERVER['REQUEST_METHOD'] ) {

            if(isset($_POST['login']) && isset($_POST['password'])) {
                $login = $_POST['login'];
                $password = $_POST['password'];

                if ( $this->user->authorization($login, $password) ) {
                    $_SESSION['isAdmin'] = true;

                    ob_get_clean();

                    $this->handleHomeInfo();
                    exit;
                } else {
                    echo 'Authorization error';
                }
            }
        }
    }

    /**
     * Handles the routing for the admin panel.
     *
     * Routes the request to the corresponding section (home, gallery, guestbook, or exit).
     * If the section isn't recognized, it defaults to the main admin panel view.
     *
     * @return void
     * @throws \Exception If there's an error during the routing process.
     */
    protected function handleRoute() :void
    {
        $section = $_GET['section'] ?? 'home';

        switch ($section) {
            case 'home':
                $this->handleHomeInfo();
                break;
            case 'gallery':
                $this->handleGalleryLoad();
                break;
            case 'guestbook':
                $this->handleGuestBook();
                break;
            case 'exit':
                session_unset();
                session_destroy();
                header('Location: /');
                break;
            default:
                $this->view->display('admin/panel.php');
                break;
        }
    }
}