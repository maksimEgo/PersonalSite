<?php

namespace controllers;

use models\Home;
use views\View;

/**
 * Controller responsible for managing the main (home) page of the application.
 *
 * Provides methods for retrieving the home page data and rendering the view.
 */
class HomeController
{
    /**
     * @var Home The model instance for handling data retrieval related to the home page.
     */
    protected Home $home;

    /**
     * @var View The instance responsible for rendering views.
     */
    protected View $view;

    /**
     * Initializes a new instance of the HomeController.
     *
     * @param Home $home The home model instance for retrieving home page data.
     * @param View $view The view instance for rendering views.
     */
    public function __construct(Home $home, View $view)
    {
        $this->home = $home;
        $this->view = $view;
    }

    /**
     * Retrieves the home page data and renders it.
     *
     * Fetches the main textual information for the home page and passes it
     * to the view for rendering. If an exception occurs during this process,
     * a new exception is thrown with additional information.
     *
     * @return void
     * @throws \Exception If an error occurs during the data retrieval or rendering.
     */
    public function index(): void
    {
        try {
            $data = $this->home->getHomeInfo();

            $text_info = $data[0]['text_info'] ?? "";

            $this->view->assign('text_info', $text_info);

            $this->view->display('home/home.php');
        } catch ( \Exception $exception ) {
            throw new \Exception('Error during page load. ' . $exception->getTraceAsString() );
        }
    }
}