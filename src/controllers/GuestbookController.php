<?php

namespace controllers;

use models\GuestbookEntry;
use Exception;
use views\View;

/**
 * Controller responsible for managing the guest book operations.
 *
 * Provides methods for displaying guest book entries and adding new entries.
 */
class GuestbookController
{
    /**
     * @var GuestbookEntry Model instance for handling data related to guest book entries.
     */
    protected GuestbookEntry $guestbookEntry;

    /**
     * @var View Instance responsible for rendering views.
     */
    protected View $view;

    /**
     * Initializes a new instance of the GuestbookController.
     *
     * @param GuestbookEntry $guestbookEntry The guestbook entry model instance.
     * @param View $view The view instance for rendering views.
     */
    public function __construct(
        GuestbookEntry $guestbookEntry,
        View $view
    )
    {
        $this->guestbookEntry = $guestbookEntry;
        $this->view = $view;
    }

    /**
     * Displays the main guestbook page.
     *
     * Attempts to add a new guestbook entry if the request method is POST.
     * If successful, it then displays all the guestbook entries.
     *
     * @return void
     * @throws Exception If an error occurs while adding an entry.
     */
    public function index(): void
    {
        try {
            $this->addEventBookEntry();
        } catch (\Exception $exception) {
            throw new Exception('Error adding entry');
        } finally {
            $entries = $this->guestbookEntry->getEntry();

            $this->view->assign('entries', $entries);
            $this->view->display('guestbook/entries.php');
        }
    }

    /**
     * Handles the addition of a new guestbook entry.
     *
     * Checks if the request method is POST and retrieves the user and message data from
     * the POST variables. If both are present, it adds a new guestbook entry.
     *
     * @return void
     * @throws \Exception If an error occurs while adding the entry.
     */
    protected function addEventBookEntry(): void
    {
        if ('POST' === $_SERVER['REQUEST_METHOD'] && !is_null($_POST)) {
            $message = $_POST['message'];
            $user = $_POST['nameUser'];

            $this->guestbookEntry->addEntry($user, $message);
        }
    }
}