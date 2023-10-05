<?php

namespace controllers\Handlers;

use models\Home;
use models\Log;

/**
 * The HandleHome trait provides methods for managing the Home page section in the admin panel.
 *
 * This trait is designed to be used by controllers that require functionalities for
 * updating home page information and logging related activities.
 */
trait HandleHome
{
    /**
     * @var Home Model responsible for home page related operations.
     */
    protected Home $homeModel;
    /**
     * @var Log Model responsible for logging actions related to the home page.
     */
    protected Log $logModel;
    /**
     * @var string IP address of the current user.
     */
    protected string $ip;

    /**
     * Set the Home and Log models for home page handling.
     *
     * @param Home $home The Home model instance.
     * @param Log $log The Log model instance.
     * @return void
     */
    public function setHomeModel(Home $home, Log $log): void
    {
        $this->homeModel = $home;
        $this->logModel = $log;
        $this->ip = $_SERVER['REMOTE_ADDR'];
    }

    /**
     * Handle the management of the home page section in the admin panel.
     *
     * Tries to update home page information if POST data is received. In any case, displays
     * the home page management template afterward.
     *
     * @return void
     * @throws \Exception If there's an error during the update process.
     */
    public function handleHomeInfo(): void
    {
        try {
            $this->updateInfo();
        } catch (\Exception $exception) {
            $this->logModel->actionLog('Home info update', 'admin', $this->ip, $exception->getTraceAsString());
            throw new \Exception('Cant update, more info in Error log!');
        } finally {
            $this->displayHomeTemplate();
        }
    }

    /**
     * Attempt to update home page information based on POST data.
     *
     * Validates the received data and then tries to update the home page information.
     * Logs the update action whether it is successful or not.
     *
     * @return void
     */
    protected function updateInfo(): void
    {
        if ('POST' === $_SERVER['REQUEST_METHOD'] && isset($_POST['text_info'])) {
            $text = $_POST['text_info'];
            $this->homeModel->editInfo($text);
            $this->logModel->actionLog('Home info update', 'admin', $this->ip, 'Success');
        }
    }

    /**
     * Displays the template for managing home page information in the admin panel.
     *
     * Gathers the current home page information and assigns it to the view, then displays the management template.
     *
     * @return void
     */
    protected function displayHomeTemplate(): void
    {
        $data = $this->homeModel->getHomeInfo();
        $text_info = $data[0]['text_info'] ?? "";

        $this->view->assign('text_info', $text_info);
        $this->view->display('admin/edit_home_info.php');
    }
}