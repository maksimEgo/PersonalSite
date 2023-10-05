<?php

namespace controllers;

use models\Photo;
use views\View;

/**
 * Controller for managing the photo gallery functionality.
 *
 * Responsible for retrieving photo data and rendering the gallery view.
 */
class PhotoController
{
    /** @var Photo Handles the business logic related to photos. */
    protected Photo $photo;

    /** @var View Handles rendering and displaying views. */
    protected View $view;

    /**
     * Initializes a new instance of the PhotoController.
     *
     * @param Photo $photo The photo model instance for retrieving photo data.
     * @param View $view The view instance for rendering views.
     */
    public function __construct(
        Photo $photo,
        View $view
    )
    {
        $this->photo = $photo;
        $this->view = $view;
    }

    /**
     * Retrieves the photo gallery data and displays it.
     *
     * Fetches all images from the gallery and passes them to the view for rendering.
     *
     * @return void
     */
    public function index(): void
    {
        $images = $this->photo->getImage();
        $this->view->assign('images', $images);
        $this->view->display('photo/gallery.php');
    }
}
