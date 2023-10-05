<?php

namespace models;

/**
 * Represents a user model, specifically for an Administrator.
 *
 * This model provides functionality for working with the user data,
 * primarily for administrative purposes, since there's only one user
 * in the system.
 */
class User
{
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
     * Initializes a new instance of the User model.
     *
     * @param DB $db The database instance.
     */
    public function __construct(DB $db)
    {
        $this->db = $db;
        $this->log = new Log();
    }

    /**
     * Retrieves the Administrator's details.
     *
     * @return array|null The user details or null if not found.
     */
    public function getUser(): ?array
    {
        $result = $this->db->query('SELECT user_login, user_email, user_hash_password FROM users');
        return $result[0] ?? null;
    }

    /**
     * Authenticates the Administrator using provided credentials.
     *
     * If the login attempt fails, a log entry will be created.
     *
     * @param string $login    The login name of the user.
     * @param string $password The user's password.
     * @return bool True if authentication succeeds, false otherwise.
     */
    public function authorization(string $login, string $password): bool
    {
        $user = $this->getUser();
        $ip = $_SERVER['REMOTE_ADDR'];

        if ($user['user_login'] !== $login) {
            $this->log->actionLog('authorization', 'Admin', $ip, 'false');
            return false;
        }

        return password_verify($password, $user['user_hash_password']);
    }
}
