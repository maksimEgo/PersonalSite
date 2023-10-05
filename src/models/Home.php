<?php

namespace models;

/**
 * Represents the data and operations associated with the home page.
 *
 * This class provides methods to interact with the home page data
 * stored in the database, such as fetching information for display
 * and updating the home page content.
 */
class Home
{
    /**
     * The database instance.
     *
     * @var DB
     */
    protected DB $db;

    /**
     * The log instance for logging operations.
     *
     * @var Log
     */
    protected Log $log;

    /**
     * Initializes a new instance of the Home model with the provided database instance.
     *
     * @param DB $db The database instance to be used for database operations.
     */
    public function __construct(DB $db)
    {
        $this->db = $db;
        $this->log = new Log();
    }

    /**
     * Fetches the textual information designated for display on the home page.
     *
     * @return array|false The information retrieved, or false if an error occurred.
     */
    public function getHomeInfo(): array|false
    {
        return $this->db->query('SELECT text_info FROM info');
    }

    /**
     * Updates the textual content designated for the home page.
     *
     * This method also logs the action indicating the change was made.
     *
     * @param string $text The new textual content for the home page.
     * @return bool True if the update was successful, false otherwise.
     */
    public function editInfo(string $text): bool
    {
        $data = ['text_info' => $text];

        $ip = $_SERVER['REMOTE_ADDR'];
        $this->log->actionLog('editInfo', 'Admin', $ip, 'true');

        $result = $this->db->query('UPDATE info SET text_info = :text_info WHERE info_id = 1;', $data);

        return $result !== false;
    }
}