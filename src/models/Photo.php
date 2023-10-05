<?php

namespace models;

/**
 * Represents a model for managing and manipulating image files.
 *
 * The Photo class facilitates actions like uploading, retrieving,
 * and deleting images in the application's gallery.
 */
class Photo
{
    /**
     * The directory path where uploaded images are stored.
     *
     * @var string
     */
    protected string $galleryPath = __DIR__ . '/../../public/images/';

    /**
     * The database instance.
     *
     * @var DB
     */
    protected DB $db;

    /**
     * The logging instance.
     *
     * @var Log
     */
    protected Log $log;

    /**
     * Initializes a new instance of the Photo model.
     *
     * @param DB $db The database instance.
     */
    public function __construct(DB $db)
    {
        $this->db = $db;
        $this->log = new Log();
    }

    /**
     * Checks if the provided file has been successfully uploaded.
     *
     * @param array $file The file array typically from $_FILES.
     * @return bool True if uploaded without errors, false otherwise.
     */
    public function isUploaded(array $file): bool
    {
        return isset($file) && $file['error'] === UPLOAD_ERR_OK;
    }

    /**
     * Uploads an image to the gallery.
     *
     * If the upload is successful, the image path will be recorded in the database.
     * All upload actions, both successful and unsuccessful, are logged.
     *
     * @param array $file The file array typically from $_FILES.
     * @return bool True if the upload succeeds, false otherwise.
     */
    public function uploadImage(array $file): bool
    {
        $ip = $_SERVER['REMOTE_ADDR'];

        if ($this->isUploaded($file)) {
            $targetPath = $this->galleryPath . basename($file['name']);

            $data = ['image_path' => $file['name']];
            $this->db->query('INSERT INTO gallery (image_path) VALUES (:image_path);', $data);

            $this->log->actionLog('ImageUpload', 'Admin', $ip, 'true');

            return move_uploaded_file($file['tmp_name'], $targetPath);
        }

        $this->log->actionLog('ImageUpload', 'Admin', $ip, 'false');

        return false;
    }

    /**
     * Retrieves all images from the gallery.
     *
     * @return array|false An array of image details or false on failure.
     */
    public function getImage(): array|false
    {
        return $this->db->query('SELECT * FROM gallery');
    }

    /**
     * Deletes an image from the gallery based on its ID and filename.
     *
     * If the database deletion is successful, the actual image file will also be deleted.
     *
     * @param int $id The ID of the image in the gallery database.
     * @param string $fileName The filename of the image.
     * @return bool True if the deletion succeeds, false otherwise.
     * @throws \Exception
     */
    public function deleteImage(int $id, string $fileName): bool
    {
        $data = ['id' => $id];

        if ($this->db->execute('DELETE FROM gallery WHERE image_id = :id', $data)) {
            return unlink($this->galleryPath . '/' . $fileName);
        }

        return false;
    }
}
