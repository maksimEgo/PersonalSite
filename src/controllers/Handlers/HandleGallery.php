<?php

namespace controllers\Handlers;

use models\Photo;

/**
 * The HandleGallery trait provides methods for managing the Gallery section in the admin panel.
 *
 * This trait is designed to be used by controllers that require functionalities for
 * uploading, validating, and displaying images in the admin panel's gallery section.
 */
trait HandleGallery
{
    /**
     * @var Photo Model responsible for managing photo-related operations.
     */
    protected Photo $photoModel;

    /**
     * Set the Photo model for gallery handling.
     *
     * @param Photo $photo The photo model instance.
     * @return void
     */
    public function setPhotoModel(Photo $photo) :void
    {
        $this->photoModel = $photo;
    }

    /**
     * Handle the loading of the gallery section in the admin panel.
     *
     * Tries to upload an image if POST data is received. In any case, displays the gallery template afterward.
     *
     * @return void
     * @throws \Exception If there's an error during image upload.
     */
    public function handleGalleryLoad(): void
    {
        try {
            $this->uploadImage();
        } catch (\Exception $exception) {
            throw new \Exception('Cant Upload ' . $exception->getTraceAsString() );
        } finally {
            $this->displayPhotoTemplate();
        }
    }

    /**
     * Attempt to upload an image to the gallery.
     *
     * Validates the file, checks if it's an image, and then tries to upload it.
     * Redirects to the gallery section if the upload is successful.
     *
     * @return void
     */
    protected function uploadImage() :void
    {
        if ( 'POST' === $_SERVER['REQUEST_METHOD'] ) {
            if ( isset( $_FILES['image'] ) && $this->photoModel->isUploaded( $_FILES['image'] ) ) {
                if ( $this->photoModel->uploadImage( $_FILES['image'] ) ) {
                    header('Location: /?page=admin&section=gallery');
                    exit;
                } else {
                    echo 'image can not upload';
                }
            } else {
                echo 'file not is image';
            }
        }
    }

    /**
     * Displays the template for adding images to the gallery in the admin panel.
     *
     * @return void
     */
    protected function displayPhotoTemplate() :void
    {
        $this->view->display('admin/add_image_gallery.php');
    }
}