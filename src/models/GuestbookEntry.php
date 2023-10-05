<?php

namespace models;

/**
 * Represents the data and operations associated with guestbook entries.
 *
 * Provides methods to interact with guestbook entries stored in the database, such as
 * fetching all entries, adding a new entry, and deleting an existing entry. All actions
 * performed are logged for auditing purposes.
 */
class GuestbookEntry
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
     * Initializes a new instance of the GuestbookEntry model with the provided database instance.
     *
     * @param DB $db The database instance to be used for database operations.
     */
    public function __construct(DB $db)
    {
        $this->db = $db;
        $this->log = new Log();
    }

    /**
     * Retrieves all entries from the guestbook.
     *
     * @return array|false An array of guestbook entries or false if an error occurred.
     */
    public function getEntry(): array|false
    {
        return $this->db->query('SELECT * FROM guestbook');
    }

    /**
     * Adds a new entry to the guestbook.
     *
     * This method also logs the action indicating the new entry was added.
     *
     * @param string $userName The name of the user who added the entry.
     * @param string $entryText The text content of the entry.
     * @return bool True if the addition was successful, false otherwise.
     * @throws \Exception If a database error occurs.
     */
    public function addEntry(string $userName, string $entryText): bool
    {
        $data = [
            'user_name' => $userName,
            'entry_text' => $entryText
        ];

        $ip = $_SERVER['REMOTE_ADDR'];
        $this->log->actionLog('addEntry', $userName, $ip, 'true');

        return $this->db->execute('INSERT INTO guestbook(user_name, entry_text) VALUES (:user_name, :entry_text)', $data);
    }

    /**
     * Deletes an existing entry from the guestbook based on its unique identifier.
     *
     * This method also logs the action indicating an entry was deleted.
     *
     * @param int $id The unique identifier of the guestbook entry to delete.
     * @return bool True if the deletion was successful, false otherwise.
     * @throws \Exception If a database error occurs.
     */
    public function deleteEntry(int $id): bool
    {
        $data = ['id' => $id];

        $ip = $_SERVER['REMOTE_ADDR'];
        $this->log->actionLog('deleteEntry', 'Admin', $ip, 'true');

        return $this->db->execute('DELETE FROM guestbook WHERE entry_id = :id', $data);
    }
}