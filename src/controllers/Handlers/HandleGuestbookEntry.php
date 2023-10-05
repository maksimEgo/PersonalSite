<?php

namespace controllers\Handlers;

use models\GuestbookEntry;

/**
 * The HandleGuestbookEntry trait provides methods for managing the GuestBook section in the admin panel.
 *
 * This trait is designed to be used by controllers that require functionalities for
 * deleting guestbook entries and displaying the related admin panel views.
 */
trait HandleGuestbookEntry
{
    /**
     * @var GuestbookEntry Model responsible for managing guestbook-related operations.
     */
    protected GuestbookEntry $guestbookModel;

    /**
     * Set the GuestbookEntry model for guestbook handling.
     *
     * @param GuestbookEntry $guestbookEntry The guestbook model instance.
     * @return void
     */
    public function setGuestBookModel(GuestbookEntry $guestbookEntry) :void
    {
        $this->guestbookModel = $guestbookEntry;
    }

    /**
     * Handle the management of the guestbook section in the admin panel.
     *
     * Tries to delete a guestbook entry if POST data is received. In any case, displays
     * the guestbook management template afterward.
     *
     * @return void
     * @throws \Exception If there's an error during the deletion process.
     */
    public function handleGuestBook(): void
    {
        try {
            $this->deleteEntry();
        } catch (\Exception $exception) {
            throw new \Exception('Cant delete' . $exception->getTraceAsString() );
        } finally {
            $this->displayGuestBookTemplate();
        }
    }

    /**
     * Attempt to delete a guestbook entry based on POST data.
     *
     * Validates the received data, checks if the entry exists, and then tries to delete it.
     * Redirects to the guestbook section in the admin panel if the deletion is successful.
     *
     * @return void
     * @throws \Exception If there's an error during the deletion process.
     */
    protected function deleteEntry() :void
    {
        if('POST' === $_SERVER['REQUEST_METHOD'] && !empty($_POST['id'])) {
            $id = intval($_POST['id']);
            if($id > 0) {
                if($this->guestbookModel->deleteEntry($id)) {
                    header('Location: /?page=admin&section=guestbook');
                } else {
                    echo 'Cant delete this entity';
                }
            }
        }
    }

    /**
     * Displays the template for managing guestbook entries in the admin panel.
     *
     * Gathers all guestbook entries and assigns them to the view, then displays the management template.
     *
     * @return void
     */
    protected function displayGuestBookTemplate() :void
    {
        $entries = $this->guestbookModel->getEntry();

        $this->view->assign('entries', $entries);
        $this->view->display('admin/delete_entry_guestbook.php');
    }
}